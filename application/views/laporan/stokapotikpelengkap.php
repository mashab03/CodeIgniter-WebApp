<?php
inc_app('themes','headerreport');
?>
<style>
	.table .text-right {text-align: right}
.table .text-left {text-align: left}
.table .text-center {text-align: center}
</style>
<center><h3><?= $title;?></h3></center>
<p>&nbsp;</p>
<a class="btn btn-medium btn-primary"href="#" onClick="window.print();"><i class="icon-print"></i> Cetak</a>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
<thead>
<th width="15%">Nama Obat</th>
<th width="9%">Satuan</th>
<th width="18%">Harga Modal</th>
<th width="15%">Harga Jual</th>
<th width="13%">Sisa Stok</th>
<th width="14%">Sub Total</th>
<th width="15%">Keterangan</th>
<td width="1%"></thead>
<?php
if(!empty($isdata))
{
	foreach($isdata as $row)
	{
		$total=$total+($row->harga_jual*$row->jumlah);
		echo '<tr>';
		echo '<td>'.$row->nama_obat.'</td>';
		echo '<td>'.$row->nama_satuan.'</td>';
		echo '<td class="text-right">'.convertrp($row->harga_beli).'</td>';
		echo '<td class="text-right">'.convertrp($row->harga_jual).'</td>';
		echo '<td class="text-center">'.$row->jumlah.'</td>';
		echo '<td class="text-right">'.convertrp($row->harga_jual*$row->jumlah)."</td>";
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
	echo '<tr>
<td colspan="5"><strong><center>TOTAL</center></strong></td>
<td>'.convertrp($total).'</td>
</tr>';
}
?>
</table>
<?php
inc_app('themes','ttd');
inc_app('themes','footerreport');
?>