<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->api_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert()
	{
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
		$this->form_validation->set_rules('harga', 'Hargaa', 'required|numeric');

		if($this->form_validation->run())
		{
			$data = array(
				'id_produk'	=>	$this->input->post('id_produk'),
				'nama_produk'	=>	$this->input->post('nama_produk'),
				'harga'		=>	$this->input->post('harga'),
				'kategori_id'		=>	$this->input->post('kategori_id'),
				'status_id'		=>	$this->input->post('status_id')
			);

			$this->api_model->insert_api($data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'nama_produk_error'		=>	form_error('nama_produk'),
				'harga_error'		=>	form_error('harga'),
				'kategori_id_error'		=>	form_error('kategori_id'),
				'id_produk_error'		=>	form_error('id_produk'),
				'status_id_error'		=>	form_error('status_id'),
			);
		}
		echo json_encode($array);
	}
	
	function fetch_single()
	{
		if($this->input->post('id'))
		{
			$data = $this->api_model->fetch_single_user($this->input->post('id'));

			foreach($data as $row)
			{
				$output['nama_produk'] = $row['nama_produk'];
				$output['harga'] = $row['harga'];
				$output['kategori_id'] = $row['kategori_id']; 
				$output['id_produk'] = $row['id_produk'];
				$output['status_id'] = $row['status_id']; 
				
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required'); 
		$this->form_validation->set_rules('harga', 'Hargaa', 'required|numeric');  

		if($this->form_validation->run())
		{	
			$data = array(
				'nama_produk'	=>	$this->input->post('nama_produk'),
				'harga'		=>	$this->input->post('harga'),
				'kategori_id'		=>	$this->input->post('kategori_id'),
				'status_id'		=>	$this->input->post('status_id')
			);

			$this->api_model->update_api($this->input->post('id_produk'), $data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'				=>	true,
				'nama_produk_error'	=>	form_error('nama_produk'),
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
			if($this->api_model->delete_single_user($this->input->post('id')))
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