<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emplacement extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Emplacement';

        $this->load->model('Model_emplacement'); // Update model loading
    }

    /* 
    * It only redirects to the manage emplacement page
    */
    public function index()
    {
        if(!in_array('viewEmp', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('emplacement/index', $this->data);    
    }

    /*
    * It checks if it gets the emplacement id and retrieves
    * the emplacement information from the emplacement model and 
    * returns the data into json format. 
    * This function is invoked from the view page.
    */
    public function fetchStoreDataById($id) 
    {
        if($id) {
            $data = $this->Model_emplacement->getEmplacementData($id); // Update function and model name
            echo json_encode($data);
        }

        return false;
    }

    /*
    * Fetches the emplacement value from the emplacement table 
    * this function is called from the datatable ajax function
    */
    public function fetchStoreData()
    {
        $result = array('data' => array());

        $data = $this->Model_emplacement->getEmplacementData(); // Update model name

        foreach ($data as $key => $value) {

            // button
            $buttons = '';

            if(in_array('updateEmp', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
            }

            if(in_array('deleteEmp', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

            $status = ($value['occupied'] == 1) ? '<span class="label label-success">Yes</span>' : '<span class="label label-warning">No</span>';

            $result['data'][$key] = array(
                $value['codeemp'],
                $value['libemp'],
                $value['width'],
                $value['height'],
                $value['depth'],
                $value['classeABC'],
                $value['poidmax'],
                $status,
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }

    /*
    * Its checks the emplacement form validation 
    * and if the validation is successful then it inserts the data into the database 
    * and returns the json format operation messages
    */

public function create()
{
    if (!in_array('createEmp', $this->permission)) {
        redirect('dashboard', 'refresh');
    }

    $response = array();

    $this->form_validation->set_rules('codeempa', 'Code Emplacement', 'trim|required');
    $this->form_validation->set_rules('libemp', 'Libelle Art', 'trim|required');
    $this->form_validation->set_rules('width', 'Width', 'trim|required|numeric');
    $this->form_validation->set_rules('height', 'Height', 'trim|required|numeric');
    $this->form_validation->set_rules('depth', 'Depth', 'trim|required|numeric');
    $this->form_validation->set_rules('classeABC', 'Classe ABC', 'trim|required|alpha');
    $this->form_validation->set_rules('poidmax', 'Poid Max', 'trim|required|numeric');
    $this->form_validation->set_rules('occupied', 'Occupied', 'trim|required|in_list[1,2]');
    $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

    

    if ($this->form_validation->run() == TRUE) {
        $data = array(
            'codeemp' => $this->input->post('codeempa'),
            'libemp' => $this->input->post('libemp'),
                'width' => $this->input->post('width'),
                'height' => $this->input->post('height'),
                'depth' => $this->input->post('depth'),
                'classeABC' => $this->input->post('classeABC'),
                'poidmax' => $this->input->post('poidmax'),
                'occupied' => $this->input->post('occupied'),
        );

        $create = $this->Model_emplacement->create($data);
        if ($create == true) {
            $response['success'] = true;
            $response['messages'] = 'Successfully created';
        } else {
            $response['success'] = false;
            $response['messages'] = 'Error in the database while creating the emplacement information';
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
    if (!in_array('updateEmp', $this->permission)) {
        redirect('dashboard', 'refresh');
    }

    $response = array();

    if ($id) {
        $this->form_validation->set_rules('edit_codeemp', 'Code Emplacement', 'trim|required');
        $this->form_validation->set_rules('edit_libemp', 'Libelle Art', 'trim|required');
        $this->form_validation->set_rules('edit_width', 'Width', 'trim|required|numeric');
        $this->form_validation->set_rules('edit_height', 'Height', 'trim|required|numeric');
        $this->form_validation->set_rules('edit_depth', 'Depth', 'trim|required|numeric');
        $this->form_validation->set_rules('edit_classeABC', 'Classe ABC', 'trim|required|alpha');
        $this->form_validation->set_rules('edit_poidmax', 'Poid Max', 'trim|required|numeric');
        $this->form_validation->set_rules('edit_occupied', 'Occupied', 'trim|required|in_list[1,2]');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'codeemp' => $this->input->post('edit_codeemp'),
                'libemp' => $this->input->post('edit_libemp'),
                'width' => $this->input->post('edit_width'),
                'height' => $this->input->post('edit_height'),
                'depth' => $this->input->post('edit_depth'),
                'classeABC' => $this->input->post('edit_classeABC'),
                'poidmax' => $this->input->post('edit_poidmax'),
                'occupied' => $this->input->post('edit_occupied'),  
            );

            $update = $this->Model_emplacement->update($id, $data);
            if ($update == true) {
                $response['success'] = true;
                $response['messages'] = 'Successfully updated';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while updating the emplacement information';
            }
        } else {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
				
            }
        }
    } else {
        $response['success'] = false;
        $response['messages'] = 'Error in the form submission. Please refresh the page and try again.';
    }

    echo json_encode($response);
}

public function remove()
{
    if (!in_array('deleteEmp', $this->permission)) {
        redirect('dashboard', 'refresh');
    }

    $id = $this->input->post('id'); // Fixed: Use id instead of codeemp

    $response = array();
    if ($id) {
        // Check if emplacement has artstock records before deletion
        $this->load->model('model_artstock');
        $this->db->where('emp', $this->Model_emplacement->getEmplacementData($id)['codeemp']);
        $artstock_count = $this->db->count_all_results('artstock');
        
        if ($artstock_count > 0) {
            $response['success'] = false;
            $response['messages'] = "Cannot delete emplacement. It has " . $artstock_count . " stock record(s) associated with it.";
        } else {
            $delete = $this->Model_emplacement->remove($id);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the emplacement information";
            }
        }
    } else {
        $response['success'] = false;
        $response['messages'] = "Refresh the page again!!";
    }

    echo json_encode($response);
}

}