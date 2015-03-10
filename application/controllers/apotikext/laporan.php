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
		$select=("penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap, penjualan_apotik_pelengkap_detail.tanggal, penjualan_apotik_pelengkap_detail.qty, penjualan_apotik_pelengkap_detail.harga_jual, obat.nama_obat, penjualan_apotik_pelengkap.Nama,penjualan_apotik_pelengkap_detail.tipe,penjualan_apotik_pelengkap_detail.jasatipe,penjualan_apotik_pelengkap.qty_racikan,penjualan_apotik_pelengkap.biayajasa");	
		
		$from=("(penjualan_apotik_pelengkap RIGHT JOIN (penjualan_apotik_pelengkap_detail LEFT JOIN obat ON penjualan_apotik_pelengkap_detail.id_obat = obat.id_obat) ON penjualan_apotik_pelengkap.id_penjualan_apotik_pelengkap = penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap)");
		
		$where=(array('penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap'=>$idunik));		
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/fakturjualpelengkap',$data);
	}
	
	function infostok()
	{
		$this->load->view('apotikext/infostokcari');
	}
	
	function repsisastok()
	{
		$this->load->library('secure_library');		
		$this->load->library('database_library');
		$select="obat.id_obat, obat.nama_obat, satuan_obat.nama_satuan, obat.harga_beli, obat.harga_jual, obat.stok_pelengkap as jumlah, obat.min_order";
		$key=$this->input->post('key');
		$value=$this->input->post('value');
		$from="obat LEFT JOIN satuan_obat ON obat.id_satuan_obat = satuan_obat.id_satuan_obat ORDER BY obat.nama_obat asc";
		$where=$key." LIKE '%".$value."%' ";
		$data['title']="Laporan Stok Apotik Pelengkap ".ucfirst($value);
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
			$key=$this->input->post('key');
			$value=$this->input->post('value');
			$select="penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap, penjualan_apotik_pelengkap_detail.tanggal, obat.nama_obat, penjualan_apotik_pelengkap_detail.qty, penjualan_apotik_pelengkap_detail.harga_jual, penjualan_apotik_pelengkap.Nama, penjualan_apotik_pelengkap.keterangan";
		$from="((penjualan_apotik_pelengkap LEFT JOIN penjualan_apotik_pelengkap_detail ON penjualan_apotik_pelengkap.id_penjualan_apotik_pelengkap = penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap) LEFT JOIN obat ON penjualan_apotik_pelengkap_detail.id_obat = obat.id_obat) LEFT JOIN kategori_obat ON obat.id_kategori_obat = kategori_obat.id_kategori_obat";
		$where="penjualan_apotik_pelengkap_detail.tanggal BETWEEN '".$tgl1."' AND '".$tgl2."'  AND $key LIKE '%$value%'
		ORDER BY obat.nama_obat desc";	
		$data['title']="Laporan penjualan apotik Pelengkap periode<br>".$tgl1." hingga ".$tgl2;	
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/jualapotikpelengkap',$data);
		}else{
			$this->load->view('apotikext/carilapjual');
		}
	}
	
	function repjualkey()
	{
		$this->load->library('secure_library');
		$this->load->library('database_library');
		$this->secure_library->filter_post('key','required');
		$key=$this->input->post('key');
		$value=$this->input->post('value');
		if($this->secure_library->start_post()==true)
		{
			$select="penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap, penjualan_apotik_pelengkap_detail.tanggal, obat.nama_obat, penjualan_apotik_pelengkap_detail.qty, penjualan_apotik_pelengkap_detail.harga_jual, penjualan_apotik_pelengkap.Nama, penjualan_apotik_pelengkap.keterangan, kategori_obat.nama_kategori";
		$from="((penjualan_apotik_pelengkap LEFT JOIN penjualan_apotik_pelengkap_detail ON penjualan_apotik_pelengkap.id_penjualan_apotik_pelengkap = penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap) LEFT JOIN obat ON penjualan_apotik_pelengkap_detail.id_obat = obat.id_obat) LEFT JOIN kategori_obat ON obat.id_kategori_obat = kategori_obat.id_kategori_obat";
		$where=$key." LIKE '%".$value."%'";
		$data['title']="Laporan penjualan apotik Pelengkap ".ucfirst($value);	
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/jualapotikpelengkap',$data);
		}else{
			$this->load->view('apotikext/carilapjual');
		}
	}
	
	function reprekap()
	{
		$this->load->view('apotikext/rekapfakturcari');
	}
	
	function reprekaptanggal()
	{
			
		$tgl1=$this->input->post('tgl');
		$tgl2=$this->input->post('tgl2');
		$this->load->library('database_library');
		$this->database_library->pake_table('penjualan_apotik_pelengkap');		
		
		
		$select="obat.nama_obat, penjualan_apotik_pelengkap_detail.qty, penjualan_apotik_pelengkap_detail.harga_jual, (penjualan_apotik_pelengkap_detail.qty*penjualan_apotik_pelengkap_detail.harga_jual) AS subtotal, penjualan_apotik_pelengkap.tanggal, penjualan_apotik_pelengkap.Nama";	
		
		$from="(penjualan_apotik_pelengkap_detail LEFT JOIN penjualan_apotik_pelengkap ON penjualan_apotik_pelengkap_detail.id_penjualan_apotik_pelengkap = penjualan_apotik_pelengkap.id_penjualan_apotik_pelengkap) LEFT JOIN obat ON penjualan_apotik_pelengkap_detail.id_obat = obat.id_obat";
		
		$arraysearch="penjualan_apotik_pelengkap_detail.tanggal BETWEEN '".$tgl1."' AND '".$tgl2."'";		
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$arraysearch);
		$this->load->view('laporan/reprekappelengkap',$data);
	}
}