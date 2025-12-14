<?php

class Model_artstock extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    
    

    public function getArtstockData($id = null)
    {
        if ($id) {
            $sql = "SELECT a.*, s.libart as article_name, e.libemp as emplacement_name 
                    FROM artstock a
                    LEFT JOIN stock s ON a.code_article = s.codeart
                    LEFT JOIN emplacement e ON a.emp = e.codeemp
                    WHERE a.id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT a.*, s.libart as article_name, e.libemp as emplacement_name 
                FROM artstock a
                LEFT JOIN stock s ON a.code_article = s.codeart
                LEFT JOIN emplacement e ON a.emp = e.codeemp
                ORDER BY a.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function create($data)
    {
        if ($data) {
            $insert = $this->db->insert('artstock', $data);
            return ($insert == true) ? true : false;
        }
    }
    /*
    //get the least occupied emp
    public function getLeastOccupiedEmp($articleCode)
    {
    
    $sql = "SELECT stock.hauteur * stock.langeur * stock.Largeur AS volumeArt,
                   (emplacement.width * emplacement.height * emplacement.depth) - b.Volumeoccupier AS VolumeVideExistant
            FROM emplacement
            JOIN artstock ON emplacement.codeemp = artstock.emp
            JOIN articles ON articles.codeart = Article_Stock.CodeArticle
            JOIN (
                SELECT emplacement.CodeEmp AS codeemp,
                       SUM(articles.Longeur * articles.Hauteur * articles.Largeur * Article_Stock.Qte) AS volumeoccupier
                FROM emplacement
                JOIN Article_Stock ON emplacement.CodeEmp = Article_Stock.Emp
                JOIN articles ON articles.codeart = Article_Stock.CodeArticle
                GROUP BY emplacement.CodeEmp
            ) b ON emplacement.CodeEmp = b.codeemp
            WHERE Articles.CodeArt = ?
              AND volumeArt < VolumeVideExistant
            ORDER BY VolumeVideExistant ASC
            LIMIT 1";

    
    $query = $this->db->query($sql, array($articleCode));

    
    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->emp; 
    }
    return false; 
}

    //get the least occupied emp
    public function getLeastOccupiedEmp($articleCode)
    {
    
    $sql = "SELECT e.codeemp, 
    ((stock.langeur * stock.largeur * stock.hauteur) * artstock.qte) - (e.width * e.height * e.depth) AS quantity_vide
FROM emplacement e
JOIN artstock ON e.codeemp = artstock.emp
JOIN stock ON artstock.code_article = stock.codeart
WHERE e.occupied = 1
GROUP BY e.codeemp
ORDER BY quantity_vide ASC
LIMIT 1";

    
    $query = $this->db->query($sql, array($articleCode));

    
    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->emp; 
    }
    return false; 
}*/


    public function update($data, $id)
    {
        if ($data && $id) {
            $this->db->where('id', $id);
            $update = $this->db->update('artstock', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id)
    {
        if ($id) {
            $this->db->where('id', $id);
            $delete = $this->db->delete('artstock');
            return ($delete == true) ? true : false;
        }
    }

    public function countTotalarticlesstock()
	{
		$sql = "SELECT * FROM artstock";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}


}
