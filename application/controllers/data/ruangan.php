<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ruangan extends CI_Controller {
	
		
	function getruangan()
	{
		$this->db->select("*");
		$this->db->from('ruangan');
		$this->db->like('nama_ruangan', $_GET['term'], 'both'); 
		$sql = $this->db->get();
		foreach($sql->result() as $row){

					$data[] = array(
							'id_ruangan'=>$row->id_ruangan,
							'nama_ruangan'=>$row->nama_ruangan,
							'value'=>$row->nama_ruangan,
							'label'=>$row->nama_ruangan,							
							);

		}
		
		echo json_encode($data);
	}
}