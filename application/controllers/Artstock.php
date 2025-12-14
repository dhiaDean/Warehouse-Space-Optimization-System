<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Artstock extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Artstock';

		$this->load->model('model_artstock');
		$this->load->model('Model_stock');
		$this->load->model('Model_emplacement');
	}

	/* 
    * It only redirects to the manage Artstock page
    */
	public function index()
	{
		if(!in_array('viewArt', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		// Load stock articles and emplacements for dropdowns
		$this->data['stock_articles'] = $this->Model_stock->getStockData();
		$this->data['emplacements'] = $this->Model_emplacement->getEmplacementData();

		$this->render_template('artstock/index', $this->data);	
	}

	/*
	* Fetch stock articles for dropdown
	*/
	public function fetchStockArticles()
	{
		$articles = $this->Model_stock->getStockData();
		echo json_encode($articles);
	}

	/*
	* Fetch emplacements for dropdown
	*/
	public function fetchEmplacements()
	{
		$emplacements = $this->Model_emplacement->getEmplacementData();
		echo json_encode($emplacements);
	}

	/*
	* It retrieve the specific art stock information via a art stock id
	* and returns the data in json format.
	*/
	public function fetchArtstockDataById($id) 
	{
		if($id) {
			$data = $this->model_artstock->getArtstockData($id);
			echo json_encode($data);
		}
	}

	/*
	* It retrieves all the art stock data from the database 
	* This function is called from the datatable ajax function
	* The data is return based on the json format.
	*/
	public function fetchArtstockData()
	{
		$result = array('data' => array());

		$data = $this->model_artstock->getArtstockData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateArt', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteArt', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$result['data'][$key] = array(
				$value['code_article'] . (isset($value['article_name']) ? ' (' . $value['article_name'] . ')' : ''),
				$value['desc'],
				$value['qte'],
                $value['emp'] . (isset($value['emplacement_name']) ? ' (' . $value['emplacement_name'] . ')' : ''),
				$buttons
			);
		} // /foreach

		echo json_encode($result);
        
	}

	/*
    * If the validation is not valid, then it provides the validation error on the json format
    * If the validation for each input is valid then it inserts the data into the database and 
    returns the appropriate message in the json format.
    */
	public function create()
    {
        if (!in_array('createArt', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $response = array();

        $this->form_validation->set_rules('add_codeart', 'code art', 'trim|required'); // Update field name
        $this->form_validation->set_rules('add_desc', 'description', 'trim|required'); // Update field name
        $this->form_validation->set_rules('add_qte', 'qte', 'trim|required|numeric'); // Update field name
        $this->form_validation->set_rules('add_emp', 'emplacement', 'trim|required'); // Update field name

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        /*$this->load->model('Emplacement_model');*/
        /*$leastOccupiedEmp = $this->Emplacement_model->getLeastOccupiedEmp();*/

        if ($this->form_validation->run() == TRUE) {
            // Validate that article code exists in stock table
            $this->load->model('Model_stock');
            $article = $this->Model_stock->getStockData();
            $article_exists = false;
            foreach ($article as $art) {
                if ($art['codeart'] == $this->input->post('add_codeart')) {
                    $article_exists = true;
                    break;
                }
            }
            
            // Validate that emplacement code exists
            $this->load->model('Model_emplacement');
            $emplacements = $this->Model_emplacement->getEmplacementData();
            $emp_exists = false;
            foreach ($emplacements as $emp) {
                if ($emp['codeemp'] == $this->input->post('add_emp')) {
                    $emp_exists = true;
                    break;
                }
            }
            
            if (!$article_exists) {
                $response['success'] = false;
                $response['messages'] = 'Article code does not exist in stock table';
                echo json_encode($response);
                return;
            }
            
            if (!$emp_exists) {
                $response['success'] = false;
                $response['messages'] = 'Emplacement code does not exist';
                echo json_encode($response);
                return;
            }
            
            $data = array(
                'code_article' => $this->input->post('add_codeart'),
                'desc' => $this->input->post('add_desc'),
                'qte' => $this->input->post('add_qte'),
                'emp' => $this->input->post('add_emp'),
            );

            $create = $this->model_artstock->create($data);
            if ($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Successfully created';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while creating the article information';
            }
        } else {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }

        echo json_encode($response);
    }

    public function update($id)
    {
        if (!in_array('updateArt', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $response = array();

        if ($id) {
            $this->form_validation->set_rules('edit_codeart', 'Code Art', 'trim|required'); // Update field name
			$this->form_validation->set_rules('edit_desc', 'Description', 'trim|required'); // Update field name
            $this->form_validation->set_rules('edit_qte', 'Quantity', 'trim|required|numeric'); // Update field name
            $this->form_validation->set_rules('edit_emp', 'Emplacement', 'trim|required'); 

            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == TRUE) {
                // Validate that article code exists in stock table
                $this->load->model('Model_stock');
                $article = $this->Model_stock->getStockData();
                $article_exists = false;
                foreach ($article as $art) {
                    if ($art['codeart'] == $this->input->post('edit_codeart')) {
                        $article_exists = true;
                        break;
                    }
                }
                
                // Validate that emplacement code exists
                $this->load->model('Model_emplacement');
                $emplacements = $this->Model_emplacement->getEmplacementData();
                $emp_exists = false;
                foreach ($emplacements as $emp) {
                    if ($emp['codeemp'] == $this->input->post('edit_emp')) {
                        $emp_exists = true;
                        break;
                    }
                }
                
                if (!$article_exists) {
                    $response['success'] = false;
                    $response['messages'] = 'Article code does not exist in stock table';
                    echo json_encode($response);
                    return;
                }
                
                if (!$emp_exists) {
                    $response['success'] = false;
                    $response['messages'] = 'Emplacement code does not exist';
                    echo json_encode($response);
                    return;
                }
                
                $data = array(
                    'code_article' => $this->input->post('edit_codeart'),
                    'desc' => $this->input->post('edit_desc'),
                    'qte' => $this->input->post('edit_qte'),
                    'emp' => $this->input->post('edit_emp'),
                );

                $update = $this->model_artstock->update($data, $id);
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

    public function remove()
    {
        if (!in_array('deleteArt', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $id = $this->input->post('id'); // Fixed: Use id instead of code_article

        $response = array();
        if ($id) {
            $delete = $this->model_artstock->remove($id);
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