<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model
{
	function isset_user($username)
	{
		$this->load->library('database_library');
		
		$this->database_library->pake_table('users');
		$array=array(
			'username_special'=>$username,
			);
		if($this->database_library->jika_ada($array)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function create_user($username,$password,$role,$nama)
	{
		$this->load->library('database_library');
		$this->load->library('secure_library');
		$hashpwd=$this->secure_library->password_hash($password);
		if($this->isset_user($username)==FALSE)
		{
			$this->database_library->pake_table('users');
			$data=array(
				'username_special'=>$username,
				'password_special'=>$hashpwd,
				'role_special'=>$role,
				'nama'=>$nama,
				'status'=>'active',
				);
			$ifok=$this->database_library->tambah_data($data);
			if($ifok==TRUE)
			{
				return true;
			}else{
				return false;
			}
		}
	}
	
	function delete_user($idUser)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('users');
		$arraysearch=array(
				'id_user'=>$idUser,
				);
		if($this->database_library->hapus_data($arraysearch)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function change_role_user($idUser,$role)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('users');
		$arraysearch=array(
				'id_user'=>$idUser,
				);
		$data=array(
				'role_special'=>$role,
				);
		if($this->database_library->ubah_data($arraysearch,$data)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function change_status_user($idUser,$role)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('users');
		$arraysearch=array(
				'id_user'=>$idUser,
				);
		$data=array(
				'status'=>$role,
				);
		if($this->database_library->ubah_data($arraysearch,$data)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function getUser()
	{
		
		$this->load->library('database_library');
		
		$search="";
		$url='';
		
		$url=base_url('admin/userview').'?paging=true&';		
		$page = isset($_GET['page']) ? mysql_real_escape_string($_GET['page']) : '1';
		
		$limit=20;
		$offset = ($page - 1) * $limit;
		$sql="SELECT * FROM users limit $offset,$limit";
		$sql2="SELECT * FROM users";
		$datas=$this->database_library->QueryData($sql);;
		$TR=$this->database_library->QueryNumRow($sql2);
		
		
		$tpage=ceil($TR/$limit);
		$this->load->library('pagination_library');
		$data['links']=$this->pagination_library->paginate_anchor($url,$page,$TR,$limit);
		$data['results']=$datas;
		
		return $data;
	}
}