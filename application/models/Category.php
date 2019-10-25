<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Category extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function delete($categoryId)
	{
		return $this->db->delete('categories', array('id' => $categoryId));
	}

	public function getAll()
	{
		$this->db->order_by('name', 'ASC');
		$query = $this->db->get('categories');
		$rows = $query->result();
		return $rows;
	}

	public function getAllPaginator($parent = 0)
	{
		$this->db->where('parent_id', $parent);
		$this->db->order_by('name', 'ASC');
		$query = $this->db->get('categories');
		return $query->result();
	}

	public function getNumCategories()
	{
		return $this->db->count_all_results('categories');
	}

	public function getById($categoryId)
	{
		$this->db->where('id', $categoryId);
		$query = $this->db->get('categories');
		$row = $query->row();
		return $row;
	}

	public function insert($data)
	{
		$this->db->insert('categories', $data);
		return $this->db->insert_id();
	}

	public function isIterasable($categoryId)
	{
		$this->db->where('parent_id', $categoryId);
		$query = $this->db->get('categories');
		$result = count($query->result());
		return ($result > 0) ? FALSE : TRUE;
	}
	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('categories', $data);
	}
}
