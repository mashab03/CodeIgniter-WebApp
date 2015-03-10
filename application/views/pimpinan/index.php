<?php
get_header();
?>
<div class="row-fluid">
<ul class="thumbnails">


<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Laporan Penjualan Apotik Rumah Sakit</h3>
    <p>Laporan Penjualan Apotik Rumah Sakit</p>
    <p><a href="<?=base_url('apotik/laporan/repjualperiode');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>
<li class="span4">
<div class="thumbnail">                 
  <div class="caption">
    <h3>Laporan Penjualan Apotik Pelengkap</h3>
    <p>Laporan Penjualan Apotik Pelengkap</p>
    <p><a href="<?=base_url('apotikext/laporan/repjualperiode');?>" class="btn btn-primary">Masuk</a> </p>
  </div>
</div>
</li>

</ul>
</div>
<?php
get_footer();
?>