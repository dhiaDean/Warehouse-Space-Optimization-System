<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('model_stock');
		$this->load->model('model_artstock');
		$this->load->model('model_users');
		$this->load->model('model_emplacement');
	}

	/* 
	* It only redirects to the manage emplacement page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{
		$this->data['total_articles'] = $this->model_stock->countTotalarticles();
		$this->data['total_articleStock'] = $this->model_artstock->countTotalarticlesstock();
		$this->data['total_users'] = $this->model_users->countTotalUsers();
		$this->data['total_emplacement'] = $this->model_emplacement->countTotalEmplacement();

		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true :false;

		$this->data['is_admin'] = $is_admin;
		$this->render_template('dashboard', $this->data);
	}
}