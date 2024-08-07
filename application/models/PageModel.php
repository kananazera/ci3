<?php

class PageModel extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('pages', $data);
	}

	public function update($id, $data)
	{
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('pages');
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('pages');
	}

	public function show($id)
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function get($per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->order_by('slug', 'asc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function search($search, $per_page, $offset)
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->like('slug', $search);
		$this->db->or_like('title', $search);
		$this->db->or_like('content', $search);
		$this->db->order_by('slug', 'asc');
		$this->db->limit($per_page, $offset);
		$query = $this->db->get();
		return $query->result();
	}

	public function page($slug, $lang = null)
	{
		$lang = ($lang == null) ? $this->config->item('language') : $lang;

		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('slug', $slug);
		$this->db->where('lang', $lang);
		$query = $this->db->get();
		return ($query->num_rows() == 1) ? $query->row() : false;
	}

	public function getPageById($id)
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getMainPages()
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('type !=', 'default');
		$this->db->where('page_id', null);
		$this->db->where('is_active', true);
		$query = $this->db->get();
		return $query->result();
	}

	public function getNavigationPages($lang = null)
	{
		$lang = ($lang == null) ? $this->config->item('language') : $lang;

		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('lang', $lang);
		$this->db->where('type', 'navigation');
		$this->db->where('page_id', null);
		$this->db->where('is_active', true);
		$query = $this->db->get();
		return $query->result();
	}

	public function getFooterPages($lang = null)
	{
		$lang = ($lang == null) ? $this->config->item('language') : $lang;

		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('lang', $lang);
		$this->db->where('type', 'footer');
		$this->db->where('page_id', null);
		$this->db->where('is_active', true);
		$query = $this->db->get();
		return $query->result();
	}

	public function getPagesByPageId($page_id, $lang = null)
	{
		$lang = ($lang == null) ? $this->config->item('language') : $lang;

		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('lang', $lang);
		$this->db->where('page_id', $page_id);
		$this->db->where('is_active', true);
		$query = $this->db->get();
		return $query->result();
	}

	public function count($search = null)
	{
		if ($search) {
			return $this->db->like('title', $search)->or_like('content', $search)->from('pages')->count_all_results();
		} else {
			return $this->db->count_all('pages');
		}
	}
}
