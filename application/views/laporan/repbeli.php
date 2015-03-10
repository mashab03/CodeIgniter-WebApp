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
<th width="19%"><div align="center">Nama Supplier</div></th>
<th width="22%"> <div align="center">Nomor Faktur</div></th>
<th width="8%"><div align="center">Tanggal</div></th>
<th width="15%"><div align="center">Nama Obat</div></th>
<th width="8%"><div align="center">Jumlah</div></th>
<th width="14%"><div align="center">Harga Beli</div></th>
<th width="14%"><div align="center">Sub Total</div></th>
<td width="0%"></thead>
<?php
if(!empty($isdata))
{
	$total=0;
foreach($isdata as $row)
{
	$total=$total+($row->harga_beli*$row->qty);
	echo '<tr>';
	echo '<td>'.$row->nama_supplier."</td>";
	echo '<td>'.$row->nomorPO."</td>";
	echo '<td>'.$row->tanggal."</td>";
	echo '<td>'.$row->nama_obat."</td>";
	echo '<td>'.$row->qty."</td>";
	echo '<td>'.convertrp($row->harga_beli)."</td>";
	echo '<td>'.convertrp($row->harga_beli*$row->qty)."</td>";
	echo '</tr>';	
}
}else{
	echo "KOSONG";
}
?>
</table>
<div class="row-fluid">
<div class="span4"><h3>Total</h3></div>
    <div class="span8"><h3><?=convertrp($total);?></h3></div>
    </div>
</div>
<?php
inc_app('themes','ttd');
inc_app('themes','footerreport');
?>