<?php

class SlideModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('slides', $data);
	}

	public function update($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('slides');
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('slides');
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('slides');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function getActiveSlides()
	{
		$this->db->select('*');
		$this->db->from('slides');
		$this->db->order_by('order', 'asc');
		$this->db->where('is_active', true);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllSlides()
	{
		$this->db->select('*');
		$this->db->from('slides');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
}
