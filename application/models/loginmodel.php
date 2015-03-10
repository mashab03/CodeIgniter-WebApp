<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loginmodel extends CI_Model
{
	function login_action($username,$password)
	{
		$this->load->library('secure_library');
		$pwd=$this->secure_library->password_hash($password);
		$this->load->library('database_library');
		$this->database_library->pake_table('users');
		$arr=array(
				'username_special'=>$username,
				'password_special'=>$pwd,
				'status'=>'active'
			);
		if($this->database_library->jika_ada($arr)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function createSessionLogin($User)
	{
		if(!$this->session->userdata('islogin'))
		{
			$CI=& get_instance();			
			$this->session->set_userdata('islogin',TRUE);
			$this->session->set_userdata('isUser',$User);
			$Role=$this->getInfoUserBySession('role_special');
			$this->session->set_userdata('role',$Role);
			return true;
		}else{
			return false;
		}
	}
	
	function getUser()
	{
		if($this->session->userdata('islogin'))
		{		
		$isRole=$this->session->userdata('isUser');
			if($isRole!="")
			{
				return $isRole;
			}else{
				$this->GoLogout();
			}
		}else{
			$this->GoLogout();
		}
	}
	
	function getInfoUserBySession($output)
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('users');
		$isData=$this->database_library->ambil_satu_data('username_special',$this->session->userdata('isUser'),$output);
		if(!empty($isData))
		{
			return $isData;
		}else{
			return "Data not found";
		}
	}
	
	function isLogin()
	{
		if($this->session->userdata('islogin')=="")
		{
			return false;
		}else{
			return true;
		}
	}
	
	function GoLogout()
	{
			
			$this->session->sess_destroy();
			redirect('login');
		
	}
	
	function getRoleUser()
	{
		if($this->session->userdata('islogin'))
		{		
		$isRole=$this->session->userdata('role');
			if($isRole!="")
			{
				return $isRole;
			}else{
				$this->GoLogout();
			}
		}else{
			$this->GoLogout();
		}
	}
	
	function goPageUser()
	{
		$ss=$this->getRoleUser();
		redirect($ss.'/home/');
	}
}