<?php

class ContactMessageModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('contact_messages', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('contact_messages');
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('contact_messages', $data);
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('contact_messages');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function count()
	{
		return $this->db->count_all('contact_messages');
	}

	public function get($per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('contact_messages');
		$this->db->order_by('is_read', 'asc');
		$this->db->order_by('date', 'asc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}
}
