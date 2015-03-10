<?php
inc_app('themes','headerreport');
?>
<p>&nbsp;</p>
<center><h3><?= $title;?></h3></center>
<p>&nbsp;</p>
<a class="btn btn-medium btn-primary"href="#" onClick="window.print();"><i class="icon-print"></i> Cetak</a>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
<thead>
<th>Tanggal</th>
<th>Nomor faktur</th>
<th>Nama Pembeli</th>
<th>Nama Obat</th>
<th>Jumlah</th>
<th>Harga Satuan</th>
<th>Sub Total</th>
</thead>
<?php
if(!empty($isdata))
{
$total=0;
foreach($isdata as $row)
{
	$total=$total+($row->harga_jual*$row->qty);
	echo '<tr>';
	echo '<td>'.$row->tanggal."</td>";
	echo '<td>'.$row->id_penjualan_apotik_pelengkap."</td>";
	echo '<td>'.$row->Nama."</td>";
		echo '<td>'.$row->nama_obat."</td>";
	echo '<td>'.$row->qty."</td>";
	echo '<td>'.convertrp($row->harga_jual)."</td>";
	echo '<td>'.convertrp($row->harga_jual*$row->qty)."</td>";
	echo '</tr>';
}
echo '<tr>
<td colspan="6"><strong><center>TOTAL</center></strong></td>
<td>'.convertrp($total).'</td>
</tr>';
}else{
	echo "KOSONG";
}
?>
</table>
<?php
inc_app('themes','ttd');
inc_app('themes','footerreport');
?>