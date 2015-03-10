<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configmodel extends CI_Model
{
	function get_data_config()
	{
		$this->load->library('database_library');
		$this->database_library->pake_table('options');
		$isdata=$this->database_library->ambil_data();
		if(!empty($isdata))
		{
			return $isdata;
		}else{
			return null;
		}
	}
}