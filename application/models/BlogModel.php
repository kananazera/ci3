<?php

class BlogModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('blog', $data);
	}

	public function update($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('blog');
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('blog');
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function showBySlug($slug)
	{
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->where('slug', $slug);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function get($per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function search($search, $per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->like('title', $search);
		$this->db->or_like('content', $search);
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function searchActiveBlog($search, $per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->where('is_active', true);
		$this->db->like('title', $search);
		$this->db->or_like('content', $search);
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function getActiveBlog($per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->where('is_active', true);
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllBlog()
	{
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->where('is_active', true);
		$query = $this->db->get();
		return $query->result();
	}

	public function getLastBlog()
	{
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->where('is_active', true);
		$this->db->order_by('id', 'desc');
		$this->db->limit(12);
		$query = $this->db->get();
		return $query->result();
	}

	public function getRandomBlog($id)
	{
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->where('is_active', true);
		$this->db->where_not_in('id', [$id]);
		$this->db->order_by('', 'random');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}

	public function count($search = null)
	{
		if ($search) {
			return $this->db->like('title', $search)->or_like('content', $search)->from('blog')->count_all_results();
		} else {
			return $this->db->count_all('blog');
		}
	}
}
