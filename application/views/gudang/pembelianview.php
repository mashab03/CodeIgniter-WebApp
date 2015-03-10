<?php
get_header();
?>
<script type="text/javascript" src="<?=base_url();?>assets/themes/js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?=base_url();?>assets/themes/css/jquery-autocomplete.css">
<script>
$(function() {
$("#datepicker2").datepicker({        
		 dateFormat: "yy-mm-dd",
		 showAnim:"slide",
    });
});
$(function() {
$("#datepicker3").datepicker({        
		 dateFormat: "yy-mm-dd",
		 showAnim:"slide",
    });
});
</script>
<script>
jQuery(document).ready(function(){

	$('input[name^=namaobat]').autocomplete({		
		source:'<?=base_url('data/barang/getobat');?>', 
		minLength:2,		
		select:function(evt, ui)
		{	
			
			this.form.kode.value = ui.item.kode;
			this.form.namaobat.value = ui.item.value;
			this.form.satuan.value = ui.item.satuan;
			this.form.hargabeli.value = ui.item.harga_beli;
			this.form.hargajual.value = ui.item.harga_jual;
			$('#jumlah').focus();
		}
	});
});

jQuery(document).ready(function(){

	$('input[name^=namasup]').autocomplete({		
		source:'<?=base_url('data/supplier/getsupplier');?>', 
		minLength:2,		
		select:function(evt, ui)
		{	
			
			this.form.kodesup.value = ui.item.id_supplier;
			this.form.namasup.value = ui.item.nama_supplier;
			this.form.alamatsup.value = ui.item.alamat;
						
		}
	});
});
</script>
<script>
function getcart() {
    $.get('<?= base_url('gudang/pembelian/lihat');?>', function(data) {
      $('#responsecontainer').html(data);
    });
}
      $(function () {
        $('input[name=submit]').click(function (e) {
			
				  $.ajax({
					type: 'get',
					url: '<?= base_url('gudang/pembelian/add');?>',
					data: $('form').serialize(),
					error: function (xhr, ajaxOptions, thrownError) {
						return false;		  	
					},
					beforeSend: function() {
					$('#responsecontainer').html("<img src='<?= base_url();?>/assets/img/ajax-loader.gif' />");
					 },
					success: function () {
						getcart();
					
					}
				  });
				  e.preventDefault();
			 
        });
      });
	  
	 
    </script>
<?php 
$att=array(
	'class'=>"form-horizontal",
	);
echo form_open(base_url('gudang/pembelian/checkout'),$att);?>
<div class="control-group">
<label class="control-label" for="inputEmail">Kode Supplier</label>
<div class="controls">
<input type="text" id="kodesup" readonly="readonly" name="kodesup" placeholder="Kode Supplier">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Nama Supplier</label>
<div class="controls">
<input type="text" id="namasup" name="namasup" placeholder="Nama Supplier">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputEmail">Alamat</label>
<div class="controls">
<input type="text" id="alamatsup" readonly="readonly" name="alamatsup" placeholder="Alamat">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Nomor Faktur</label>
<div class="controls">
<input type="text" id="inputPassword" name="po" placeholder="Nomor Faktur">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputEmail">Tanggal</label>
<div class="controls">
<input type="text"  id="datepicker2" readonly="readonly" name="tgl" placeholder="Tanggal">
</div>
</div>
<hr>
<table id="mytable" class="table table-striped">
<thead>
<tr>
<th>Kode</th>
<th>Nama Barang</th>
<th>QTY</th>
<th>Satuan</th>
<th>Harga Beli</th>
<th>Harga Jual</th>
<th>Tanggal Kadaluarsa</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody id="p_scents">
<tr>
<td><input type="text" readonly="readonly" data-validation="length" data-validation-length="1-40" id="kode" class="input-mini" name="kodeobat" value="" /></td>
<td><input type="text" data-validation="length" data-validation-length="1-100" id="namaobat" class="input-large" name="namaobat" value="" /></td>
<td><input type="text" data-validation="number" data-validation-allowing="float" class="input-mini" name="jumlah" id="jumlah" value="" /></td>
<td><input type="text" data-validation="length" data-validation-length="1-50" id="satuan" class="input-mini" name="satuan" readonly="readonly" value="" /></td>
<td><input type="text" data-validation="number" data-validation-allowing="float" id="hargabeli" class="input-small" name="hargabeli" value="" /></td>
<td><input type="text" data-validation="number" data-validation-allowing="float" id="hargajual" class="input-small" name="hargajual" value="" /></td>
<td><input class="input-small" id="datepicker3" name="kadaluarsa" data-validation="date" data-validation-format="yyyy-mm-dd" type="text"></td>
<td><input name="submit" type="submit" class="btn btn-small btn-primary" value="Tambahkan"></td>

<td></td>
</tr>
</tbody>
</table>
<div id="responsecontainer" align="center">
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<input type="submit" name="submit2" value="Simpan Semua" class="btn btn-success" />
</form>
<?php
get_footer();
?>


 