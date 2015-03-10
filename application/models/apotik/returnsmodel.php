<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Returnsmodel extends CI_Model {
	
	function tambahreturnsdetail($idunik,$tgl,$idjual)
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
		$this->ubahjual($idjual);
	}
	
	function tambahreturns($idunik,$tgl,$NoMR,$keterangan,$idjual)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('returns');	
		$noinvoice=$idunik;
		$data=array(
			'id_return'=>$noinvoice,
			'tgl'=>$tgl,
			'NoMR'=>$NoMR,	
			'keterangan'=>$keterangan,
			'id_penjualan_apotik_rs'=>$idjual,			
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
		
	function ubahjual($id)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('penjualan_apotik_rs');
		$arraysearch=array(
			'id_penjualan_apotik_rs'=>$id,
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
	
	function fetch_jual($limit,$start)
	{
		$this->load->library('database_library');
		$selectQuery="*";
		$fromQuery="penjualan_apotik_rs";
		$arraywhere=array(
			'penjualan_apotik_rs.status !='=>'return',
			);		
		$fieldorder='penjualan_apotik_rs.tanggal';
		$ordervalue='asc';
		$isdata=$this->database_library->ambil_data_where_paging($selectQuery,$fromQuery,$arraywhere,$fieldorder,$ordervalue,$limit,$start);		
		if(!empty($isdata))
		{
			return $isdata;
		}else{
			return null;
		}
	}
	
	function fetch_jual_info($id)
	{
		$this->load->library('database_library');
		$selectQuery="*";
		$fromQuery="penjualan_apotik_rs";
		$arraywhere=array(
			'penjualan_apotik_rs.id_penjualan_apotik_rs ='=>$id,
			);		
		$fieldorder='penjualan_apotik_rs.tanggal';
		$ordervalue='asc';
		$isdata=$this->database_library->ambil_data_where_paging($selectQuery,$fromQuery,$arraywhere,$fieldorder,$ordervalue,1,0);		
		if(!empty($isdata))
		{
			return $isdata;
		}else{
			return null;
		}
	}
	
	function fetch_jual_edit($id)
	{
		$this->load->library('database_library');
		$selectQuery="penjualan_apotik_rs_detail.id_penjualan_apotik_rs,obat.id_obat,obat.nama_obat, penjualan_apotik_rs_detail.qty";
		$fromQuery="penjualan_apotik_rs_detail LEFT JOIN obat ON penjualan_apotik_rs_detail.id_obat = obat.id_obat";
		$arraywhere=array(
			'penjualan_apotik_rs_detail.id_penjualan_apotik_rs ='=>$id,
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