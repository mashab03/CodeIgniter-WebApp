<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan extends CI_Controller {
	
	function index()
	{
		$this->delete();
		$this->load->library('database_library');
		$this->database_library->pake_table('obat');
		$data['isdata']=$this->database_library->ambil_data();
		$this->load->view('apotikext/penjualanview',$data);
	}
	
	function add()
	{

		$kodeobat=$this->input->get('kodeobat', TRUE);
		$namaobat=$this->input->get('kodeobat', FALSE);
		$jumlah=$this->input->get('jumlah', TRUE);
		$hargabeli=$this->input->get('hargabeli', TRUE);
		$hargajual=$this->input->get('hargajual', TRUE);
		$jenisresep=$this->input->get('jenisresep', TRUE);
		$jasaresep=$this->input->get('jasaresep', TRUE);
		$biayajasa=$this->input->get('biayajasa', TRUE);
		$data = array(
               'id'      => $kodeobat,
               'name'     => $namaobat,
               'qty'   => $jumlah,
               'price'    => $hargajual,
			   'jual'    => $hargabeli,
			   'jenisresep'=>$jenisresep,
			   'jasaresep'=>$jasaresep,
			   'biayajasa'=>$biayajasa,
            );

$this->cart->insert($data); 
	}
	
	function lihat()
	{
		$this->load->view('apotikext/cartjual');
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
		$this->load->library('database_library');
		$this->load->model('apotikext/penjualanmodel','beli');
		$idunik=$this->database_library->nomor_urut("penjualan_apotik_pelengkap","id_penjualan_apotik_pelengkap","APPL-");
		$tgl=$this->input->post('tgl');
		$nama=$this->input->post('nama');
		$keterangan=$this->input->post('keterangan');
		$qty_racikan=$this->input->post('qty_racikan');
		$biayajasa=$this->input->post('biayajasa');
		
		$this->beli->tambahjual($idunik,$tgl,$nama,$keterangan,$qty_racikan,$biayajasa);
		$this->beli->tambahjualdetail($idunik,$tgl);	
		
		redirect('apotikext/laporan/fakturjualpelengkap?id='.$idunik.'');
		
	}
	
	
}