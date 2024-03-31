<?php

class ProductModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('products', $data);
	}

	public function update($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('products');
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('products');
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function showBySlug($slug)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('slug', $slug);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function searchByCategoryId($category_id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('category_id', $category_id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function get($per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function search($search, $per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->like('title', $search);
		$this->db->or_like('description', $search);
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function searchActiveProducts($search, $per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('is_active', true);
		$this->db->like('title', $search);
		$this->db->or_like('description', $search);
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function getProducts()
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('is_active', true);
		$query = $this->db->get();
		return $query->result();
	}

	public function getLastProducts()
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('is_active', true);
		$this->db->order_by('id', 'desc');
		$this->db->limit(12);
		$query = $this->db->get();
		return $query->result();
	}

	public function getDiscountProducts()
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('is_active', true);
		$this->db->order_by('discount_rate', 'desc');
		$this->db->limit(12);
		$query = $this->db->get();
		return $query->result();
	}

	public function getActiveProducts($per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('is_active', true);
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function count($search = null)
	{
		if ($search) {
			return $this->db->like('title', $search)->or_like('description', $search)->from('products')->count_all_results();
		} else {
			return $this->db->count_all('products');
		}
	}
}
