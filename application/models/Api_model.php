<?php
class Api_model extends CI_Model
{
	function fetch_all()
	{
		$id_status="";
		$query = $this->db->get_where("status",array("nama_status" => "bisa dijual"));
		foreach ($query->result_array() as $row){  $id_status=$row['id_status'];}
		return $this->db->get_where('produk',array('status_id' => $id_status)); 
	}

	function insert_api($data)
	{
		$this->db->insert('produk', $data);
	}

	function fetch_single_user($user_id)
	{
		$this->db->where('id_produk', $user_id);
		$query = $this->db->get('produk');
		return $query->result_array();
	}

	function update_api($user_id, $data)
	{
		$this->db->where('id_produk', $user_id);
		$this->db->update('produk', $data);
	}

	function delete_single_user($user_id)
	{
		$this->db->where('id_produk', $user_id);
		$this->db->delete('produk');
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