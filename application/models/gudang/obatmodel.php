<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Obatmodel extends CI_Model {
	
	function fetch_obat($limit,$start)
	{
		$this->load->library('database_library');
		$selectQuery="obat.id_obat, obat.nama_obat, kategori_obat.nama_kategori, satuan_obat.nama_satuan, obat.stok_akhir, obat.harga_beli, obat.harga_jual, obat.tipe_apotik,obat.min_order";
		$fromQuery="(obat LEFT JOIN kategori_obat ON obat.id_kategori_obat = kategori_obat.id_kategori_obat) LEFT JOIN satuan_obat ON obat.id_satuan_obat = satuan_obat.id_satuan_obat";
		$arraywhere=array(
			'obat.id_obat !='=>(int)'',
			);		
		$fieldorder='obat.nama_obat';
		$ordervalue='asc';
		$isdata=$this->database_library->ambil_data_where_paging($selectQuery,$fromQuery,$arraywhere,$fieldorder,$ordervalue,$limit,$start);		
		if(!empty($isdata))
		{
			return $isdata;
		}else{
			return null;
		}
	}
	
	function getObat()
	{
		
		$this->load->library('database_library');
		
		$search="";
		$url='';
		$nama =isset($_GET['nama']) ? mysql_real_escape_string($_GET['nama']) : '';		
		$kategori =isset($_GET['kategori']) ? mysql_real_escape_string($_GET['kategori']) : '';
		$satuan =isset($_GET['satuan']) ? mysql_real_escape_string($_GET['satuan']) : '';
		
		
		$where=" WHERE obat.nama_obat LIKE '%$nama%' AND kategori_obat.id_kategori_obat LIKE '%$kategori%'
		AND satuan_obat.id_satuan_obat LIKE '%$satuan%'";		
		$page = isset($_GET['page']) ? mysql_real_escape_string($_GET['page']) : '1';		
		$url=base_url('gudang/obat')."?paging=true&nama=$nama&kategori=$kategori&satuan=$satuan&";
		$limit=10;
		$offset = ($page - 1) * $limit;
		$sql="SELECT obat.id_obat, obat.nama_obat, kategori_obat.nama_kategori, satuan_obat.nama_satuan, obat.stok_akhir, obat.harga_beli, obat.harga_jual, obat.tipe_apotik,obat.min_order FROM
		(obat LEFT JOIN kategori_obat ON obat.id_kategori_obat = kategori_obat.id_kategori_obat) LEFT JOIN satuan_obat ON obat.id_satuan_obat = satuan_obat.id_satuan_obat
		$where AND obat.id_obat !='' 
		limit $offset,$limit";
		$sql2="SELECT obat.id_obat, obat.nama_obat, kategori_obat.nama_kategori, satuan_obat.nama_satuan, obat.stok_akhir, obat.harga_beli, obat.harga_jual, obat.tipe_apotik,obat.min_order FROM
		(obat LEFT JOIN kategori_obat ON obat.id_kategori_obat = kategori_obat.id_kategori_obat) LEFT JOIN satuan_obat ON obat.id_satuan_obat = satuan_obat.id_satuan_obat
		$where AND obat.id_obat !=''";
		$datas=$this->database_library->QueryData($sql);;
		$TR=$this->database_library->QueryNumRow($sql2);
		
		
		$tpage=ceil($TR/$limit);
		$this->load->library('pagination_library');
		$data['links']=$this->pagination_library->paginate_anchor($url,$page,$TR,$limit);
		$data['results']=$datas;
		
		return $data;
	}
	
	function tambah_obat($data)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('obat');
		if($this->database_library->tambah_data($data)==true)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function delete_obat($id)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('obat');
		$arraysearch=array(
			'id_obat'=>$id,
			);
		if($this->database_library->hapus_data($arraysearch) ==true)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function get_obat_by_id($id,$output)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('obat');
		$isdata=$this->database_library->ambil_satu_data('id_obat',$id,$output);
		if(!empty($isdata))
		{
			return $isdata;
		}else{
			return null;
		}
	}
	
	function update_obat($id,$data)
	{
		$this->load->library('database_library');
		
			$this->database_library->pake_table('obat');		
			$arr=array(
				'id_obat'=>$id,
				);			
			if($this->database_library->ubah_data($arr,$data)==TRUE)
			{
				return true;
			}else{
				return false;
			}
		
	}
	
}