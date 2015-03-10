<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Obat extends CI_Controller {
	
	function index()
	{
		$this->load->library('database_library');
		$this->load->model('gudang/obatmodel');		
		$this->database_library->pake_table('obat');
		
		$array=array(
			'id_obat !='=>(int)""
			);
		$pages=200;

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$totalrow=$this->database_library->jumlah_data_where($array);

		$is_data2=$this->obatmodel->fetch_obat($pages,$page);

		$data['is_data']=$this->database_library->buat_paging('gudang/obat/',$totalrow,$pages,$page,$is_data2);
		
		if($totalrow > 0)
		{
			$this->load->view('gudang/obatview',$data);
		}else{
			redirect('gudang/obat/addobat','refresh');
		}
		
		
	}
	
	function addobat()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('nama','required');
		$this->secure_library->filter_post('stok','required');
		$this->secure_library->filter_post('beli','required');
		$this->secure_library->filter_post('jual','required');
		if($this->secure_library->start_post()==true)
		{
			$this->load->model('gudang/obatmodel');
			$data=array(
				'nama_obat'=>$this->input->post('nama'),
				'id_kategori_obat'=>$this->input->post('kategori'),
				'id_satuan_obat'=>$this->input->post('satuan'),
				'stok_awal'=>$this->input->post('stok'),
				'stok_akhir'=>$this->input->post('stok'),
				'harga_beli'=>$this->input->post('beli'),
				'harga_jual'=>$this->input->post('jual'),
				'min_order'=>$this->input->post('order'),
				);
			if($this->obatmodel->tambah_obat($data)==true)
			{
				$data['isok']="Data sukses ditambahkan";
				$this->load->view('gudang/addobatview',$data);
			}else{
				redirect('gudang/obat/addobat','refresh');
			}
		}else{
			$this->load->view('gudang/addobatview');
		}
	}
	
	function delete()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/obatmodel');
		if($this->obatmodel->delete_obat($id)==TRUE)
		{
			redirect('gudang/obat');
		}else{
			redirect('gudang/obat');
		}
	}
	
	function updateview()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/obatmodel');
		$data['nama']=$this->obatmodel->get_obat_by_id($id,"nama_obat");
		$data['beli']=$this->obatmodel->get_obat_by_id($id,"harga_beli");
		$data['jual']=$this->obatmodel->get_obat_by_id($id,"harga_jual");
		$data['order']=$this->obatmodel->get_obat_by_id($id,"min_order");
		$data['id']=$id;
		if(!empty($data['nama']))
		{
			$this->load->view('gudang/editobatview',$data);
		}else{
			redirect('gudang/obat');
		}
	}
	
	function update()
	{
		$id=$_GET['uid'];
		$this->load->model('gudang/obatmodel');
		$data=array(
				'nama_obat'=>$this->input->post('nama'),
				'id_kategori_obat'=>$this->input->post('kategori'),
				'id_satuan_obat'=>$this->input->post('satuan'),			
				'harga_beli'=>$this->input->post('beli'),
				'harga_jual'=>$this->input->post('jual'),
				'min_order'=>$this->input->post('order'),
			);
		if($this->obatmodel->update_obat($id,$data)==TRUE)
		{
			redirect('gudang/obat');
		}else{
			redirect("gudang/obat/updateview?uid=".$id."");
		}
	}
}