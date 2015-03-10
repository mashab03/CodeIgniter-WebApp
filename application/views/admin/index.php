<?php
get_header();
?>
<div class="alert alert-success">
  <h3>Selamat Datang, Silahkan tambah data user <a href="<?=base_url('admin/adduser');?>" class="alert-link"> Di sini </a></h3>
</div>
<div class="row-fluid">
<ul class="thumbnails">


<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>User Management</h3>
    <p>Halaman untuk menambah,mengubah dan menghapus data user</p>
    <p><a href="<?=base_url('admin/userview');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>
<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Konfigurasi Sistem</h3>
    <p>Beberapa data yang mungkin dapat anda ubah</p>
    <p><a href="<?=base_url('admin/config');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>
<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Database Tools</h3>
    <p>Alat untuk optimasi database</p>
    <p><a href="<?=base_url('admin/dbtool');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>

</ul>
</div>
<?php
get_footer();
?>