<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Categories Controller
 */
class Categories extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['userID']))
		{
			redirect(base_url());
		}
		$this->load->model('category');
		$this->load->helper(array('form', 'url'));

	}

	/**
	 * Load the login view.
	 */
	public function index($offset = 0)
	{
		$data['login'] = (isset($_SESSION['userID'])) ? TRUE : FALSE;
		$data['categories'] = $this->_order_categories();
		$start = $offset;
		$data['categories'] = array_slice($data['categories'], $start, $start + PAGER);
		$this->load->library('pagination');
		$this->config->load('paginate', TRUE);
		$config = $this->config->item('paginate');
		$config['base_url'] = base_url('categories/index');
		$config['total_rows'] = $this->category->getNumCategories();
		$config['per_page'] = PAGER;
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$data['pagination'] =  $this->pagination->create_links();

		$this->load->view('dashboardHeader', $data);
		$this->load->view('categories', $data);
		$this->load->view('footer');
	}

	public function createForm()
	{
		$data['login'] = (isset($_SESSION['userID'])) ? TRUE : FALSE;
		$data['categories'] = $this->category->getAll();
		$this->load->view('dashboardHeader', $data);
		$this->load->view('categoriesForm', $data);
		$this->load->view('footer');
	}

	public function create()
	{
		if($this->input->server('REQUEST_METHOD', TRUE) != 'POST')
		{
			show_404();
		}
		$this->load->library('form_validation');
				$this->form_validation->set_rules('name', 'Name', 'required|max_length[20]', array('required' => 'This fiield "%s" is required.', 'max_length' => 'This field "%s" has more than 32 characters.')
		);
		if(!$this->form_validation->run())
		{
			$errors = validation_errors();
			echo json_encode(array('response' => 'error', 'message' => $errors));
			return;
		}
		$data['name'] = $this->input->post('name', TRUE);
		$data['parent_id'] = $this->input->post('parent', TRUE);

		try
		{
			$id = $this->category->insert($data);
			if($id)
			{
				$config['upload_path'] = './uploads/categories/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 100;
				$config['max_width'] = 1024;
				$config['max_height'] = 768;
				$this->load->library('upload');
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('photo'))
				{
					$error = $this->upload->display_errors();
					echo json_encode(array('response' => 'error', 'message' => $error));
					return;
				}
				else
				{
					$data = $this->upload->data();
					$this->category->update($id, array('photo' => 'uploads/categories/'.$data['file_name']));
					echo json_encode(array('response' => 'success', 'title' => 'stored category','message' => 'The category was stored correctly.'));
					return;
				}
			}
			else
			{
				echo json_encode(array('response' => 'error', 'message' => 'The category could not be inserted.'));
				return;
			}
		}
		catch(Exception $e)
		{
			echo json_encode(array('response' => 'error', 'message' => 'An error occurred while trying to insert the category.'));
			return;
		}

	}

	public function delete($id)
	{
		$category = $this->category->getById($id);
		if($category)
		{
			if($this->category->isIterasable($id))
			{
				if($this->category->delete($id))
				{
					if(file_exists($category->photo))
					{
						unlink($category->photo);
					}
					echo json_encode(array('response' => 'success', 'message' => 'The category was deleted successfully!'));
					return;
				}
				else
				{
					echo json_encode(array('response' => 'error', 'message' => 'The category cannot be deleted.'));
					return;
				}

			}
			else
			{
				echo json_encode(array('response' => 'error', 'message' => 'The category cannot be deleted because it has child categories.'));
				return;
			}
		}
		else
		{
			echo json_encode(array('response' => 'error', 'message' => 'Category not found'));
			return;
		}
	}

	public function editForm($id)
	{
		$data['login'] = (isset($_SESSION['userID'])) ? TRUE : FALSE;
		$data['category'] = $this->category->getById($id);
		$data['categories'] = $this->category->getAll();
		$this->load->view('dashboardHeader', $data);
		$this->load->view('categoriesForm', $data);
		$this->load->view('footer');
	}

	public function edit()
	{
		if($this->input->server('REQUEST_METHOD', TRUE) != 'POST')
		{
			show_404();
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|max_length[20]', array('required' => 'This fiield "%s" is required.', 'max_length' => 'This field "%s" has more than 32 characters.')
		);
		if(!$this->form_validation->run())
		{
			$errors = validation_errors();
			echo json_encode(array('response' => 'error', 'message' => $errors));
			return;
		}
		$id = $this->input->post('id', TRUE);
		$data['name'] = $this->input->post('name', TRUE);
		$data['parent_id'] = $this->input->post('parent', TRUE);
		$category = $this->category->getById($id);
		if($category)
		{
			try
			{
				$this->category->update($id, $data);
				if($_FILES['photo']['name'] != '')
				{
					$config['upload_path'] = './uploads/categories/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = 100;
					$config['max_width'] = 1024;
					$config['max_height'] = 768;
					$this->load->library('upload');
					$this->upload->initialize($config);
					if(!$this->upload->do_upload('photo'))
					{
						$error = $this->upload->display_errors();
						echo json_encode(array('response' => 'error', 'message' => $error));
						return;
					}
					else
					{
						$data = $this->upload->data();
						$this->category->update($id, array('photo' => 'uploads/categories/' . $data['file_name']));
					}
				}
				echo json_encode(array('response' => 'success', 'title' => 'updated category', 'message' => 'The category was updated correctly.'));
				return;
			}
			catch(Exception $e)
			{
				echo json_encode(array('response' => 'error', 'message' => 'An error occurred while trying to update the category.'));
				return;
			}
		}


	}

	public function view($id)
	{
		$category = $this->category->getById($id);
		if($category)
		{
			$category->photo = base_url().$category->photo;
			echo json_encode(array('response' => 'success', 'result' => $category));
			return;
		}
		else
		{
			echo json_encode(array('response' => 'error', 'message' => 'Category not found'));
			return;
		}
	}

	private function _order_categories($parent = 0, $temp = '', $lvl = 0)
	{
		if (!is_array($temp))
		{
			$temp = array();
		}
		$list = $this->category->getAllPaginator($parent);
		if(count($list) > 0)
		{
			foreach($list as $l)
			{
				$l->lvl = ($lvl > 0 ) ? 'style="padding-left: '.$lvl.'.5em;'.'"' : '';
				$temp[] = $l;
				$temp = $this->_order_categories($l->id, $temp, $lvl + 1);
			}
		}
		return $temp;
	}
}
