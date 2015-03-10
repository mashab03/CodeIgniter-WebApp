<?php
inc_app('themes','headerreport');
?>
<p>&nbsp;</p>
<?php
foreach($info as $rr)
{
	echo "<strong>Invoice No : ".$rr->id_penjualan_apotik_rs."<strong><br>";
	echo "<strong>Tanggal : ".converttgl($rr->tanggal)."<strong><br>";
	echo "<strong>No MR : ".$rr->NoMR."<strong><br>";
	echo "<strong>Nama : ".$rr->Nama."<strong><br>";
}
?>
<p>&nbsp;</p>
<a class="btn btn-medium btn-primary"href="#" onClick="window.print();"><i class="icon-print"></i> Cetak</a>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
<thead>
<th>Jenis Resep</th>
<th>Nama Obat</th>
<th>Jumlah</th>
<th>Jasa</th>
<th>Harga Satuan</th>
<th>Sub Total</th>
</thead>

<?php
if(!empty($isdata))
{
$total=0;
$total2=0;
$tjasa=0;
$jasaracikan=0;
foreach($isdata as $row)
{
	
	$jasaracikan=$row->biayajasa;
	echo '<tr>';
	$pp=$row->jasatipe;
	$tjasa=$tjasa+$pp;
	$total=$total+(($row->harga_jual*$row->qty)+$pp);
	$total2=$total2+(($row->harga_jual*$row->qty));	
	echo '<td>'.$row->tipe."</td>";
	echo '<td>'.$row->nama_obat."</td>";
	echo '<td>'.$row->qty."</td>";
	echo '<td>'.convertrp($pp)."</td>";
	echo '<td>'.convertrp($row->harga_jual)."</td>";
	echo '<td>'.convertrp(($row->harga_jual*$row->qty)+$pp)."</td>";
	echo '</tr>';
	
	
}
}else{
	echo "KOSONG";
}
?>
</table>
  
     <div class="row-fluid">
    <div class="span4"><h3>Jasa Racikan</h3><h3>Total</h3></div> 
  
    <div class="span8"><h3><?=convertrp(($jasaracikan));?></h3><h3><?=convertrp((($total2+$tjasa)+$jasaracikan));?></h3><br /></div>
    </div>
    <h4>Terbilang : <?=terbilang((($total2+$tjasa)+$jasaracikan));?> rupiah</h4>
</div>
<?php
inc_app('themes','ttd');
inc_app('themes','footerreport');
?>