<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan extends CI_Controller {
	
	function index()
	{
		$this->delete();
		$this->load->library('database_library');
		$this->database_library->pake_table('obat');
		$data['isdata']=$this->database_library->ambil_data();
		$this->load->view('apotik/penjualanview',$data);
	}
	
	function add()
	{

		$kodeobat=$this->input->get('kodeobat', TRUE);
		$namaobat=$this->input->get('namaobat', TRUE);
		$jumlah=$this->input->get('jumlah', TRUE);
		$hargabeli=$this->input->get('hargabeli', TRUE);
		$hargajual=$this->input->get('hargajual', TRUE);
		$data = array(
               'id'      => $kodeobat,
               'name'     => $namaobat,
               'qty'   => $jumlah,
               'price'    => $hargajual,
			   'jual'    => $hargabeli,
            );

$this->cart->insert($data); 
	}
	
	function lihat()
	{
		$this->load->view('apotik/cartjual');
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
		$this->load->model('apotik/penjualanmodel','beli');
		$this->load->library('database_library');		
		$idunik=$this->database_library->nomor_urut("penjualan_apotik_rs","id_penjualan_apotik_rs","APRS-");
		$tgl=$this->input->post('tgl');
		$nomr=$this->input->post('nomr');
		$nama=$this->input->post('nama');
		$idkatpasien=$this->input->post('tipe');
		$jenisrawat=$this->input->post('jenisrawat');
		$this->beli->tambahjual($idunik,$tgl,$nomr,$nama,$idkatpasien,$jenisrawat);
		$this->beli->tambahjualdetail($idunik,$tgl,$nomr);	
		
		redirect('apotik/laporan/fakturjualrs?id='.$idunik.'');
		
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