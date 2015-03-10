<?php
get_header();
?>
<h1>Tambah Data Obat</h1>
<?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
<?php
if(!empty($isok))
{
	echo '<div class="alert alert-success">'.$isok.'</div>';
}

$att=array(
	'class'=>'form-horizontal',
	'role'=>'form',
	);
echo form_open('gudang/obat/update?uid='.$id.'',$att);
?>
   <div class="control-group">
<label class="control-label" for="inputEmail">Nama Obat</label>
<div class="controls">
<input type="text" id="inputEmail" name="nama" value="<?=$nama;?>" placeholder="Masukkan Nama Obat" data-validation="length" data-validation-length="min3">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Kategori</label>
<div class="controls">
<?php
bindingcombo("kategori_obat","kategori","id_kategori_obat","nama_kategori");
?>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Satuan</label>
<div class="controls">
<?php
bindingcombo("satuan_obat","satuan","id_satuan_obat","nama_satuan");
?>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Apotik</label>
<div class="controls">
<select name="apotik">
<option value="Rumah Sakit">Rumah Sakit</option>
<option value="Pelengkap">Pelengkap</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Harga Beli</label>
<div class="controls">
<input type="text" id="inputPassword" name="beli" value="<?=$beli;?>" placeholder="Masukkan Harga Beli" data-validation="number" data-validation-allowing="float">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Harga Jual</label>
<div class="controls">
<input type="text" id="inputPassword" name="jual" value="<?=$jual;?>" placeholder="Masukan Harga Jual" data-validation="number" data-validation-allowing="float">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Minimal Order</label>
<div class="controls">
<input type="text" id="inputPassword" name="order" value="<?=$order;?>" placeholder="Masukan Minimal Order" data-validation="number" data-validation-allowing="float">
</div>
</div>
<div class="control-group">
<div class="controls">
<button type="submit" class="btn btn-success">Simpan</button>
<button type="submit" class="btn btn-inverse" onclick="return confirm('Yakin batalkan data ini?');">Batal</button>
</div>
</div>
</form>
<?php
get_footer();
?>