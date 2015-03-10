<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian extends CI_Controller {
	
	function index()
	{
		$this->delete();
		$this->load->library('database_library');
		$this->database_library->pake_table('obat');
		$data['isdata']=$this->database_library->ambil_data();
		
		$this->load->view('gudang/pembelianview',$data);
	}
	
	function add()
	{
		//$data = array(
//               'kodeobat' => $this->input->post('kodeobat'),
//               'namaobat' => $this->input->post('namaobat'),
//			   'jumlah'     => $this->input->post('jumlah'),
//               'beli'   => $this->input->post('hargabeli'),
//               'jual'    => $this->input->post('hargajual'),               
//            );
//
//		$this->cart->insert($data); 
		$kodeobat=$this->input->get('kodeobat', TRUE);
		$namaobat=$this->input->get('kodeobat', TRUE);
		$jumlah=$this->input->get('jumlah', TRUE);
		$hargabeli=$this->input->get('hargabeli', TRUE);
		$hargajual=$this->input->get('hargajual', TRUE);
		$kadaluarsa=$this->input->get('kadaluarsa', TRUE);
		$data = array(
               'id'      => $kodeobat,
               'name'     => $namaobat,
               'qty'   => $jumlah,
               'price'    => $hargabeli,
			   'jual'    => $hargajual,
			   'tgl'	=>$kadaluarsa,
            );

$this->cart->insert($data); 
	}
	
	function lihat()
	{
		$this->load->view('gudang/cartbeli');
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
		$this->load->model('gudang/pembelianmodel','beli');
		$this->load->library('database_library');		
		$idunik=$this->database_library->nomor_urut("pembelian","id_transaksi","BL-");
		$idsup=$this->input->post('kodesup');
		$tgl=$this->input->post('tgl');
		$po=$this->input->post('po');
		$this->beli->tambahbeli($idunik,$idsup,$po,$tgl);
		$this->beli->tambahbelidetail($idunik,$tgl,$idsup,$po);	
		
		redirect('gudang/laporan/fakturbeli?id='.$idunik.'');
		
	}
	
	function faktur($idunik)
	{
		$this->db->select("pembelian_detail.id_transaksi, pembelian_detail.tanggal, obat.nama_obat, pembelian_detail.qty, pembelian_detail.harga_beli, pembelian_detail.harga_jual, supplier.nama_supplier");	
		$this->db->from("(pembelian_detail LEFT JOIN supplier ON pembelian_detail.id_supplier = supplier.id_supplier) LEFT JOIN obat ON pembelian_detail.id_obat = obat.id_obat");
		$this->db->where(array('pembelian_detail.id_transaksi'=>$idunik));
		$sql = $this->db->get();
		  $data['isdata']=$sql->result();
		$this->load->view('laporan/fakturbeli',$data);
	}
}
