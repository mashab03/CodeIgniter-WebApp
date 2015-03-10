<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends CI_Controller {
	
		
	function getobat()
	{
		$this->db->select("obat.*, satuan_obat.nama_satuan, kategori_obat.nama_kategori");
		$this->db->from('(obat LEFT JOIN satuan_obat ON obat.id_satuan_obat = satuan_obat.id_satuan_obat) LEFT JOIN kategori_obat ON obat.id_kategori_obat = kategori_obat.id_kategori_obat');	
		$this->db->like('obat.nama_obat', $_GET['term'], 'both'); 
		$sql = $this->db->get();
		foreach($sql->result() as $row){

					$data[] = array(
							'kode'=>$row->id_obat,
							'satuan'=>$row->nama_satuan,
							'stokakhir'=>$row->stok_akhir,
							'stok_rs'=>$row->stok_rs,
							'stok_pelengkap'=>$row->stok_pelengkap,
							'harga_beli'=>$row->harga_beli,
							'harga_jual'=>$row->harga_jual,
							'value'=>$row->nama_obat,
							'label'=>$row->nama_obat." ".$row->harga_beli,
							);

		}
		
		echo json_encode($data);
	}
	
	function getobatrs()
	{
		$this->db->select("obat.*, satuan_obat.nama_satuan, kategori_obat.nama_kategori");
		$this->db->from('(obat LEFT JOIN satuan_obat ON obat.id_satuan_obat = satuan_obat.id_satuan_obat) LEFT JOIN kategori_obat ON obat.id_kategori_obat = kategori_obat.id_kategori_obat');
		$this->db->where(array('stok_rs >'=>'0'));
		$this->db->like('obat.nama_obat', $_GET['term'], 'both'); 
		$sql = $this->db->get();
		foreach($sql->result() as $row){

					$data[] = array(
							'kode'=>$row->id_obat,
							'satuan'=>$row->nama_satuan,
							'stokakhir'=>$row->stok_akhir,
							'stok_rs'=>$row->stok_rs,
							'stok_pelengkap'=>$row->stok_pelengkap,
							'harga_beli'=>$row->harga_beli,
							'harga_jual'=>$row->harga_jual,
							'value'=>$row->nama_obat,
							'label'=>$row->nama_obat." ".$row->harga_beli,
							);

		}
		
		echo json_encode($data);
	}
}