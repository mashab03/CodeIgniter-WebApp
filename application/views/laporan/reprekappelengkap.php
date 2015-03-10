<?php
inc_app('themes','headerreport');
?>
<p>&nbsp;</p>
<center><h3>LAPORAN REKAP PER RESEP</h3><br /><h4>Apotik Pelengkap</h4></center>
<p>&nbsp;</p>
<a class="btn btn-medium btn-primary"href="#" onClick="window.print();"><i class="icon-print"></i> Cetak</a>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
<thead>
<th>Tanggal</th>
<th>Nama</th>
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
	echo '<td>'.$row->Nama."</td>";
	echo '<td>'.$row->nama_obat."</td>";
	echo '<td>'.$row->qty."</td>";
	echo '<td>'.convertrp($row->harga_jual)."</td>";
	echo '<td>'.convertrp($row->subtotal)."</td>";
	echo '</tr>';
}
}else{
	echo "KOSONG";
}
?>
</table>
    <div class="row-fluid">
    <div class="span4"><h3>Total</h3></div>
    <div class="span8"><h3><?=convertrp($total);?></h3><br /></div>
    </div>
    <h4>Terbilang : <?=terbilang($total);?> rupiah</h4>
</div>
<?php
inc_app('themes','ttd');
inc_app('themes','footerreport');
?>