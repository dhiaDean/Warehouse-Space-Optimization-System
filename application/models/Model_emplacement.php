<?php 

class Model_emplacement extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get active brand infromation */
	public function getActiveCategroy()
	{
		$sql = "SELECT * FROM emplacement WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the emp data */
	public function getEmplacementData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM emplacement WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM emplacement";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('emplacement', $data);
			return ($insert == true) ? true : false;
		}
	}
	
	public function getLeastOccupiedEmp() {
        $sql = "SELECT e.codeemp, 
            ((s.langeur * s.largeur * s.hauteur) * a.qte) - (e.width * e.height * e.depth) AS quantity_vide
            FROM emplacement e
            JOIN artstock a ON e.codeemp = a.emp
            JOIN stock s ON a.code_article = s.codeart
            WHERE e.occupied = 1
            GROUP BY e.codeemp
            ORDER BY quantity_vide ASC
            LIMIT 1";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->codeemp; // Return the least occupied emplacement code
        }

        return false; // Return false if no occupied emplacements found
    }

	public function update($id, $data)
    {
        if($data && $id) {
            $this->db->where('id', $id);
            $update = $this->db->update('emplacement', $data);
            return ($update == true) ? true : false;
        }
    }

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('emplacement');
			return ($delete == true) ? true : false;
		}
	}
	public function countTotalEmplacement()
	{
		$sql = "SELECT * FROM emplacement";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}