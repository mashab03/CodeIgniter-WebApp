<?php
get_header();
?>
<h1>Manajemen User</h1>
<?php

$no=0;
if(!empty($is_data))
{
?>
<table class="table table-hover">
<thead>
<tr>
<td>#</td>	
<td>Username</td>
<td>Nama</td>
<td>Akses</td>
<td>Status</td>
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
<td><?= $row->username_special;?></td>
<td><?= $row->nama;?></td>
<td>
<select name="akses">
<option value="<?= $row->role_special;?>"><?= $row->role_special;?></option>
<option disabled="disabled">-Pilih Akses Login-</option>
<option value="gudang" onclick="window.location='<?=base_url();?>admin/userview/changeakses?uid=<?=$row->id_user;?>&r=gudang'">Bagian Gudang</option>
<option value="apotik" onclick="window.location='<?=base_url();?>admin/userview/changeakses?uid=<?=$row->id_user;?>&r=apotik'">Bagian Apotik</option>
<option value="apotikext" onclick="window.location='<?=base_url();?>admin/userview/changeakses?uid=<?=$row->id_user;?>&r=apotikext'">Bagian Apotik Pelengkap</option>
<option value="admin" onclick="window.location='<?=base_url();?>admin/userview/changeakses?uid=<?=$row->id_user;?>&r=admin'">Bagian Admin</option>
<option value="pimpinan" onclick="window.location='<?=base_url();?>admin/userview/changeakses?uid=<?=$row->id_user;?>&r=pimpinan'">Pimpinan</option>
</select>
</td>
<td><?= $row->status;?></td>
<td>
<?php
$ss=$row->status;
if($ss=="deactive")
{
?>
<a class="btn btn-small" onclick="window.location='<?=base_url();?>admin/userview/changestatus?uid=<?=$row->id_user;?>&r=active'" href="javascript:void(0)"><i class="icon-eye-open"></i> Active</a>
<?php
}else{
?>
<a class="btn btn-small" onclick="window.location='<?=base_url();?>admin/userview/changestatus?uid=<?=$row->id_user;?>&r=deactive'" href="javascript:void(0)"><i class="icon-eye-close"></i> Deactive</a>
<?php } ?>
<a class="btn btn-small" onclick="window.location='<?=base_url();?>admin/userview/delete?uid=<?=$row->id_user;?>'" href="javascript:void(0)"><i class="icon-trash"></i> Hapus</a>
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