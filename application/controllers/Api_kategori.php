<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kategori_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->kategori_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert()
	{
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required'); 

		if($this->form_validation->run())
		{
			$data = array(
				'id_kategori'	=>	$this->input->post('id_kategori'),
				'nama_kategori'	=>	$this->input->post('nama_kategori'), 
			);

			$this->kategori_model->insert_api($data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'nama_kategori_error'		=>	form_error('nama_kategori'),
				'harga_error'		=>	form_error('harga'),
				'kategori_id_error'		=>	form_error('kategori_id'),
				'id_kategori_error'		=>	form_error('id_kategori'),
				'status_id_error'		=>	form_error('status_id'),
			);
		}
		echo json_encode($array);
	}
	
	function fetch_single()
	{
		if($this->input->post('id'))
		{
			$data = $this->kategori_model->fetch_single_user($this->input->post('id'));

			foreach($data as $row)
			{
				
				$output['id_kategori'] = $row['id_kategori'];
				$output['nama_kategori'] = $row['nama_kategori'];  
				
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');  

		if($this->form_validation->run())
		{	
			$data = array(
				'nama_kategori'	=>	$this->input->post('nama_kategori')
			);

			$this->kategori_model->update_api($this->input->post('id_kategori'), $data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'				=>	true,
				'nama_kategori_error'	=>	form_error('nama_kategori'),
				'harga_error'	=>	form_error('harga'),
				'kategori_id_error'		=>	form_error('kategori_id')
			);
		}
		echo json_encode($array);
	}

	function delete()
	{
		if($this->input->post('id'))
		{
			if($this->kategori_model->delete_single_user($this->input->post('id')))
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