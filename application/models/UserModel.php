<?php

class UserModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('users', $data);
	}

	public function update($user_id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $user_id);
		$this->db->update('users');
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function login($data)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $data['email']);
		$this->db->where('password', md5($data['password']));
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function getUser($user_id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $user_id);

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}
}
