<?php
inc_app('themes','headerreport');
?>
<p>&nbsp;</p>
<center><h3><?=$title;?></h3></center>
<p>&nbsp;</p>
<a class="btn btn-medium btn-primary"href="#" onClick="window.print();"><i class="icon-print"></i> Cetak</a>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
<thead>
<th>Nama Obat</th>
<th>Jumlah</th>
<th>Tujuan</th>
<th>Tanggal</th>
</thead>

<?php
if(!empty($isdata))
{
foreach($isdata as $row)
{
	echo '<tr>';
	echo '<td>'.$row->nama_obat."</td>";
	echo '<td>'.$row->qty."</td>";
	echo '<td>'.$row->apotik."</td>";
	echo '<td>'.$row->tanggal."</td>";
	echo '</tr>';
}
}else{
	echo "KOSONG";
}
?>
</table>
<?php
inc_app('themes','ttd');
inc_app('themes','footerreport');
?>