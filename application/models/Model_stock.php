<?php 

class Model_stock extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /* get the stock data */
    public function getStockData($id = null)
    {
        if ($id) {
            $this->db->where('id', $id);
            $query = $this->db->get('stock');
            return $query->row_array();
        }

        $query = $this->db->get('stock');
        return $query->result_array();
    }
	/* create a new stock */
    public function createStock($data)
    {
        if ($data) {
            $insert = $this->db->insert('stock', $data);
            return $insert;
        }
        return false;
    }
	public function update($data, $id)
	{
		if ($data && $id) {
        	$this->db->where('id', $id);
        	$update = $this->db->update('stock', $data);
        	return ($update == true) ? true : false;
    	}
	}
	public function remove($id)
{
    if($id) {
        // Check if stock article has artstock records before deletion
        $this->db->where('code_article', $this->getStockData($id)['codeart']);
        $artstock_count = $this->db->count_all_results('artstock');
        
        if ($artstock_count > 0) {
            return false; // Cannot delete - has artstock records
        }
        
        $this->db->where('id', $id);
        $delete = $this->db->delete('stock');
        return ($delete == true) ? true : false;
    }
}
public function countTotalarticles()
	{
		$sql = "SELECT * FROM stock";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}


}
