<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class User extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getAll()
	{
		$this->db->select('id, username, admin, last_login');
		$this->db->order_by('username', 'ASC');
		$query = $this->db->get('users');
		$rows = $query->result();
		return $rows;
	}

	public function getAllPaginator($limit = PAGER, $offset = 0)
	{
		$this->db->select('id, username, admin, last_login');
		$this->db->order_by('username', 'ASC');
		$this->db->limit($limit, $offset);
		$query = $this->db->get('users');
		return $query->result();
	}

	public function getNumUsers()
	{
		return $this->db->count_all_results('users');
	}

	public function getUserByUsername($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('users');
		$row = $query->row();
		return $row;
	}
}
