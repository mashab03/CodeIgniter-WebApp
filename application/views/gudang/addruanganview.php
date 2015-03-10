<?php
get_header();
?>
<h1>Tambah Ruangan</h1>

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
<label class="control-label" for="inputEmail">Nama Ruangan</label>
<div class="controls">
<input type="text" id="inputEmail" name="nama" placeholder="Nama Ruangan" data-validation="length" data-validation-length="min3">
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