<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home Controller
 */
class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Load the login view.
	 */
	public function index()
	{
		$data['login'] = (isset($_SESSION['userID'])) ? TRUE : FALSE;
		$this->load->view('header', $data);
		$this->load->view('home');
		$this->load->view('footer');
	}
}
