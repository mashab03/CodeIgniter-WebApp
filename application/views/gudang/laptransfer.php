<?php
get_header();
?>
<script type="text/javascript" src="<?=base_url();?>assets/themes/js/jquery-ui.js"></script>
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
    <div class="alert alert-info">
    Cari Berdasarkan Tanggal
    </div>
<?php
$att=array(
	'class'=>'form-horizontal',
	'id'=>'myform',
	);
echo form_open('gudang/laporan/reptransfertgl',$att)
?>
<div class="control-group">
    <label class="control-label" for="inputPassword">Pilih Tanggal</label>
    <div class="controls">
    dari tanggal<input type="text" id="datepicker2"  name="tgl" placeholder="Tanggal Transfer">hingga<input type="text" id="datepicker3"  name="tgl2" placeholder="Tanggal Transfer">
    </div>
    </div>   
    
    <div class="control-group">
    <div class="controls">   
    <button type="submit" class="btn btn-success" name="submit">Kirim</button>
    </div>
    </div>
    </form>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
       <div class="alert alert-info">
    Cari Berdasarkan Kata Pencarian
    </div>
<?php
$att=array(
	'class'=>'form-horizontal',
	'id'=>'myform1',
	);
echo form_open('gudang/laporan/reptransferkey',$att)
?>
<div class="control-group">
    <label class="control-label" for="inputPassword">Pilih Tanggal</label>
    <div class="controls">
    <select name="key">
    <option value="transfer_obat.apotik">Tujuan Apotik</option>
    <option value="obat.nama_obat">Nama Obat</option>
    </select>
    Tujuan Apotik ex. Rumah Sakit (rs) / Pelengkap (pelengkap)
    </div>
    </div>   
  <div class="control-group">
    <label class="control-label" for="inputPassword">Kata Pencarian</label>
    <div class="controls">
    <input name="value" type="text">
    </div>
    </div>    
    <div class="control-group">
    <div class="controls">   
    <button type="submit" class="btn btn-success" name="submit">Kirim</button>
    </div>
    </div>
    </form>
<?php get_footer();?>