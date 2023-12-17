<?php
class status_model extends CI_Model
{
	function fetch_all()
	{
		return $this->db->get('status'); 
	}

	function insert_api($data)
	{
		$this->db->insert('status', $data);
	}

	function fetch_single_user($user_id)
	{
		$this->db->where('id_status', $user_id);
		$query = $this->db->get('status');
		return $query->result_array();
	}

	function update_api($user_id, $data)
	{
		$this->db->where('id_status', $user_id);
		$this->db->update('status', $data);
	}

	function delete_single_user($user_id)
	{
		$this->db->where('id_status', $user_id);
		$this->db->delete('status');
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