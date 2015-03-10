<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amprah extends CI_Controller {
	
	function index()
	{
		$this->delete();
		$this->load->library('database_library');
		$this->database_library->pake_table('obat');
		$data['isdata']=$this->database_library->ambil_data();
		$this->load->view('gudang/amprahview',$data);
	}
	
	function add()
	{
		//$data = array(
//               'kodeobat' => $this->input->post('kodeobat'),
//               'namaobat' => $this->input->post('namaobat'),
//			   'jumlah'     => $this->input->post('jumlah'),
//               'amprah'   => $this->input->post('hargaamprah'),
//               'jual'    => $this->input->post('hargajual'),               
//            );
//
//		$this->cart->insert($data); 
		$kodeobat=$this->input->get('kodeobat', TRUE);
		$namaobat=$this->input->get('kodeobat', TRUE);
		$jumlah=$this->input->get('jumlah', TRUE);
		$data = array(
               'id'      => $kodeobat,
               'name'     => $namaobat,
               'qty'   => $jumlah,
               'price'    => 1,
            );

$this->cart->insert($data); 
	}
	
	function lihat()
	{
		$this->load->view('gudang/cartamprah');
	}
	
	function delete()
	{
		$this->cart->destroy();
	}
	
	function deleteitem()
	{
		$id=$_GET['id'];
		$data = array(
		'id'   => $id,
		'qty'     => 0
		);
	}
	
	function checkout()
	{
		$this->load->model('gudang/amprahmodel','amprah');
		$idunik=unik_id();
		$koderuang=$this->input->post('koderuang');
		$tgl=$this->input->post('tgl');
		$keterangan=$this->input->post('keterangan');
		$this->amprah->tambahamprah($idunik,$tgl,$koderuang,$keterangan);
		$this->amprah->tambahamprahdetail($idunik,$tgl);	
		
		redirect('gudang/amprah');
		
	}
		
}
