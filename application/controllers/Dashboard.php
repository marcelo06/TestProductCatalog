<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Controller
 */
class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['userID']))
		{
			redirect(base_url());
		}
	}

	/**
	 * Load the login view.
	 */
	public function index()
	{
		$data['login'] = (isset($_SESSION['userID'])) ? TRUE : FALSE;
		$this->load->view('dashboardHeader', $data);
		$this->load->view('dashboard');
		$this->load->view('footer');
	}
}
