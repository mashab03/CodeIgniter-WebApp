<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {
	
	function index()
	{
		$this->load->model('admin/configmodel');
		$this->load->library('secure_library');
		$this->secure_library->filter_post('nama','required');
		$this->secure_library->filter_post('app','required');
		if($this->secure_library->start_post()==TRUE)
		{
			$data['isok']="Sukses mengubah konfigurasi";
			$data['isdata']=$this->configmodel->get_data_config();
			$this->load->view('admin/configview',$data);
		}else{
			
			$data['isdata']=$this->configmodel->get_data_config();
			$this->load->view('admin/configview',$data);
		}
	}
}