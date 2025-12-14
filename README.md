# 📦 Warehouse Space Optimization System

![License](https://img.shields.io/badge/License-MIT-green.svg)
![PHP](https://img.shields.io/badge/PHP-%3E%3D5.3.7-blue.svg)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.1.6-orange.svg)
![MySQL](https://img.shields.io/badge/MySQL-Database-blue.svg)
![Bootstrap](https://img.shields.io/badge/Bootstrap-3-purple.svg)
![jQuery](https://img.shields.io/badge/jQuery-Library-blue.svg)

A comprehensive warehouse management system focused on optimizing storage space utilization, tracking inventory across multiple storage locations, and improving layout efficiency through intelligent placement algorithms.

## 🎯 Project Purpose

This system provides warehouse managers with tools to:
- Track inventory across multiple storage locations (emplacements)
- Optimize space utilization by identifying underutilized storage areas
- Manage stock items with dimensional tracking
- Monitor warehouse capacity and occupancy in real-time
- Control user access through role-based permissions

## ✨ Features

- **📊 Dashboard Analytics** - Real-time overview of total articles, stock levels, users, and storage locations
- **📦 Stock Management** - Complete CRUD operations for warehouse items with dimensional tracking (length, width, height)
- **📍 Emplacement Management** - Manage storage locations with capacity tracking and occupancy status
- **🔍 Space Optimization** - Intelligent algorithms to identify least occupied storage locations for optimal space utilization
- **👥 User Management** - Role-based access control with group permissions
- **🔐 Authentication System** - Secure login and session management
- **📈 Article Stock Tracking** - Track quantities of articles across different storage locations

## 🛠️ Tech Stack

### Backend
- **PHP** (>=5.3.7)
- **CodeIgniter 3** - MVC framework
- **MySQL** - Database management

### Frontend
- **AdminLTE** - Admin dashboard template
- **Bootstrap 3** - CSS framework
- **jQuery** - JavaScript library
- **DataTables** - Advanced table functionality
- **Chart.js** - Data visualization
- **Select2** - Enhanced select dropdowns
- **Bootstrap Datepicker** - Date selection components

## 📋 Prerequisites

- PHP >= 5.3.7
- MySQL/MariaDB database
- Apache web server (or compatible)
- Composer (optional, for dependency management)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd stock
   ```

2. **Configure the database**
   - Create a MySQL database named `stock` (or your preferred name)
   - Copy the database configuration template:
     ```bash
     cp application/config/database.php.example application/config/database.php
     ```
   - Update database credentials in `application/config/database.php`:
     ```php
     'hostname' => 'localhost',
     'username' => 'your_username',
     'password' => 'your_password',
     'database' => 'stock',
     ```

3. **Import database schema**
   - Create the necessary tables for:
     - `stock` (articles)
     - `artstock` (article stock tracking)
     - `emplacement` (storage locations)
     - `users` (user accounts)
     - `groups` (user groups/permissions)
   - Refer to your database migration files or schema documentation

4. **Configure base URL**
   - Update `application/config/config.php` with your base URL:
     ```php
     $config['base_url'] = 'http://localhost/stock/';
     ```

5. **Set permissions**
   - Ensure `application/logs/` and `application/cache/` directories are writable

6. **Access the application**
   - Navigate to `http://localhost/stock/` in your browser
   - Login with your credentials

## 💻 Usage

### Dashboard
The dashboard provides an overview of:
- Total articles in stock
- Total article stock entries
- Total users
- Total storage locations (emplacements)

### Stock Management
- Add, edit, and remove stock items
- Track item dimensions for space calculation
- View all articles in the warehouse

### Emplacement Management
- Create and manage storage locations
- Set location dimensions (width, height, depth)
- Track occupancy status
- View optimization recommendations

### Space Optimization
The system automatically calculates:
- Available space in each emplacement
- Least occupied locations for optimal placement
- Space utilization metrics

### User Management
- Create user groups with specific permissions
- Assign users to groups
- Manage user profiles and settings

## 📸 Screenshots

_Add screenshots of your application here_

## 📄 License

This project is licensed under the MIT License.

## 🙏 Credits & Attribution

### AdminLTE Template
This project uses the **AdminLTE** admin dashboard template for its user interface.

- **AdminLTE** is licensed under the [MIT License](https://github.com/ColorlibHQ/AdminLTE/blob/master/LICENSE)
- Official website: [https://adminlte.io](https://adminlte.io)
- The UI design and frontend components are based on AdminLTE

**Note:** While the UI template is based on AdminLTE, all system logic, database architecture, optimization algorithms, and business functionality are original custom development.

### CodeIgniter Framework
This project is built on CodeIgniter 3, which is licensed under the MIT License.

---

**Disclaimer:** This is a portfolio project demonstrating warehouse management and space optimization capabilities. The AdminLTE template provides the visual framework, while all core functionality, algorithms, and system architecture are custom-developed.

