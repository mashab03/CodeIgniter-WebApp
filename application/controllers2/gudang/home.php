<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
		
	function index()
	{
		if(getRole()!="gudang")
		{
			redirect('login');
		}
		$this->load->view('gudang/index');
	}
}