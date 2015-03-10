<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
	function fakturjualpelengkap()
	{
		$idunik=$_GET['id'];
		$this->load->library('database_library');
		$this->database_library->pake_table('penjualan_apotik_pelengkap');
		$arraysearch=array(
			'id_penjualan_apotik_pelengkap'=>$idunik,
			);
		$data['info']=$this->database_library->ambil_data_array($arraysearch);
		$select=("penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap, penjualan_apotik_pelengkap_detail.tanggal, penjualan_apotik_pelengkap_detail.qty, penjualan_apotik_pelengkap_detail.harga_jual, obat.nama_obat, penjualan_apotik_pelengkap.Nama");	
		
		$from=("(penjualan_apotik_pelengkap RIGHT JOIN (penjualan_apotik_pelengkap_detail LEFT JOIN obat ON penjualan_apotik_pelengkap_detail.id_obat = obat.id_obat) ON penjualan_apotik_pelengkap.id_penjualan_apotik_pelengkap = penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap)");
		
		$where=(array('penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap'=>$idunik));		
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/fakturjualpelengkap',$data);
	}
	
	function repsisastok()
	{
		$this->load->library('secure_library');		
		$this->load->library('database_library');
		$select="obat.id_obat, obat.nama_obat, satuan_obat.nama_satuan, obat.harga_jual, obat.stok_pelengkap as jumlah";
		$from="obat LEFT JOIN satuan_obat ON obat.id_satuan_obat = satuan_obat.id_satuan_obat";
		$where=array('obat.id_obat > '=>'0');
		$data['title']="Laporan Stok Apotik Pelengkap";
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/stokapotikpelengkap',$data);
	}
	
	function repjualperiode()
	{
		$this->load->library('secure_library');
		$this->load->library('database_library');
		$this->secure_library->filter_post('tgl','required');
		$this->secure_library->filter_post('tgl2','required');
		$tgl1=$this->input->post('tgl');
		$tgl2=$this->input->post('tgl2');
		if($this->secure_library->start_post()==true)
		{
			$select="penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap, penjualan_apotik_pelengkap_detail.tanggal, obat.nama_obat, penjualan_apotik_pelengkap_detail.qty, penjualan_apotik_pelengkap_detail.harga_jual, penjualan_apotik_pelengkap.Nama, penjualan_apotik_pelengkap.keterangan";
		$from="(penjualan_apotik_pelengkap LEFT JOIN penjualan_apotik_pelengkap_detail ON penjualan_apotik_pelengkap.id_penjualan_apotik_pelengkap = penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap) LEFT JOIN obat ON penjualan_apotik_pelengkap_detail.id_obat = obat.id_obat";
		$where="penjualan_apotik_pelengkap_detail.tanggal BETWEEN '".$tgl1."' AND '".$tgl2."'";	
		$data['title']="Laporan penjualan apotik Pelengkap periode<br>".$tgl1." hingga ".$tgl2;	
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/jualapotikpelengkap',$data);
		}else{
			$this->load->view('apotikext/carilapjual');
		}
	}
}