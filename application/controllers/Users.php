<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users Controller
 */
class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['userID']))
		{
			redirect(base_url());
		}
		$this->load->model('user');
	}

	/**
	 * Load the login view.
	 */
	public function index($offset = 0)
	{
		$data['login'] = (isset($_SESSION['userID'])) ? TRUE : FALSE;
		$data['users'] = $this->user->getAllPaginator(PAGER, $offset);

		$this->load->library('pagination');
		$this->config->load('paginate', TRUE);
		$config = $this->config->item('paginate');
		$config['base_url'] = base_url('users/index');
		$config['total_rows'] = $this->user->getNumUsers();
		$config['per_page'] = PAGER;
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$data['pagination'] =  $this->pagination->create_links();

		$this->load->view('dashboardHeader', $data);
		$this->load->view('users', $data);
		$this->load->view('footer');
	}
}
