<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transfer extends CI_Controller {
	
	function index()
	{		
		$this->load->view('gudang/transferview');
	}
	
	function add()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('apotik','required');
		if($this->secure_library->start_post()==true)
		{
			$this->load->model('gudang/transfermodel');
			$tgl=$this->input->post('tgl');
			$idobat=$this->input->post('kode');
			$apotik=$this->input->post('apotik');
			$qty=$this->input->post('qty');
			$this->transfermodel->aksitransfer($tgl,$idobat,$apotik,$qty);
			$this->session->set_flashdata('info','Sukses ditambahkan');
			redirect('gudang/transfer');
		}else{
			die('error');
		}
	}
}