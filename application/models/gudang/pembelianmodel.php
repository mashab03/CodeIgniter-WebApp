<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembelianmodel extends CI_Model {
	
	function tambahbelidetail($idunik,$tgl,$idsup,$po)
	{
		$this->load->library('database_library');
			
		$noinvoice=$idunik;	
		foreach($this->cart->contents() as $items)
		{
			$this->database_library->pake_table('pembelian_detail');
			$data=array(
				'id_transaksi'=> $noinvoice,
				'tanggal'=>$tgl,
				'id_obat'=>$items['id'],
				'harga_beli'=>$items['price'],
				'harga_jual'=>$items['jual'],
				'qty'=>$items['qty'],
				'id_supplier'=>$idsup,
				'nomorPO'=>$po,
				'kadaluarsa'=>$items['tgl'],
					);
			$this->database_library->tambah_data($data);
			$this->database_library->pake_table('obat');
			$this->updateobat($items['id'],$items['qty'],$items['price'],$items['jual'],$items['tgl']);
		}
	}
	
	function tambahbeli($idunik,$idsup,$po,$tgl)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('pembelian');	
		$noinvoice=$idunik;
		$data=array(
			'id_transaksi'=>$noinvoice,
			'tanggal'=>$tgl,
			'id_supplier'=>$idsup,	
			'nomorPO'=>$po,		
			);
		$isok=$this->database_library->tambah_data($data);
		if($isok==true)
			{
				return true;
			}else{
				return false;
			}
	}
	
	function updateobat($idobat,$qty,$hargabeli,$hargajual,$tgl)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('obat');
		
		$arraysearch=array(
			'id_obat'=>$idobat,
			);
		$qtyakhir=$this->database_library->ambil_satu_custom($arraysearch,"stok_akhir");
		$qtybeli=$this->database_library->ambil_satu_custom($arraysearch,"stok_beli");
		$data=array(
			'harga_beli'=>$hargabeli,
			'harga_jual'=>$hargajual,
			'stok_akhir'=>$qtyakhir+$qty,
			'stok_beli'=>$qtybeli+$qty,
			'kadaluarsa'=>$tgl,
			);
		$isok=$this->database_library->ubah_data($arraysearch,$data);
		if($isok==true)
		{
			return true;
		}else{
			return false;
		}
	}
		
}