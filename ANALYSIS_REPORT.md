# Project Analysis Report: Stock Management System

## Executive Summary
This report identifies missing correlations between **article (stock)**, **artstock**, and **emplacement** tables, as well as unfinished or broken code in the input/edit/delete sections.

---

## 1. MISSING CORRELATIONS & RELATIONSHIPS

### 1.1 Database Relationships (Missing Foreign Key Constraints)
The system lacks proper foreign key relationships:

**Current State:**
- `artstock.code_article` should reference `stock.codeart` (NO FK constraint)
- `artstock.emp` should reference `emplacement.codeemp` (NO FK constraint)

**Impact:**
- Data integrity issues (orphaned records)
- No referential integrity enforcement
- Can create artstock records with non-existent articles or emplacements

### 1.2 Missing Data Validation
**Artstock Module:**
- ❌ No validation that `code_article` exists in `stock` table
- ❌ No validation that `emp` exists in `emplacement` table
- ❌ No dropdown selectors - uses free text input (allows invalid codes)

**Stock Module:**
- ✅ Basic validation exists but no uniqueness check for `codeart`

**Emplacement Module:**
- ✅ Basic validation exists but no uniqueness check for `codeemp`

### 1.3 Missing JOIN Queries for Display
**Artstock View:**
- Currently shows only codes (`code_article`, `emp`)
- Should JOIN with `stock` to show article name (`libart`)
- Should JOIN with `emplacement` to show emplacement label (`libemp`)

**Current Query:**
```php
SELECT * FROM artstock
```

**Should Be:**
```php
SELECT a.*, s.libart as article_name, e.libemp as emplacement_name 
FROM artstock a
LEFT JOIN stock s ON a.code_article = s.codeart
LEFT JOIN emplacement e ON a.emp = e.codeemp
```

---

## 2. UNFINISHED/BROKEN CODE ISSUES

### 2.1 Stock (Article) Module

#### Issue 1: Field Name Mismatch in Edit Form
**Location:** `application/views/stock/index.php` line 160
- **Problem:** View uses `edit_longeur` but controller expects `edit_langeur`
- **Impact:** Edit form won't populate/save the length field correctly
- **Fix Required:** Change `edit_longeur` to `edit_langeur` in view

#### Issue 2: Table Header Typo
**Location:** `application/views/stock/index.php` line 48
- **Problem:** Header says "libelle emp" but should be "libelle art"
- **Impact:** Confusing UI label

### 2.2 Artstock Module

#### Issue 3: Delete Function Broken - Parameter Mismatch
**Location:** 
- Controller: `application/controllers/Artstock.php` line 178-182
- Model: `application/models/Model_artstock.php` line 102-109
- View: `application/views/artstock/index.php` line 342-384

**Problem:**
- Controller receives `code_article` from POST
- Model's `remove()` function expects `id` (primary key)
- View sends `id` in JavaScript but controller looks for `code_article`
- **Result:** Delete function will fail

**Current Flow:**
```php
// View sends: {id: id}
// Controller expects: code_article
// Model expects: id
```

**Fix Required:** Controller should use `id` parameter, not `code_article`

#### Issue 4: Missing Dropdown Selectors
**Location:** `application/views/artstock/index.php`
- **Problem:** Uses text inputs for `code_article` and `emp` instead of dropdowns
- **Impact:** 
  - Users can enter invalid codes
  - No validation against existing records
  - Poor user experience

**Fix Required:** 
- Add AJAX endpoint to fetch stock articles
- Add AJAX endpoint to fetch emplacements
- Replace text inputs with `<select>` dropdowns

#### Issue 5: No Foreign Key Validation
**Location:** `application/controllers/Artstock.php` create/update methods
- **Problem:** No check if article code exists in stock table
- **Problem:** No check if emplacement code exists in emplacement table
- **Impact:** Can create invalid relationships

### 2.3 Emplacement Module

#### Issue 6: Delete Function - Wrong Parameter Type
**Location:** 
- Controller: `application/controllers/Emplacement.php` line 204
- Model: `application/models/Model_emplacement.php` line 70-77
- View: `application/views/emplacement/index.php` line 394

**Problem:**
- View sends `codeemp` (string code)
- Model's `remove()` expects `id` (integer primary key)
- **Result:** Delete will fail or delete wrong record

