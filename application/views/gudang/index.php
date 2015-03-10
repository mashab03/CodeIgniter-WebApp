<?php
get_header();
?>
<div class="row-fluid">
<ul class="thumbnails">


<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Supplier</h3>
    <p>Manajemen Supplier</p>
    <p><a href="<?=base_url('gudang/supplier');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>
<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Kategori Obat</h3>
    <p>Manajemen kategori obat</p>
    <p><a href="<?=base_url('gudang/kategori');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>
<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Satuan</h3>
    <p>Satuan Obat</p>
    <p><a href="<?=base_url('gudang/satuan');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>
</ul>
</div>

<div class="row-fluid">
<ul class="thumbnails">
<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Obat</h3>
    <p>Manajemen Obat</p>
    <p><a href="<?=base_url('gudang/obat');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>
<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Pembelian</h3>
    <p>Transaksi pembelian obat</p>
    <p><a href="<?=base_url('gudang/pembelian');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>
<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Transfer Obat</h3>
    <p>Transfer Obat ke Apotik</p>
    <p><a href="<?=base_url('gudang/transfer');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>

</ul>
</div>
<?php
get_footer();
?>