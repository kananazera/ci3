<?php

class ContactMessageModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('contact_messages', $data);
	}
}
