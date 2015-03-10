<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
		
	function index()
	{
		if(getRole()!="apotik")
		{
			redirect('login');
		}
		$this->load->view('apotik/index');
	}
}