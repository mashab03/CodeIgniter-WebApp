<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
	function fakturjualrs()
	{
		$idunik=$_GET['id'];
		$this->load->library('database_library');
		$this->database_library->pake_table('penjualan_apotik_rs');
		$arraysearch=array(
			'id_penjualan_apotik_rs'=>$idunik,
			);
		$data['info']=$this->database_library->ambil_data_array($arraysearch);
		$select=("penjualan_apotik_rs_detail.id_penjualan_apotik_rs, penjualan_apotik_rs_detail.tanggal, penjualan_apotik_rs_detail.qty, penjualan_apotik_rs_detail.harga_jual, penjualan_apotik_rs_detail.NoMR, obat.nama_obat, kategori_pasien.nama_kategori, penjualan_apotik_rs.Nama, penjualan_apotik_rs.jenisrawat,penjualan_apotik_rs_detail.tipe,penjualan_apotik_rs_detail.jasatipe,penjualan_apotik_rs.qty_racikan,penjualan_apotik_rs.biayajasa");	
		
		$from=("(penjualan_apotik_rs RIGHT JOIN (penjualan_apotik_rs_detail LEFT JOIN obat ON penjualan_apotik_rs_detail.id_obat = obat.id_obat) ON penjualan_apotik_rs.id_penjualan_apotik_rs = penjualan_apotik_rs_detail.id_penjualan_apotik_rs) LEFT JOIN kategori_pasien ON penjualan_apotik_rs.id_kategori_pasien = kategori_pasien.id_kategori_pasien");
		
		$where=(array('penjualan_apotik_rs_detail.id_penjualan_apotik_rs'=>$idunik));		
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/fakturjualrs',$data);
	}
	
	function infostok()
	{
		$this->load->view('apotik/infostokcari');
	}
	
	
	
	function repsisastok()
	{		
		$this->load->library('database_library');
		$select="obat.id_obat, obat.nama_obat, satuan_obat.nama_satuan, obat.harga_beli, obat.harga_jual, obat.stok_rs as jumlah, obat.min_order";
		$key=$this->input->post('key');
		$value=$this->input->post('value');
		$from="obat LEFT JOIN satuan_obat ON obat.id_satuan_obat = satuan_obat.id_satuan_obat";
		$where=$key." LIKE '%".$value."%'";
		$data['title']="Laporan Stok Apotik Rumah Sakit ".ucfirst($value);
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/stokapotikrs',$data);
	}
	
	function repjualperiode()
	{
		
		$this->load->library('secure_library');
		$this->load->library('database_library');
		$this->secure_library->filter_post('tgl','required');
		$this->secure_library->filter_post('tgl2','required');
		$tgl1=$this->input->post('tgl');
		$tgl2=$this->input->post('tgl2');
		if($this->secure_library->start_post()==true)
		{
			$key=$this->input->post('key');
			$value=$this->input->post('value');
			$select="penjualan_apotik_rs_detail.jasatipe,penjualan_apotik_rs.biayajasa,penjualan_apotik_rs_detail.jasatipe,penjualan_apotik_rs_detail.id_penjualan_apotik_rs, penjualan_apotik_rs_detail.tanggal, obat.nama_obat, penjualan_apotik_rs_detail.qty, penjualan_apotik_rs_detail.harga_jual, penjualan_apotik_rs_detail.NoMR, penjualan_apotik_rs.Nama, penjualan_apotik_rs.jenisrawat";
		$from="((penjualan_apotik_rs RIGHT JOIN penjualan_apotik_rs_detail ON penjualan_apotik_rs.id_penjualan_apotik_rs = penjualan_apotik_rs_detail.id_penjualan_apotik_rs) LEFT JOIN obat ON penjualan_apotik_rs_detail.id_obat = obat.id_obat) LEFT JOIN kategori_obat ON obat.id_kategori_obat = kategori_obat.id_kategori_obat";
		$where="penjualan_apotik_rs_detail.tanggal BETWEEN '".$tgl1."' AND '".$tgl2."' AND $key LIKE '%$value%'
		ORDER BY penjualan_apotik_rs_detail.tanggal desc";
		$data['title']="Laporan penjualan apotik Rumah Sakit periode<br>".$tgl1." hingga ".$tgl2;	
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/jualapotikrs',$data);
		}else{
			$this->load->view('apotik/carilapjual');
		}
	}
	
	function repjualkey()
	{
		$this->load->library('secure_library');
		$this->load->library('database_library');
		$this->secure_library->filter_post('key','required');
		$key=$this->input->post('key');
		$value=$this->input->post('value');
		if($this->secure_library->start_post()==true)
		{
			$select="penjualan_apotik_rs_detail.id_penjualan_apotik_rs, penjualan_apotik_rs_detail.tanggal, obat.nama_obat, penjualan_apotik_rs_detail.qty, penjualan_apotik_rs_detail.harga_jual, penjualan_apotik_rs_detail.NoMR, penjualan_apotik_rs.Nama, penjualan_apotik_rs.jenisrawat, kategori_obat.nama_kategori";
		$from=" ((penjualan_apotik_rs RIGHT JOIN penjualan_apotik_rs_detail ON penjualan_apotik_rs.id_penjualan_apotik_rs = penjualan_apotik_rs_detail.id_penjualan_apotik_rs) LEFT JOIN obat ON penjualan_apotik_rs_detail.id_obat = obat.id_obat) LEFT JOIN kategori_obat ON obat.id_kategori_obat = kategori_obat.id_kategori_obat";
		$where=$key." LIKE '%".$value."%'";
		$data['title']="Laporan penjualan Apotik Rumah Sakit ".ucfirst($value);	
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/jualapotikrs',$data);
		}else{
			$this->load->view('apotik/carilapjual');
		}
	}
	
	function repreturns()
	{

			$this->load->view('apotik/lapreturns');
	
	}
	
	function repreturnstanggal()
	{
		$this->load->library('secure_library');
		$this->secure_library->filter_post('tgl','required');
		$this->secure_library->filter_post('tgl2','required');
		$tgl1=$this->input->post('tgl');
		$tgl2=$this->input->post('tgl2');
		if($this->secure_library->start_post()==true)
		{
			$this->load->library('database_library');
		$select=("return_detail.id_return, penjualan_apotik_rs.NoMR, penjualan_apotik_rs.Nama, returns.tgl, obat.nama_obat, return_detail.qty");	
		$from="((return_detail LEFT JOIN returns ON return_detail.id_return = returns.id_return) LEFT JOIN penjualan_apotik_rs ON returns.id_penjualan_apotik_rs = penjualan_apotik_rs.id_penjualan_apotik_rs) LEFT JOIN obat ON return_detail.id_obat = obat.id_obat";
		$where="`returns`.tgl BETWEEN '".$tgl1."' AND '".$tgl2."'";	
			$data['title']="Laporan Return Periode ".$tgl1." hingga ".$tgl2;
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$where);
		$this->load->view('laporan/repreturns',$data);		
		}
	}
	
	function reprekap()
	{
		$this->load->view('apotik/rekapfakturcari');
	}
	
	function reprekaptanggal()
	{
			
		$tgl1=$this->input->post('tgl');
		$tgl2=$this->input->post('tgl2');
		$this->load->library('database_library');
		$this->database_library->pake_table('penjualan_apotik_rs');		
		
		
		$select="obat.nama_obat, penjualan_apotik_rs_detail.qty, penjualan_apotik_rs_detail.harga_jual, (penjualan_apotik_rs_detail.qty*penjualan_apotik_rs_detail.harga_jual) AS subtotal, penjualan_apotik_rs.tanggal, penjualan_apotik_rs.NoMR, penjualan_apotik_rs.Nama";	
		
		$from="(penjualan_apotik_rs_detail LEFT JOIN penjualan_apotik_rs ON penjualan_apotik_rs_detail.id_penjualan_apotik_rs = penjualan_apotik_rs.id_penjualan_apotik_rs) LEFT JOIN obat ON penjualan_apotik_rs_detail.id_obat = obat.id_obat";
		
		$arraysearch="penjualan_apotik_rs_detail.tanggal BETWEEN '".$tgl1."' AND '".$tgl2."'";		
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$arraysearch);
		$this->load->view('laporan/reprekaprs',$data);
	}
	
	function repMR()
	{
		$this->load->view('apotik/reppasienmr');
	}
	
	function lihatdataMR()
	{
	
		$kode=$_GET['kode'];
		$this->load->library('database_library');
		$this->database_library->pake_table('penjualan_apotik_rs');
		$arraysearch="";
	
			$arraysearch=array(
				'penjualan_apotik_rs.NoMR'=>$kode,
				);
			//"penjualan_apotik_rs.NoMR='123'";	
		
		$datp=$this->database_library->ambil_data_array($arraysearch,"tanggal","desc");
		if(!empty($datp))
		{
		echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
			<thead>
			<th>Tanggal</th>
			<th>No MR</th>
			<th>Nama</th>
			<th>Jenis Rawat</th>
			<th>Aksi</th>
			</thead>';
			
		foreach($datp as $row)
		{
			echo '<tr>';
			echo '<td>'.$row->tanggal.'</td>';
			echo '<td>'.$row->NoMR.'</td>';
			echo '<td>'.$row->Nama.'</td>';
			echo '<td>'.$row->jenisrawat.'</td>';
			echo '<td><a class="btn" target="_blank" href="'.base_url('apotik/laporan/repMRprint?nomr='.$row->NoMR.'&nama='.$row->Nama.'').'"><i class="icon-print"></i>CETAK</a></td>';
			echo '</tr>';
		}
		
			echo '</table>';
		}else{
			echo "DATA KOSONG";
		}
	}
	

	
	function repMRprint()
	{
		$nomor=$_GET['nomr'];
		$nama=$_GET['nama'];
		
		$this->load->library('database_library');
		$this->database_library->pake_table('penjualan_apotik_rs');
		
		//INFO DATA
		$data['nomr']=$nomor;
		$data['nama']=$nama;
		
		//DATA DETAIL
			
		
		
		$select="obat.nama_obat, penjualan_apotik_rs_detail.qty, penjualan_apotik_rs_detail.harga_jual,(penjualan_apotik_rs_detail.qty*penjualan_apotik_rs_detail.harga_jual) as subtotal";	
		
		$from="penjualan_apotik_rs_detail LEFT JOIN obat ON penjualan_apotik_rs_detail.id_obat = obat.id_obat";
		
		$arraysearch2=array('penjualan_apotik_rs_detail.NoMR'=>$nomor);		
		$data['isdata']=$this->database_library->ambil_data_where_custom($select,$from,$arraysearch2);
		$this->load->view('laporan/repMR',$data);
	}
}