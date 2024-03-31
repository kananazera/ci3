<?php

class OrderStatusModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('order_statuses', $data);
	}

	public function update($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('order_statuses');
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('order_statuses');
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('order_statuses');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function get()
	{
		$this->db->select('*');
		$this->db->from('order_statuses');
		$this->db->order_by('name', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function count()
	{
		return $this->db->count_all('order_statuses');
	}
}
