<?php

class CountryModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('countries', $data);
	}

	public function update($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('countries');
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('countries');
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('countries');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function get($per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('countries');
		$this->db->order_by('name', 'asc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function search($search, $per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('countries');
		$this->db->like('name', $search);
		$this->db->order_by('name', 'asc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function getCountries()
	{
		$this->db->select('*');
		$this->db->from('countries');
		$query = $this->db->get();
		return $query->result();
	}

	public function count($search = null)
	{
		if ($search) {
			return $this->db->like('name', $search)->from('countries')->count_all_results();
		} else {
			return $this->db->count_all('countries');
		}
	}
}