**Current Code:**
```php
// View: data: { codeemp:id }
// Controller: $emplacement_id = $this->input->post('codeemp');
// Model: $this->db->where('id', $id);
```

**Fix Required:** View should send `id`, controller should use `id`

#### Issue 7: No Cascade Delete Protection
**Location:** `application/models/Model_emplacement.php`
- **Problem:** No check if emplacement has artstock records before deletion
- **Impact:** Can delete emplacement with active stock, causing orphaned records
- **Fix Required:** Add validation to prevent deletion if artstock records exist

#### Issue 8: No Cascade Delete Protection for Stock
**Location:** `application/models/Model_stock.php`
- **Problem:** No check if stock article has artstock records before deletion
- **Impact:** Can delete article with active stock entries
- **Fix Required:** Add validation to prevent deletion if artstock records exist

---

## 3. MISSING FEATURES

### 3.1 Artstock Module
1. ❌ No dropdown for selecting articles (should load from stock table)
2. ❌ No dropdown for selecting emplacements (should load from emplacement table)
3. ❌ No display of article names (only codes shown)
4. ❌ No display of emplacement names (only codes shown)
5. ❌ No validation that article exists before creating artstock
6. ❌ No validation that emplacement exists before creating artstock

### 3.2 Stock Module
1. ❌ No uniqueness validation for `codeart`
2. ❌ No check for existing artstock records before deletion

### 3.3 Emplacement Module
1. ❌ No uniqueness validation for `codeemp`
2. ❌ No check for existing artstock records before deletion

---

## 4. RECOMMENDED FIXES PRIORITY

### High Priority (Critical Bugs)
1. ✅ Fix Artstock delete function (parameter mismatch)
2. ✅ Fix Emplacement delete function (parameter mismatch)
3. ✅ Fix Stock edit form field name mismatch
4. ✅ Add foreign key validation in Artstock create/update

### Medium Priority (Data Integrity)
5. ✅ Add dropdown selectors for Artstock (article & emplacement)
6. ✅ Add JOIN queries to display names instead of codes
7. ✅ Add cascade delete protection (prevent deletion if records exist)

### Low Priority (UX Improvements)
8. ✅ Fix table header typo in Stock view
9. ✅ Add uniqueness validation for codes
10. ✅ Improve error messages

---

## 5. DATABASE SCHEMA RECOMMENDATIONS

### Recommended Foreign Keys:
```sql
ALTER TABLE artstock 
ADD CONSTRAINT fk_artstock_stock 
FOREIGN KEY (code_article) REFERENCES stock(codeart) 
ON DELETE RESTRICT;

ALTER TABLE artstock 
ADD CONSTRAINT fk_artstock_emplacement 
FOREIGN KEY (emp) REFERENCES emplacement(codeemp) 
ON DELETE RESTRICT;
```

### Recommended Indexes:
```sql
CREATE INDEX idx_artstock_code_article ON artstock(code_article);
CREATE INDEX idx_artstock_emp ON artstock(emp);
CREATE UNIQUE INDEX idx_stock_codeart ON stock(codeart);
CREATE UNIQUE INDEX idx_emplacement_codeemp ON emplacement(codeemp);
```

---

## 6. SUMMARY OF ISSUES

| Module | Issue | Severity | Status |
|--------|-------|----------|--------|
| Stock | Field name mismatch (edit_longeur) | High | ❌ Broken |
| Stock | Table header typo | Low | ⚠️ Minor |
| Artstock | Delete parameter mismatch | Critical | ❌ Broken |
| Artstock | No dropdown selectors | High | ❌ Missing |
| Artstock | No foreign key validation | High | ❌ Missing |
| Artstock | No JOIN queries for display | Medium | ❌ Missing |
| Emplacement | Delete parameter mismatch | Critical | ❌ Broken |
| Emplacement | No cascade delete protection | Medium | ❌ Missing |
| Stock | No cascade delete protection | Medium | ❌ Missing |
| All | No foreign key constraints in DB | High | ❌ Missing |

---

**Report Generated:** Analysis of Stock Management System
**Total Issues Found:** 10 critical/high priority issues
**Recommendation:** Fix critical bugs first, then implement data integrity features

