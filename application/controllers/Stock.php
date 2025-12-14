<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Stock';

        $this->load->model('Model_stock'); // Use consistent naming for model loading.
    }

    /* redirect to the index page */
    public function index()
    {
        if (!in_array('viewStock', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('stock/index', $this->data);    
    }

    /* fetch the attribute data through attribute id */
    public function fetchStockDataById($id) 
    {
        if ($id) {
            $data = $this->Model_stock->getStockData($id);
            echo json_encode($data);
        }
    }

    /*
    * It retrieves all the attribute data from the database 
    * This function is called from the datatable ajax function
    * The data is return based on the json format.
    */
    public function fetchStockData()
    {
        $result = array('data' => array());

        $data = $this->Model_stock->getStockData();

        foreach ($data as $key => $value) {
            // button
            $buttons = '';

            if (in_array('updateStock', $this->permission)) {
                $buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
                
            }

            if (in_array('deleteStock', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
                
                
            }

            $result['data'][$key] = array(
                $value['codeart'],
                $value['libart'],
                $value['prix'],
                $value['langeur'], 
                $value['largeur'],
                $value['hauteur'],
                $value['classeABC'],
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }

/* create a new attribute */
public function create()
{
	if (!in_array('createStock', $this->permission)) {
		redirect('dashboard', 'refresh');
	}

	$response = array();

	$this->form_validation->set_rules('codeart', 'Code Art', 'trim|required|max_length[50]');
	$this->form_validation->set_rules('libart', 'Lib Art', 'trim|required|max_length[255]');
	$this->form_validation->set_rules('prix', 'Prix', 'trim|required|numeric');
    $this->form_validation->set_rules('langeur', 'Langeur', 'trim|required|numeric');
	$this->form_validation->set_rules('largeur', 'Largeur', 'trim|required|numeric');
	$this->form_validation->set_rules('hauteur', 'Hauteur', 'trim|required|numeric');
	$this->form_validation->set_rules('classeABC', 'Classe ABC', 'trim|required|max_length[1]');

	$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

	if ($this->form_validation->run() == TRUE) {
		$data = array(
			'codeart' => $this->input->post('codeart'),
			'libart' => $this->input->post('libart'),
			'prix' => $this->input->post('prix'),
			'langeur' => $this->input->post('langeur'),
			'largeur' => $this->input->post('largeur'),
			'hauteur' => $this->input->post('hauteur'),
			'classeABC' => $this->input->post('classeABC'),
		);

		$create = $this->Model_stock->createStock($data);
		if ($create) {
			$response['success'] = true;
			$response['messages'] = 'Successfully created';
		} else {
			$response['success'] = false;
			$response['messages'] = 'Error in the database while creating the attribute information';
		}
	} else {
		$response['success'] = false;
		foreach ($_POST as $key => $value) {
			$response['messages'][$key] = form_error($key);
		}
	}

	echo json_encode($response);
}
/*edit*/
public function update($id)
{
    if (!in_array('updateStock', $this->permission)) {
        redirect('dashboard', 'refresh');
    }

    $response = array();

    if ($id) {
        $this->form_validation->set_rules('edit_codeart', 'Code Art', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('edit_libart', 'Description', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('edit_prix', 'Quantity', 'trim|required|numeric');
        $this->form_validation->set_rules('edit_langeur', 'Langeur', 'trim|required|numeric');
        $this->form_validation->set_rules('edit_largeur', 'Largeur', 'trim|required|numeric');
        $this->form_validation->set_rules('edit_hauteur', 'Hauteur', 'trim|required|numeric');
        $this->form_validation->set_rules('edit_classeABC', 'Employee', 'trim|required|max_length[1]');

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'codeart' => $this->input->post('edit_codeart'),
                'libart' => $this->input->post('edit_libart'),
                'prix' => $this->input->post('edit_prix'),
                'langeur' => $this->input->post('edit_langeur'),
                'largeur' => $this->input->post('edit_largeur'),
                'hauteur' => $this->input->post('edit_hauteur'),
                'classeABC' => $this->input->post('edit_classeABC'),
            );

            $update = $this->Model_stock->update($data, $id);
            if ($update == true) {
                $response['success'] = true;
                $response['messages'] = 'Successfully updated';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while updating the article information';
            }
        } else {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }
    } else {
        $response['success'] = false;
        $response['messages'] = 'Error, please refresh the page again!';
    }

    echo json_encode($response);
}
//remove
public function remove()
{
    if (!in_array('deleteStock', $this->permission)) {
        redirect('dashboard', 'refresh');
    }

    $stock_id = $this->input->post('stock_id'); // Update input name

    $response = array();
    if ($stock_id) {
        $delete = $this->Model_stock->remove($stock_id); // Update model name to match class name
        if ($delete == true) {
            $response['success'] = true;
            $response['messages'] = "Successfully removed";
        } else {
            $response['success'] = false;
            $response['messages'] = "Error in the database while removing the article information";
        }
    } else {
        $response['success'] = false;
        $response['messages'] = "Refresh the page again!!";
    }

    echo json_encode($response);
}


}
