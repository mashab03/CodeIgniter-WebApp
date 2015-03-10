<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
		
	function index()
	{
		if(getRole()!="apotikext")
		{
			redirect('login');
		}
		$this->load->view('apotikext/index');
	}
}