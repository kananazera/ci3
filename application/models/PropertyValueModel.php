<?php

class PropertyValueModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('product_property_values', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('product_property_values');
	}

	public function deleteByProductId($product_id)
	{
		$this->db->where('product_id', $product_id);
		return $this->db->delete('product_property_values');
	}

	public function searchByPropertyId($property_id)
	{
		$this->db->select('*');
		$this->db->from('product_property_values');
		$this->db->where('property_id', $property_id);
		$query = $this->db->get();
		return ($query->num_rows()) ? $query->row() : false;
	}

	public function get($product_id)
	{
		$this->db->select('*');
		$this->db->from('product_property_values');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function count()
	{
		return $this->db->count_all('product_property_values');
	}
}
