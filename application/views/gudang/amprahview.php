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

function checkdata()
{     
        var tersedia = $('#tersedia').val();
		var qty = $('#jumlah').val();
		if(qty > tersedia || qty=="0")
		{
			alert('Jumlah yang dikirim melebihi batas yang tersedia');
			$('#jumlah').val('0');
			$('#jumlah').focus();
			return false;
		}else{
			return true;
		}		
}
</script>
<script>
jQuery(document).ready(function(){

	$('input[name^=namaobat]').autocomplete({		
		source:'<?=base_url('data/barang/getobat');?>', 
		minLength:2,		
		select:function(evt, ui)
		{	
			
			this.form.kode.value = ui.item.kode;
			this.form.nama_obat.value = ui.item.value;
			this.form.tersedia.value = Number(ui.item.stok_akhir)-(Number(ui.item.stok_rs)+Number(ui.item.stok_pelengkap));	
			$('#jumlah').focus();	
		}
	});
});

jQuery(document).ready(function(){

	$('input[name^=namaruang]').autocomplete({		
		source:'<?=base_url('data/ruangan/getruangan');?>', 
		minLength:2,		
		select:function(evt, ui)
		{	
			
			this.form.koderuang.value = ui.item.id_ruangan;
			this.form.namaruang.value = ui.item.nama_ruangan;
						
		}
	});
});

function getcart() {
    $.get('<?= base_url('gudang/amprah/lihat');?>', function(data) {
      $('#responsecontainer').html(data);
    });
}
      $(function () {
        $('input[name=submit]').click(function (e) {
		 var tersedia = $('#tersedia').val();
		var qty = $('#jumlah').val();
		if(Number(qty) > Number(tersedia) || qty=="0")
		{
			alert('Jumlah yang dikirim melebihi batas yang tersedia');
			$('#jumlah').val('0');
			$('#jumlah').focus();
			return false;
		}else{
          $.ajax({
            type: 'get',
            url: '<?= base_url('gudang/amprah/add');?>',
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
		}
        });
      });

</script>
<div class="alert alert-info">
<?php 
$att=array(
	'class'=>"form-horizontal",
	);
echo form_open(base_url('gudang/amprah/checkout'),$att);?>
<div class="control-group">
<label class="control-label" for="inputEmail">Kode Ruang</label>
<div class="controls">
<input type="text" id="koderuang" readonly="readonly" name="koderuang" placeholder="Kode Ruang">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Nama Ruang</label>
<div class="controls">
<input type="text" id="inputPassword" name="namaruang" placeholder="Nama Ruang">
</div>
</div>

<div class="control-group">
<label class="control-label" for="inputEmail">Tanggal</label>
<div class="controls">
<input type="text"  id="datepicker2" name="tgl" placeholder="Tanggal" title="Klik dan pilih Tanggal">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Keterangan</label>
<div class="controls">
<textarea name="keterangan" placeholder="Keterangan">
</textarea>
</div>
</div>
<hr>
<table id="mytable" class="table table-striped">
<thead>
<tr>
<th>Kode</th>
<th>Nama Barang</th>
<th>QTY</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody id="p_scents">
<tr>
<td><input type="text" data-validation="length" readonly="readonly" data-validation-length="1-40" id="kode" class="input-mini" name="kodeobat" value="" /></td>
<td><input type="text" data-validation="length" data-validation-length="1-100" id="nama_obat" class="input-large" name="namaobat" value="" title="Klik dan ketikkan minimal 2 karakter untuk mencari nama obat"/></td>
<td><input type="text" data-validation="number" data-validation-allowing="float" class="input-mini" name="jumlah" id="jumlah" value="" />
<input type="hidden" name="tersedia" id="tersedia" />
</td>
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
</div>
<?php
get_footer();
?>


 