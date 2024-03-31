<?php

class ProductImageModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('product_images', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('product_images');
	}

	public function update($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('product_images');
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function updateAllImagesMain()
	{
		$this->db->set(array('main' => 0));
		$this->db->update('product_images');
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('product_images');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function get($product_id)
	{
		$this->db->select('*');
		$this->db->from('product_images');
		$this->db->where('product_id', $product_id);
		$this->db->order_by('main', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getMainImage($product_id)
	{
		$this->db->select('image');
		$this->db->from('product_images');
		$this->db->where('product_id', $product_id);
		$this->db->order_by('main', 'desc');
		$this->db->limit( 1);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}
}
