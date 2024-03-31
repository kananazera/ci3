<?php

class UserModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('users', $data);
	}

	public function update($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('users');
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('users');
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function login($data)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $data['email']);
		$this->db->where('password', md5($data['password']));
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function check($email)
	{
		$this->db->select('id, email');
		$this->db->from('users');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function get($per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function search($search, $per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->like('name', $search);
		$this->db->or_like('email', $search);
		$this->db->or_like('mobile_number', $search);
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function count($search = null)
	{
		if ($search) {
			return $this->db->like('name', $search)->or_like('email', $search)->or_like('mobile_number', $search)->from('users')->count_all_results();
		} else {
			return $this->db->count_all('users');
		}
	}

	public function getUsers()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('is_active', true);
		$query = $this->db->get();
		return $query->result();
	}
}
