<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Returnsmodel extends CI_Model {
	
	function tambahreturnsdetail($idunik,$tgl,$idamprah)
	{
		$this->load->library('database_library');
			
		$noinvoice=$idunik;	
		foreach($this->cart->contents() as $items)
		{
			$this->database_library->pake_table('return_detail');
			$data=array(
				'id_return'=> $noinvoice,				
				'id_obat'=>$items['id'],
				'qty'=>$items['qty'],
					);
			$this->database_library->tambah_data($data);
			$this->database_library->pake_table('obat');
			$this->updateobat($items['id'],$items['qty']);
		}
		$this->ubahamprah($idamprah);
	}
	
	function tambahreturns($idunik,$tgl,$idruang,$keterangan,$idamprah)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('returns');	
		$noinvoice=$idunik;
		$data=array(
			'id_return'=>$noinvoice,
			'tgl'=>$tgl,
			'id_ruangan'=>$idruang,	
			'keterangan'=>$keterangan,
			'id_amprah'=>$idamprah,			
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
			'stok_akhir'=>$qtyakhir+$qty,
			);
		$isok=$this->database_library->ubah_data($arraysearch,$data);
		if($isok==true)
		{
			return true;
		}else{
			return false;
		}
	}
		
	function ubahamprah($id)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('amprah');
		$arraysearch=array(
			'id_amprah'=>$id,
			);
		$data=array(		
			'status'=>"return",
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
		$selectQuery="amprah.id_amprah, amprah.tgl, amprah.keterangan, ruangan.id_ruangan,ruangan.nama_ruangan";
		$fromQuery=" amprah LEFT JOIN ruangan ON amprah.id_ruangan = ruangan.id_ruangan";
		$arraywhere=array(
			'amprah.status !='=>'return',
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
}