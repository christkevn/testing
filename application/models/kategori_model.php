<?php
class kategori_model extends CI_Model
{
	function fetch_all()
	{
		return $this->db->get('kategori'); 
	}

	function insert_api($data)
	{
		$this->db->insert('kategori', $data);
	}

	function fetch_single_user($user_id)
	{
		$this->db->where('id_kategori', $user_id);
		$query = $this->db->get('kategori');
		return $query->result_array();
	}

	function update_api($user_id, $data)
	{
		$this->db->where('id_kategori', $user_id);
		$this->db->update('kategori', $data);
	}

	function delete_single_user($user_id)
	{
		$this->db->where('id_kategori', $user_id);
		$this->db->delete('kategori');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

?>