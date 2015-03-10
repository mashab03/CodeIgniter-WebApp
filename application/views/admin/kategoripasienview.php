<?php
get_header();
?>
<h1>Manajemen Kategori</h1>
<div class="alert alert-success">Klik <i class="icon-plus"></i><a href="<?=base_url('admin/kategoripasien/addkategori');?>"> <strong>di sini</strong> </a>untuk tambah data</div>
<?php

$no=0;
if(!empty($is_data))
{
?>
<table class="table table-hover">
<thead>
<tr>
<td>#</td>	
<td>Nama Kategori</td>
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
<td></td>
<td><?= $row->nama_kategori;?></td>
<td>
<a class="btn btn-small" onclick="window.location='<?=base_url();?>admin/kategoripasien/updateview?uid=<?=$row->id_kategori_pasien;?>'" href="javascript:void(0)"><i class="icon-trash"></i> Edit</a>
<a class="btn btn-small" onclick="window.location='<?=base_url();?>admin/kategoripasien/delete?uid=<?=$row->id_kategori_pasien;?>'" href="javascript:void(0)"><i class="icon-trash"></i> Hapus</a>
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