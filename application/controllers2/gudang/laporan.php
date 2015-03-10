<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
	
	function fakturbeli()
	{
		$idunik=$_GET['id'];
		$this->load->library('database_library');
		$select=("pembelian_detail.id_transaksi, pembelian_detail.tanggal, obat.nama_obat, pembelian_detail.qty, pembelian_detail.harga_beli, pembelian_detail.harga_jual, supplier.nama_supplier");	
		$from=("(pembelian_detail LEFT JOIN supplier ON pembelian_detail.id_supplier = supplier.id_supplier) LEFT JOIN obat ON pembelian_detail.id_obat = obat.id_obat");
		$where=(array('pembelian_detail.id_transaksi'=>$idunik));		
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/fakturbeli',$data);
	}
	
	
	
	function repbeli()
	{

			$this->load->view('gudang/lapbeli');
	
	}
	
	function repamprah()
	{

			$this->load->view('gudang/lapamprah');
	
	}
	
	
	
	function repbelitanggal()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('tgl','required');
		$this->secure_library->filter_post('tgl2','required');
		$tgl1=$this->input->post('tgl');
		$tgl2=$this->input->post('tgl2');
		if($this->secure_library->start_post()==true)
		{
			$this->load->library('database_library');
		$select=("pembelian_detail.id_transaksi, pembelian_detail.tanggal, obat.nama_obat, pembelian_detail.qty, pembelian_detail.harga_beli, pembelian_detail.harga_jual, supplier.nama_supplier");	
		$from=("(pembelian_detail LEFT JOIN supplier ON pembelian_detail.id_supplier = supplier.id_supplier) LEFT JOIN obat ON pembelian_detail.id_obat = obat.id_obat");
		$where="pembelian_detail.tanggal BETWEEN '".$tgl1."' AND '".$tgl2."'";	
			$data['title']="Laporan Pembelian Periode ".$tgl1." hingga ".$tgl2;
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/repbeli',$data);		
		}
	}
	
	function repamprahtanggal()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('tgl','required');
		$this->secure_library->filter_post('tgl2','required');
		$tgl1=$this->input->post('tgl');
		$tgl2=$this->input->post('tgl2');
		if($this->secure_library->start_post()==true)
		{
			$this->load->library('database_library');
		$select=("ruangan.nama_ruangan, amprah.tgl, obat.nama_obat, amprah_detail.qty, amprah.keterangan");	
		$from=("((amprah_detail LEFT JOIN amprah ON amprah_detail.id_amprah = amprah.id_amprah) LEFT JOIN obat ON amprah_detail.id_obat = obat.id_obat) LEFT JOIN ruangan ON amprah.id_ruangan = ruangan.id_ruangan");
		$where="amprah.tgl BETWEEN '".$tgl1."' AND '".$tgl2."'";	
			$data['title']="Laporan Amrpah Periode ".$tgl1." hingga ".$tgl2;
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/repamprah',$data);		
		}
	}
	
	
	
	function repbelicari()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('key','required');
		$this->secure_library->filter_post('value','required');
		$key=$this->input->post('key');
		$value=$this->input->post('value');
		if($this->secure_library->start_post()==true)
		{
			$this->load->library('database_library');
		$select=("pembelian_detail.id_transaksi, pembelian_detail.tanggal, obat.nama_obat, pembelian_detail.qty, pembelian_detail.harga_beli, pembelian_detail.harga_jual, supplier.nama_supplier");	
		$from=("((pembelian_detail LEFT JOIN supplier ON pembelian_detail.id_supplier = supplier.id_supplier) LEFT JOIN obat ON pembelian_detail.id_obat = obat.id_obat) LEFT JOIN kategori_obat ON obat.id_kategori_obat = kategori_obat.id_kategori_obat");
	//	$where=$key."='".$value."'";		
	$where=array($key=>$value);
	$data['title']="Laporan Pembelian berdasarkan ".ucfirst($value);
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/repbeli',$data);		
		}
	}
	
	function infostok()
	{
		$this->load->view('gudang/infostokcari');
	}
	
	function repsisastok()
	{
		$this->load->library('secure_library');		
		$this->load->library('database_library');
		$key=$this->input->post('key');
		$value=$this->input->post('value');
		$select="obat.id_obat, obat.nama_obat, satuan_obat.nama_satuan, kategori_obat.nama_kategori, obat.harga_jual,obat.kadaluarsa, (obat.stok_akhir)-(obat.stok_rs+obat.stok_pelengkap) as jumlah,obat.min_order";
		$from="(obat LEFT JOIN kategori_obat ON obat.id_kategori_obat = kategori_obat.id_kategori_obat) LEFT JOIN satuan_obat ON obat.id_satuan_obat = satuan_obat.id_satuan_obat";
		$where=$key." LIKE '%".$value."%'";
		$data['title']="Laporan Stok Gudang ".ucfirst($value);
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/stokgudang',$data);
	}
	
	function reptransfer()
	{
		$this->load->view('gudang/laptransfer');
	}
	
	function reptransfertgl()
	{
		$this->load->library('secure_library');		
		$this->load->library('database_library');
		$tgl1=$this->input->post('tgl');
		$tgl2=$this->input->post('tgl2');
		$select="transfer_obat.id_transfer_obat, transfer_obat.apotik, obat.nama_obat, transfer_obat.qty,transfer_obat.tanggal";
		$from="transfer_obat LEFT JOIN obat ON transfer_obat.id_obat = obat.id_obat";
		$where="transfer_obat.tanggal BETWEEN '".$tgl1."' AND '".$tgl2."'";
		$data['title']="Laporan Transfer Periode ".$tgl1." hingga ".$tgl2;
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/reptransfer',$data);
	}
	
	function reptransferkey()
	{
		$this->load->library('secure_library');		
		$this->load->library('database_library');
		$key=$this->input->post('key');
		$value=$this->input->post('value');
		$select="transfer_obat.id_transfer_obat, transfer_obat.apotik, obat.nama_obat, transfer_obat.qty,transfer_obat.tanggal";
		$from="transfer_obat LEFT JOIN obat ON transfer_obat.id_obat = obat.id_obat";
		$where=array($key=>$value);
		if($value=="rs")
		{
			$value="Apotik Rumah Sakit";
		}elseif($value=="pelengkap")
		{
			$value="Apotik Rumah Sakit";
		}
		$data['title']="Laporan Transfer berdasarkan ".ucfirst($value);
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/reptransfer',$data);
	}
}