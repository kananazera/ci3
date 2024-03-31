<?php

class CommentModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('product_comments', $data);
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('product_comments', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('product_comments');
	}

	public function deleteByProductId($product_id)
	{
		$this->db->where('product_id', $product_id);
		return $this->db->delete('product_comments');
	}

	public function deleteByUserId($user_id)
	{
		$this->db->where('user_id', $user_id);
		return $this->db->delete('product_comments');
	}

	public function get($per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('product_comments');
		$this->db->order_by('is_active', 'asc');
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('product_comments');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function search($search, $per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('product_comments');
		$this->db->like('comment', $search);
		$this->db->order_by('is_active', 'asc');
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function getActiveComments($product_id, $per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('product_comments');
		$this->db->where('product_id', $product_id);
		$this->db->where('is_active', true);
		$this->db->order_by('id', 'desc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function count($search = null)
	{
		if ($search) {
			return $this->db->like('comment', $search)->from('product_comments')->count_all_results();
		} else {
			return $this->db->count_all('product_comments');
		}
	}

	public function commentCount($product_id)
	{
		return $this->db->where('product_id', $product_id)->where('is_active', true)->from('product_comments')->count_all_results();
	}
}
