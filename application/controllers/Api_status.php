<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_status extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('status_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->status_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert()
	{
		$this->form_validation->set_rules('nama_status', 'Nama status', 'required'); 

		if($this->form_validation->run())
		{
			$data = array(
				'id_status'	=>	$this->input->post('id_status'),
				'nama_status'	=>	$this->input->post('nama_status'), 
			);

			$this->status_model->insert_api($data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'nama_status_error'		=>	form_error('nama_status'),
				'harga_error'		=>	form_error('harga'),
				'status_id_error'		=>	form_error('status_id'),
				'id_status_error'		=>	form_error('id_status'),
				'status_id_error'		=>	form_error('status_id'),
			);
		}
		echo json_encode($array);
	}
	
	function fetch_single()
	{
		if($this->input->post('id'))
		{
			$data = $this->status_model->fetch_single_user($this->input->post('id'));

			foreach($data as $row)
			{
				
				$output['id_status'] = $row['id_status'];
				$output['nama_status'] = $row['nama_status'];  
				
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		$this->form_validation->set_rules('nama_status', 'Nama status', 'required');  

		if($this->form_validation->run())
		{	
			$data = array(
				'nama_status'	=>	$this->input->post('nama_status')
			);

			$this->status_model->update_api($this->input->post('id_status'), $data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'				=>	true,
				'nama_status_error'	=>	form_error('nama_status'),
				'harga_error'	=>	form_error('harga'),
				'status_id_error'		=>	form_error('status_id')
			);
		}
		echo json_encode($array);
	}

	function delete()
	{
		if($this->input->post('id'))
		{
			if($this->status_model->delete_single_user($this->input->post('id')))
			{
				$array = array(

					'success'	=>	true
				);
			}
			else
			{
				$array = array(
					'error'		=>	true
				);
			}
			echo json_encode($array);
		}
	}

}


?>