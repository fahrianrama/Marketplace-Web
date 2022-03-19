
	<!-- sidebar menu start -->
    <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>

	<?php 
	// fungsi untuk pengecekan menu aktif
	// jika menu beranda dipilih, menu beranda aktif
	if ($_GET["module"]=="beranda") { ?>
		<li class="active">
			<a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}
	// jika tidak, menu home tidak aktif
	else { ?>
		<li>
			<a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a>
	  	</li>
	<?php
	}

  // jika menu data barang dipilih, menu data barang aktif
  if ($_GET["module"]=="barang" || $_GET["module"]=="form_barang") { ?>
    <li class="active">
      <a href="?module=barang"><i class="fa fa-folder"></i> Stok Barang </a>
      </li>
  <?php
  }