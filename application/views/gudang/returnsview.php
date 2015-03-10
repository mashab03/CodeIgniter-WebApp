<?php
get_header();
?>
<?php
if(!empty($status))
{
	echo $status;
}
$no=0;
if(!empty($is_data))
{
?>
<table class="table table-hover">
<thead>
<tr>
<td>#</td>	
<td>Tanggal</td>
<td>Keterangan</td>
<td>Nama Ruang</td>
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
<td><?= $row->id_amprah;?></td>
<td><?= $row->tgl;?></td>
<td><?= $row->keterangan;?></td>
<td><?= $row->nama_ruangan;?></td>
<td>
<a class="btn btn-small" onclick="window.location='<?=base_url();?>gudang/returns/updateview?uid=<?=$row->id_amprah;?>'" href="javascript:void(0)"><i class="icon-edit"></i> Edit</a>
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


 