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
<th>No MR</th>
<th>Nama</th>
<th>Nama Obat</th>
<th>Jumlah</th>
<th>Harga Jual</th>
<th>Jasa Tipe</th>
<th>Sub Total</th>
</thead>
<?php
if(!empty($isdata))
{
$total=0;
$biayajasa=0;
foreach($isdata as $row)
{
	$biayajasa=$biayajasa+$row->biayajasa;
	$total=$total+($row->harga_jual*$row->qty);
	echo '<tr>';
	echo '<td>'.$row->tanggal."</td>";
	echo '<td>'.$row->NoMR."</td>";
	echo '<td>'.$row->Nama."</td>";
	echo '<td>'.$row->nama_obat."</td>";
	echo '<td>'.$row->qty."</td>";
	echo '<td>'.convertrp($row->harga_jual)."</td>";
	echo '<td>'.convertrp($row->jasatipe)."</td>";
	echo '<td>'.convertrp(($row->harga_jual*$row->qty)+$row->jasatipe)."<br>(".$row->biayajasa.")</td>";
	echo '</tr>';
}
	echo '<tr>
<td colspan="6"><strong><center>TOTAL</center></strong></td>
<td>'.convertrp(($total+$biayajasa)).'</td>
</tr>';
echo '<tr>
<td colspan="6"><strong><center>TOTAL JASA</center></strong></td>
<td>'.convertrp(($biayajasa)).'</td>
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