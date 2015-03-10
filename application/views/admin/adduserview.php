<?php
get_header();
?>
<h1>Tambah User</h1>
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
<label class="control-label" for="inputEmail">Username</label>
<div class="controls">
<input type="text" id="inputEmail" name="username" placeholder="Username" data-validation="length" data-validation-length="min3">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Password</label>
<div class="controls">
<input type="password" id="inputPassword" name="password" placeholder="Password" data-validation="length" data-validation-length="min5">
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Hak Akses</label>
<div class="controls">
<select name="akses">
<option>-Pilih Akses Login-</option>
<option value="gudang">Bagian Gudang</option>
<option value="apotik">Bagian Apotik</option>
<option value="apotikext">Bagian Apotik Pelengkap</option>
<option value="admin">Bagian Admin</option>
<option value="pimpinan">Pimpinan</option>
</select>
</div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">Nama</label>
<div class="controls">
<input type="text" id="inputPassword" name="nama" placeholder="Nama Pengguna" data-validation="length" data-validation-length="min5">
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