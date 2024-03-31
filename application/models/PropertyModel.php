<?php

class PropertyModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('product_properties', $data);
	}

	public function update($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('product_properties');
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('product_properties');
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('product_properties');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function get($per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('product_properties');
		$this->db->order_by('name', 'asc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function search($search, $per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('product_properties');
		$this->db->like('name', $search);
		$this->db->order_by('name', 'asc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function getProperties()
	{
		$this->db->select('*');
		$this->db->from('product_properties');
		$query = $this->db->get();
		return $query->result();
	}

	public function count($search = null)
	{
		if ($search) {
			return $this->db->like('name', $search)->from('product_properties')->count_all_results();
		} else {
			return $this->db->count_all('product_properties');
		}
	}
}
