<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Returns extends CI_Controller {
	
	function index()
	{
		$this->cart->destroy();
	$this->load->library('database_library');
		$this->load->model('gudang/returnsmodel');		
		$this->database_library->pake_table('amprah');
		
		$array=array(
			'status !='=>"return"
			);
		$pages=6;

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$totalrow=$this->database_library->jumlah_data_where($array);

		$is_data2=$this->returnsmodel->fetch_amprah($pages,$page);

		
		if($totalrow > 0)
		{
			$data['is_data']=$this->database_library->buat_paging('gudang/returns/',$totalrow,$pages,$page,$is_data2);
			$this->load->view('gudang/returnsview',$data);
		}else{			
			redirect("gudang/amprah");
		}
	}
	
	
	function updateview()
	{
		
		$id=$_GET['uid'];
		$this->load->model('gudang/amprahmodel');
		$pl=$this->amprahmodel->fetch_amprah_edit($id);
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
		
		$data['isinfo']=$this->amprahmodel->fetch_amprah_info($id);
		
		
		$this->load->view('gudang/returnsviewedit',$data);
	}
	
	function go()
	{
		$this->load->model('gudang/returnsmodel','returnsmodel');
		$idunik=unik_id();
		$koderuang=$this->input->post('koderuang');
		$tgl=$this->input->post('tgl');
		$nomoramprah=$this->input->post('nomor');
		$keterangan=$this->input->post('keterangan');
		if($this->returnsmodel->tambahreturns($idunik,$tgl,$koderuang,$keterangan,$nomoramprah)==true)
		{
			$this->returnsmodel->tambahreturnsdetail($idunik,$tgl,$nomoramprah);
			redirect('gudang/returns');	
		}else{
			die();
		}
	}
			
}