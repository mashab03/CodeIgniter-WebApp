<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transfermodel extends CI_Model {
	
	
	function insertTransfer($tgl,$idobat,$qty,$apotik)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('transfer_obat');
		$data=array(
			'tanggal'=>$tgl,
			'id_obat'=>$idobat,
			'qty'=>$qty,
			'apotik'=>$apotik,
			);
		$isok=$this->database_library->tambah_data($data);
		if($isok==true)
		{
			return true;
		}else{
			die();
		}
	}
	
	function tambahstok($id_obat,$apotik,$qty)
	{
		$this->load->library('database_library');
		
		
		$this->database_library->pake_table('obat');
		$arr=array(
			'id_obat'=>$id_obat,
			);
		$qtyakhir=$this->database_library->ambil_satu_custom($arr,"stok_".$apotik);
		if($this->database_library->jika_ada($arr)==true)
		{
						
			$data2=array(
				'stok_'.$apotik=>$qtyakhir+$qty,
				);
			if($this->database_library->ubah_data($arr,$data2)==true)
			{
				return true;
			}else{
				return false;
			}
		}
	}
	
	function aksitransfer($tgl,$idobat,$apotik,$qty)
	{
		$p1=$this->insertTransfer($tgl,$idobat,$qty,$apotik);
		if($p1==true)
		{
			$p2=$this->tambahstok($idobat,$apotik,$qty);
			if($p2==false)
			{
				die('error tambahstok');
			}
		}else{
			die('error inserttransfer');
		}
	}
}