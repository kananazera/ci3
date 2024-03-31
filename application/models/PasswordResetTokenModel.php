<?php

class PasswordResetTokenModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('password_reset_tokens', $data);
	}

	public function check($email)
	{
		$this->db->select('email');
		$this->db->from('password_reset_tokens');
		$this->db->where('email', $email);
		$this->db->where('date', date('Y-m-d'));
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function get($token)
	{
		$this->db->select('*');
		$this->db->from('password_reset_tokens');
		$this->db->where('token', $token);
		$this->db->where('date', date('Y-m-d'));
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('password_reset_tokens');
	}
}
