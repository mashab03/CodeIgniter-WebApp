<?php
inc_app('themes','headerreport');
?>
<center><h3>Faktur Pembelian</h3></center>
<p>&nbsp;</p>
<a class="btn btn-medium btn-primary"href="#" onClick="window.print();"><i class="icon-print"></i> Cetak</a>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
<thead>
<th>Nama Obat</th>
<th>Jumlah</th>
<th>Harga Beli</th>
<th>Harga Jual</th>
</thead>
<?php
if(!empty($isdata))
{
foreach($isdata as $row)
{
	echo '<tr>';
	echo '<td>'.$row->nama_obat."</td>";
	echo '<td>'.$row->qty."</td>";
	echo '<td>'.$row->harga_beli."</td>";
	echo '<td>'.$row->harga_jual."</td>";
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