<?php
inc_app('themes','headerreport');
?>
<p>&nbsp;</p>
<?php
	echo "<h4>";
	echo "<strong>No MR: ".$nomr."<strong><br>";
	echo "<strong>Nama : ".$nama."<strong><br>";
	echo "</h4>";

?>
<p>&nbsp;</p>
<a class="btn btn-medium btn-primary"href="#" onClick="window.print();"><i class="icon-print"></i> Cetak</a>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
<thead>
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
	echo '<td>'.$row->nama_obat."</td>";
	echo '<td>'.$row->qty."</td>";
	echo '<td>'.convertrp($row->harga_jual)."</td>";
	echo '<td>'.convertrp($row->harga_jual*$row->qty)."</td>";
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