<?php
inc_app('themes','headerreport');
?>
<center><h3><?= $title;?></h3></center>
<p>&nbsp;</p>
<a class="btn btn-medium btn-primary"href="#" onClick="window.print();"><i class="icon-print"></i> Cetak</a>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
<thead>
<th>Nama Obat</th>
<th>Satuan</th>
<th>Harga Jual</th>
<th>Sisa Stok</th>
<th>Kadaluarsa</th>
<th>Keterangan</th>
</thead>
<?php
if(!empty($isdata))
{
	foreach($isdata as $row)
	{
		echo '<tr>';
		echo '<td>'.$row->nama_obat.'</td>';
		echo '<td>'.$row->nama_satuan.'</td>';
		echo '<td>'.$row->harga_jual.'</td>';
		echo '<td>'.$row->jumlah.'</td>';
		echo '<td>'.$row->kadaluarsa.'</td>';
		echo '<td>';
		$sisa=$row->jumlah;
		if($sisa <= $row->min_order)
		{
			echo '<span class="label label-important">Segera Order</span>';
		}else if($sisa > $row->min_order){
			echo '<span class="label label-success">Masih ada</span>';
		}
		echo '</td>';
		echo "</tr>";
	}
}
?>
</table>
<?php
inc_app('themes','ttd');
inc_app('themes','footerreport');
?>