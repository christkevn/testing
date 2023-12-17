<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori extends CI_Controller {

	function index()
	{
		$this->load->view('kategori_view');
	}

	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');

			if($data_action == "Delete")
			{
				$api_url = "http://localhost/testing/api_kategori/delete";

				$form_data = array(
					'id'		=>	$this->input->post('user_id')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;




			}

			if($data_action == "Edit")
			{
				$api_url = "http://localhost/testing/api_kategori/update";
				
				$form_data = array(
					'id_kategori'		=>	$this->input->post('id_kategori'),
					'nama_kategori'		=>	$this->input->post('nama_kategori')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response; 
			}

			if($data_action == "fetch_single")
			{
				$api_url = "http://localhost/testing/api_kategori/fetch_single";

				$form_data = array(
					'id'		=>	$this->input->post('user_id')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;






			}

			if($data_action == "Insert")
			{
				$api_url = "http://localhost/testing/api_kategori/insert";
			

				$form_data = array(
					'nama_kategori'		=>	$this->input->post('nama_kategori'), 
					'id_kategori'			=>	$this->input->post('id_kategori')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;


			} 

			if($data_action == "fetch_all")
			{
				$api_url = "http://localhost/testing/api_kategori";

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				$result = json_decode($response);

				$output = '';

				if(count($result) > 0)
				{
					foreach($result as $row)
					{
						$output .= '
						<tr>
							<td>'.$row->id_kategori.'</td>
							<td>'.$row->nama_kategori.'</td> 
							<td><butto type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_kategori.'">Edit</button></td>
							<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_kategori.'">Delete</button></td>
						</tr>

						';
					}
				}
				else
				{
					$output .= '
					<tr>
						<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}

				echo $output;
			}
		}
	}
	
}

?>