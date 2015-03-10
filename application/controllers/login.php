<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function index()
	{
		$this->load->model('loginmodel');
		if($this->loginmodel->isLogin()==false)
		{
			$this->load->view('loginview');
		}else{
			$this->loginmodel->goPageUser();
		}
	}
	
	function attempt()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('username','required|xss_clean');
		$this->secure_library->filter_post('password','required|xss_clean');
		if($this->secure_library->start_post()==TRUE)
		{
			$this->load->model('loginmodel');
			$cek=$this->loginmodel->login_action($this->input->post('username'),$this->input->post('password'));
			if($cek==true)
			{
				$create_ses=$this->loginmodel->createSessionLogin($this->input->post('username'));
				if($create_ses==true)
				{
					$this->loginmodel->goPageUser();
				}else{
					redirect('login','refresh');
				}
			}else{
				redirect('login','refresh');
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	function dologout()
	{
		$this->load->model('loginmodel');
		$this->loginmodel->GoLogout();
	}
}