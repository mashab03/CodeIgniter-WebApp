<?php
get_header();
?>
<h1>Manajemen Obat</h1>
<div class="alert alert-success">Klik <i class="icon-plus"></i><a href="<?=base_url('gudang/obat/addobat');?>"> <strong>di sini</strong> </a>untuk tambah data</div>
<?php
$cl=array(
	'class'=>'form-horizontal',
	);
$att='form-control';
$atas='<option value="">-Pilih-</option>';
?>
<form class="form-horizontal" method="get">
Pencarian :<br>
 <div class="control-group">
<label class="control-label" for="inputEmail">Nama Obat</label>
<div class="controls">
<input type="text" name="nama">
</div>
</div>
 <div class="control-group">
<label class="control-label" for="inputEmail">Kategori</label>
<div class="controls">
<?=bindingcombo("kategori_obat","kategori","id_kategori_obat","nama_kategori",$att,$atas);?>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="inputEmail">Satuan</label>
<div class="controls">
<?=bindingcombo("satuan_obat","satuan","id_satuan_obat","nama_satuan",$att,$atas);?>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="inputEmail"></label>
<div class="controls">
<button class="btn btn-small btn-primarty">Cari</button>
</div>
</div>


<?php
echo form_close();
$no=0;
if(!empty($is_data))
{
?>
<table class="table table-hover">
<thead>
<tr>
<td>#</td>	
<td>Nama Obat</td>
<td>Kategori</td>
<td>Satuan</td>
<td>Tempat Apotik</td>
<td>Stok</td>
<td>Harga Modal</td>
<td>Harga Penjualan</td>
<td>Aksi</td>
</tr>
</thead>
<tbody>
<?php
	foreach($is_data['results'] as $row)
	{
	$no=$no+1;	

?>
<tr>
<td><?= $no;?></td>
<td><?= $row->nama_obat;?></td>
<td><?= $row->nama_kategori;?></td>
<td><?= $row->nama_satuan;?></td>
<td><?= $row->tipe_apotik;?></td>
<td><?= $row->stok_akhir;?></td>
<td><?= $row->harga_beli;?></td>
<td><?= $row->harga_jual;?></td>
<td>
<a class="btn btn-small" onclick="window.location='<?=base_url();?>gudang/obat/updateview?uid=<?=$row->id_obat;?>'" href="javascript:void(0)"><i class="icon-trash"></i> Edit</a>
<a class="btn btn-small" onclick="window.location='<?=base_url();?>gudang/obat/delete?uid=<?=$row->id_obat;?>'" href="javascript:void(0)"><i class="icon-trash"></i> Hapus</a>
</td>
</tr>
<?php }
?>
</tbody>
</table>
<?php }else{ ?>
<div class="alert alert-error"></div>
<?php } ?>

<?= $is_data['links']; ?>
<?php
get_footer();
?>