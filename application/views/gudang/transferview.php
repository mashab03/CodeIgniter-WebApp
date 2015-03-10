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
$('#apply-form input').blur(function() {
     if(!$.trim(this.value).length) { 
            $(this).parents('p').addClass('warning');
     }
});

$(function () {
        $('form').on('submit', function (e) {
        var tersedia = $('#tersedia').val();
		var qty = $('#qty').val();
		if(qty > parseInt(tersedia) || qty=="0")
		{
			alert('Jumlah yang dikirim melebihi batas yang tersedia');
			$('#qty').val('0');
			$('#qty').focus();
			return false;
		}else{
			return true;
		}		
        });
      });

</script>
<script>
jQuery(document).ready(function(){

	$('input[name^=nama]').autocomplete({		
		source:'<?=base_url('data/barang/getobat');?>', 
		minLength:2,
		select:function(evt, ui)
		{	
			
			this.form.kode.value = ui.item.kode;
			this.form.nama.value = ui.item.value;
			this.form.satuan.value = ui.item.satuan;
			var akhir = ui.item.stokakhir;
			var srs = ui.item.stok_rs;
			var spl = ui.item.stok_pelengkap;
			var tt=Number(srs)+Number(spl);
			var tsd=Number(akhir)-Number(tt);		
			this.form.stokakhir.value = akhir;	
			this.form.tersedia.value = tsd;	
			this.form.tersedia2.value = tsd;		
			this.form.qty.value = 0;
		}
	});
});

$(document).ready(function() {

    $('#info').appendTo("body").modal('show')

});
</script>
<div id="top"> 
<a class="btn btn-primary btn-medium" tabindex="-1" href="#" id="metadata-link" data-target="#info" data-toggle="modal">Info Cara Entry</a>      
</div>
<?php
$att=array(
	'class'=>'form-horizontal',
	'id'=>'myform',
	);
$CI=& get_instance();
$info=$CI->session->flashdata('info');
if(!empty($info))
{
	echo '<div class="alert alert-info">Sukses ditambahkan</div>';
}
echo form_open('gudang/transfer/add',$att)
?>
    <div class="control-group">
    <label class="control-label" for="inputEmail">Tujuan</label>
    <div class="controls">
    <select name="apotik">
    <option value="rs">Apotik Rumah Sakit</option>
    <option value="pelengkap">Apotik Pelengkap</option>
    </select>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Tanggal Transfer</label>
    <div class="controls">
    <input type="text" id="datepicker2"  name="tgl" placeholder="Tanggal Transfer">
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Nama Obat</label>
    <div class="controls">
    <input type="text" id="nama" data-validation="length" data-validation-length="min1" name="nama">
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Kode Obat</label>
    <div class="controls">
    <input type="text" id="kode" readonly="readonly" name="kode">
    </div>
    </div>    
    <div class="control-group">
    <label class="control-label" for="inputPassword">Satuan</label>
    <div class="controls">
    <input type="text" id="satuan" readonly="readonly" name="satuan">
    </div>
    </div>
    <input type="hidden" id="tersedia" name="tersedia" />
     <div class="control-group">
    <label class="control-label" for="inputPassword">Tersedia</label>
    <div class="controls">
    <input type="text" id="tersedia2" name="tersedia2">
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">QTY</label>
    <div class="controls">
    <input type="text" id="qty" data-validation="number" data-validation-allowing="float" name="qty">
    <input type="hidden" id="stokakhir" name="stokakhir" value="0" />
    </div>
    </div>
   
    <div class="control-group">
    <div class="controls">   
    <button type="submit" class="btn btn-success" name="submit">Kirim</button>
    </div>
    </div>
    </form>
    <div id="info" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Cara Entri Data Transfer</h3>
</div>
<div class="modal-body">
<li>Klik inputan tanggal, lalu pilih tanggal</li>
<li>Klik inputan Nama Obat, lalu ketikan nama obat (minimal 2 karakter)</li>
<li>Masukkan jumlah transfer pada inputan Qty</li>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Keluar</button>
</div>
</div>
<?php
get_footer();
?>