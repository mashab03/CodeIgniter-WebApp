<?php get_header();?>
<?php
if(!empty($status))
{
?>
<div class="alert alert-success">
Password berhasil diubah
</div>
<?php    
}
?>
<?php
if(!empty($status2))
{
?>
<div class="alert alert-danger">
Password Gagal diubah
</div>
<?php    
}
?>
<?php
$att=array(
	'class'=>'form-horizontal',
	);
echo form_open('',$att);
?>
    <div class="control-group">
    <label class="control-label" for="inputEmail">Password Lama</label>
    <div class="controls">
    <input type="password" id="inputPassword" name="pass1" placeholder="Password Lama">
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Password Baru</label>
    <div class="controls">
    <input type="password" id="inputPassword" name="pass2" placeholder="Password Baru">
    </div>
    </div>
    <div class="control-group">
    <div class="controls">    
    <button type="submit" name="submit" class="btn">Ubah</button>
    </div>
    </div>
    </form>  
<?php get_footer();?>