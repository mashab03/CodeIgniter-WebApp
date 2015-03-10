<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualanmodel extends CI_Model {
	
	function tambahjualdetail($idunik,$tgl,$nomr)
	{
		$this->load->library('database_library');
			
		$noinvoice=$idunik;	
		foreach($this->cart->contents() as $items)
		{
			$this->database_library->pake_table('penjualan_apotik_rs_detail');
			$data=array(
				'id_penjualan_apotik_rs'=> $noinvoice,
				'tanggal'=>$tgl,
				'id_obat'=>$items['id'],
				'harga_jual'=>$items['jual'],
				'qty'=>$this->cart->format_number($items['qty']),
				'NoMR'=>$nomr,
				'tipe'=>$items['jenisresep'],
				'jasatipe'=>$items['jasaresep'],
					);
			$this->database_library->tambah_data($data);
			$this->database_library->pake_table('obat');
			$this->updateobat($items['id'],$items['qty'],$items['price'],$items['jual']);
		}
	}
	
	function tambahjual($idunik,$tgl,$nomr,$nama,$idkatpasien,$jenisrawat,$qty_racikan,$biayajasa)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('penjualan_apotik_rs');	
		$noinvoice=$idunik;
		$data=array(
			'id_penjualan_apotik_rs'=>$noinvoice,
			'tanggal'=>$tgl,
			'NoMR'=>$nomr,
			'Nama'=>$nama,		
			'Id_kategori_pasien'=>$idkatpasien,
			'jenisrawat'=>$jenisrawat,
			'qty_racikan'=>$qty_racikan,
			'biayajasa'=>$biayajasa,
			);
		$isok=$this->database_library->tambah_data($data);
		if($isok==true)
			{
				return true;
			}else{
				return false;
			}
	}
	
	function updateobat($idobat,$qty,$hargajual,$hargajual)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('obat');
		
		$arraysearch=array(
			'id_obat'=>$idobat,
			);
		$qtyakhir=$this->database_library->ambil_satu_custom($arraysearch,"stok_akhir");
		$qtyrs=$this->database_library->ambil_satu_custom($arraysearch,"stok_pelengkap");
		$qtyjual=$this->database_library->ambil_satu_custom($arraysearch,"stok_jual");
		$data=array(
			'harga_jual'=>$hargajual,
			'stok_akhir'=>$qtyakhir-$qty,
			'stok_rs'=>$qtyrs-$qty,
			'stok_jual'=>$qtyjual+$qty,
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