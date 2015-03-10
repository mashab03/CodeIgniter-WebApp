<?php
get_header();
?>
<h1>Konfigurasi Web</h1>
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
echo form_open('',$att);
?>
   <div class="control-group">
<label class="control-label" for="inputEmail">Nama Perusahaan</label>
<div class="controls">
<input type="text" id="inputEmail" name="nama" value="<?=get_option('site_name');?>" placeholder="Nama Perusahaan" data-validation="length" data-validation-length="min3">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Nama Aplikasi</label>
<div class="controls">
<input type="text" id="inputPassword" name="app" value="<?=get_option('site_app');?>" placeholder="Nama Aplikasi" data-validation="length" data-validation-length="min5">
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