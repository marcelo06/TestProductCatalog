<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login Controller
 */
class Login extends CI_Controller
{
	/**
	 * Load the login view.
	 */
	public function index()
	{
		if(isset($_SESSION['userID']))
		{
			redirect(base_url());
		}
		$data['login'] = (isset($_SESSION['userID'])) ? TRUE : FALSE;
		$this->load->view('login', $data);
	}

	public function authentication()
	{
		if($this->input->server('REQUEST_METHOD', TRUE) != 'POST')
		{
			show_404();
		}
		// validate form data.
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[20]', array('required' => 'This field "%s" is required.', 'max_length' => 'This field "%s" has more than 20 characters.')
		);
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[20]', array('required' => 'This field "%s" is required.', 'max_length' => 'This field "%s" has more than 20 characters.')
		);
		if(!$this->form_validation->run())
		{
			$errors = validation_errors();
			echo json_encode(array('response' => 'error', 'message' => $errors));
			return;
		}
		$this->load->model('user');
		$data = $this->input->post(NULL, TRUE);
		$user = $this->user->getUserByUsername($data['username']);
		if($user)
		{
			if($user->password == $data['password'])
			{
				$this->session->set_userdata(array('userID' => $user->id, 'username' => $user->username, 'admin' => ($user->admin == 0) ? FALSE : TRUE));
				echo json_encode(array('response' => 'success'));
				return;
			}
			else
			{
				echo json_encode(array('response' => 'error', 'message' => 'The username or password is not correct!'));
				return;
			}
		}
		else
		{
			echo json_encode(array('response' => 'error', 'message' => 'The user doesn´t exist!'));
			return;
		}
	}

	public function out()
	{
		unset($_SESSION['userID']);
		unset($_SESSION['username']);
		unset($_SESSION['admin']);
		redirect(base_url('login'));
	}
}
