<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ruanganmodel extends CI_Model {
	
	function fetch_ruangan()
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('ruangan');
		$isdata=$this->database_library->ambil_data();
		if(!empty($isdata))
		{
			return true;
		}else{
			return false;
		}
	}
	
	function getRuangan()
	{
		
		$this->load->library('database_library');
		
		$search="";
		$url='';
		
		$url=base_url('gudang/ruangan').'?paging=true&';		
		$page = isset($_GET['page']) ? mysql_real_escape_string($_GET['page']) : '1';
		
		$limit=10;
		$offset = ($page - 1) * $limit;
		$sql="SELECT * FROM ruangan limit $offset,$limit";
		$sql2="SELECT * FROM ruangan";
		$datas=$this->database_library->QueryData($sql);;
		$TR=$this->database_library->QueryNumRow($sql2);
		
		
		$tpage=ceil($TR/$limit);
		$this->load->library('pagination_library');
		$data['links']=$this->pagination_library->paginate_anchor($url,$page,$TR,$limit);
		$data['results']=$datas;
		
		return $data;
	}
	
	function get_ruangan_by_id($id)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('ruangan');
		$isdata=$this->database_library->ambil_satu_data('id_ruangan',$id,'nama_ruangan');
		if(!empty($isdata))
		{
			return $isdata;
		}else{
			return null;
		}
	}
	
	function jika_ada($nama)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('ruangan');
		$arr=array(
			'nama_ruangan'=>$nama,
			);
		if($this->database_library->jika_ada($arr)==TRUE)
		{
			return true;
		}else{
			return false;
		}
		
	}
	
	function add_ruangan($nama)
	{
		$this->load->library('database_library');
		if($this->jika_ada($nama)==FALSE)
		{
			$this->database_library->pake_table('ruangan');		
			$arr=array(
				'nama_ruangan'=>$nama,
				);
			if($this->database_library->tambah_data($arr)==TRUE)
			{
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	function update_ruangan($idKategori,$nama)
	{
		$this->load->library('database_library');
		
			$this->database_library->pake_table('ruangan');		
			$arr=array(
				'id_ruangan'=>$idKategori,
				);
			$arrupdate=array(
				'nama_ruangan'=>$nama,
				);
			if($this->database_library->ubah_data($arr,$arrupdate)==TRUE)
			{
				return true;
			}else{
				return false;
			}
		
	}
	
	function delete_ruangan($idKategori)
	{
		$this->load->library('database_library');
		
			$this->database_library->pake_table('ruangan');		
			$arr=array(
				'id_ruangan'=>$idKategori,
				);
			if($this->database_library->hapus_data($arr)==TRUE)
			{
				return true;
			}else{
				return false;
			}
		
	}
	
}