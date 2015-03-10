<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {
	
		
	function getsupplier()
	{
		$this->db->select("*");
		$this->db->from('supplier');
		$this->db->like('nama_supplier', $_GET['term'], 'both'); 
		$sql = $this->db->get();
		foreach($sql->result() as $row){

					$data[] = array(
							'id_supplier'=>$row->id_supplier,
							'nama_supplier'=>$row->nama_supplier,
							'value'=>$row->nama_supplier,
							'alamat'=>$row->alamat,
							'telepon'=>$row->telepon,							
							);

		}
		
		echo json_encode($data);
	}
}