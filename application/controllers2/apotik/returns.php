<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Returns extends CI_Controller {
	
	function index()
	{
		$this->cart->destroy();
	$this->load->library('database_library');
		$this->load->model('apotik/returnsmodel');		
		$this->database_library->pake_table('penjualan_apotik_rs');
		
		$array=array(
			'status !='=>"return"
			);
		$pages=6;

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$totalrow=$this->database_library->jumlah_data_where($array);

		$is_data2=$this->returnsmodel->fetch_jual($pages,$page);

		
		if($totalrow > 0)
		{
			$data['is_data']=$this->database_library->buat_paging('apotik/returns/',$totalrow,$pages,$page,$is_data2);
			$this->load->view('apotik/returnsview',$data);
		}else{			
			redirect("apotik/penjualan");
		}
	}
	
	
	function updateview()
	{
		
		$id=$_GET['uid'];
		$this->load->model('apotik/returnsmodel');
		$pl=$this->returnsmodel->fetch_jual_edit($id);
		foreach($pl as $p)
		{
			$data=array(
				'id'      => $p->id_obat,
				'kode'      => $p->id_obat,
               'name'     => $p->nama_obat,
               'qty'   => $p->qty,
               'price'    => 1,
				);			
			$this->cart->insert($data); 
		}
		
		$data['isinfo']=$this->returnsmodel->fetch_jual_info($id);
		
		
		$this->load->view('apotik/returnsviewedit',$data);
	}
	
	function go()
	{
		$this->load->model('apotik/returnsmodel','returnsmodel');
		$idunik=unik_id();
		$NoMR=$this->input->post('nomor');
		$tgl=$this->input->post('tgl');
		$nomorjual=$this->input->post('nomorjual');
		$keterangan=$this->input->post('keterangan');
		if($this->returnsmodel->tambahreturns($idunik,$tgl,$NoMR,$keterangan,$nomorjual)==true)
		{
			$this->returnsmodel->tambahreturnsdetail($idunik,$tgl,$nomorjual);
			redirect('apotik/returns');	
		}else{
			die();
		}
	}
			
}