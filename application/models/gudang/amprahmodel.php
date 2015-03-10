<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amprahmodel extends CI_Model {
	
	function tambahamprahdetail($idunik,$tgl)
	{
		$this->load->library('database_library');
			
		$noinvoice=$idunik;	
		foreach($this->cart->contents() as $items)
		{
			$this->database_library->pake_table('amprah_detail');
			$data=array(
				'id_amprah'=> $noinvoice,				
				'id_obat'=>$items['id'],
				'qty'=>$items['qty'],
					);
			$this->database_library->tambah_data($data);
			$this->database_library->pake_table('obat');
			$this->updateobat($items['id'],$items['qty']);
		}
	}
	
	function tambahamprah($idunik,$tgl,$idruang,$keterangan)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('amprah');	
		$noinvoice=$idunik;
		$data=array(
			'id_amprah'=>$noinvoice,
			'tgl'=>$tgl,
			'id_ruangan'=>$idruang,	
			'keterangan'=>$keterangan,		
			);
		$isok=$this->database_library->tambah_data($data);
		if($isok==true)
			{
				return true;
			}else{
				return false;
			}
	}
	
	function updateobat($idobat,$qty)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('obat');
		
		$arraysearch=array(
			'id_obat'=>$idobat,
			);
		$qtyakhir=$this->database_library->ambil_satu_custom($arraysearch,"stok_akhir");	
		$data=array(		
			'stok_akhir'=>$qtyakhir-$qty,
			);
		$isok=$this->database_library->ubah_data($arraysearch,$data);
		if($isok==true)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function fetch_amprah($limit,$start)
	{
		$this->load->library('database_library');
		$selectQuery="amprah.id_amprah, amprah.tgl, amprah.keterangan, ruangan.nama_ruangan";
		$fromQuery=" amprah LEFT JOIN ruangan ON amprah.id_ruangan = ruangan.id_ruangan";
		$arraywhere=array(
			'amprah.id_amprah !='=>'',
			);		
		$fieldorder='amprah.tgl';
		$ordervalue='asc';
		$isdata=$this->database_library->ambil_data_where_paging($selectQuery,$fromQuery,$arraywhere,$fieldorder,$ordervalue,$limit,$start);		
		if(!empty($isdata))
		{
			return $isdata;
		}else{
			return null;
		}
	}
	
	function fetch_amprah_info($id)
	{
		$this->load->library('database_library');
		$selectQuery="amprah.id_amprah, amprah.tgl, amprah.keterangan, ruangan.id_ruangan,ruangan.nama_ruangan";
		$fromQuery=" amprah LEFT JOIN ruangan ON amprah.id_ruangan = ruangan.id_ruangan";
		$arraywhere=array(
			'amprah.id_amprah ='=>$id,
			);		
		$fieldorder='amprah.tgl';
		$ordervalue='asc';
		$isdata=$this->database_library->ambil_data_where_paging($selectQuery,$fromQuery,$arraywhere,$fieldorder,$ordervalue,1,0);		
		if(!empty($isdata))
		{
			return $isdata;
		}else{
			return null;
		}
	}
	
	function fetch_amprah_edit($id)
	{
		$this->load->library('database_library');
		$selectQuery="amprah_detail.id_amprah,obat.id_obat,obat.nama_obat, amprah_detail.qty, amprah_detail.id_amprah";
		$fromQuery="amprah_detail LEFT JOIN obat ON amprah_detail.id_obat = obat.id_obat";
		$arraywhere=array(
			'amprah_detail.id_amprah ='=>$id,
			);			
		$isdata=$this->database_library->ambil_data_where_custom($selectQuery,$fromQuery,$arraywhere);		
		if(!empty($isdata))
		{
			return $isdata;
		}else{
			return null;
		}
	}
	
		
}