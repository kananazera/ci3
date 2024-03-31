<?php

class OrderModel extends CI_Model
{
	public function update($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('orders');
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function get($per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function search($search, $per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->like('data', $search);
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function searchByStatusId($status_id)
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('status_id', $status_id);
		$query = $this->db->get();
		return ($query->num_rows()) ? $query->row() : false;
	}

	public function count($search = null)
	{
		if ($search) {
			return $this->db->like('data', $search)->from('orders')->count_all_results();
		} else {
			return $this->db->count_all('orders');
		}
	}
}
