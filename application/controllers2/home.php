<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function index()
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('users');
		$data['isdata']=$this->database_library->ambil_data();
		$this->load->view('awal',$data);
	}
	
	function passwordchange()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('pass1','required|xss_clean');
		$this->secure_library->filter_post('pass2','required|xss_clean');
		if($this->secure_library->start_post()==true)
		{
			$username=getUser();
			$password=$this->input->post('pass1',TRUE);
			$passwordnew=$this->input->post('pass2',TRUE);
			$this->load->model('loginmodel');
			if($this->loginmodel->login_action($username,$password))
			{
				$this->load->library('database_library');
				$this->database_library->pake_table('users');
				$data=array(
					'password_special'=> $passwordnew,
					);
				if($this->database_library->ubah_data_where("username_special",$username,$data)==true)
				{
					$data['status']="Password sudah diubah";
					$this->load->view('changepassword',$data);
				}else{
					$data['status2']="Password gagal diubah";
					$this->load->view('changepassword',$data);
				}
			}else{
					$data['status2']="Password gagal diubah";
					$this->load->view('changepassword',$data);
			}
		}else{
			$this->load->view('changepassword');
		}
	}
}