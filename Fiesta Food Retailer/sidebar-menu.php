

<?php 
// fungsi pengecekan level untuk menampilkan menu sesuai dengan hak akses
// jika hak akses = Super Admin, tampilkan menu
if ($_SESSION['hak_akses']=='Super Admin') { ?>
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
  // jika tidak, menu data barang tidak aktif
  else { ?>
    <li>
      <a href="?module=barang"><i class="fa fa-folder"></i> Stok Barang </a>
      </li>
  <?php
  }
	if ($_GET["module"]=="barang_masuk") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-tasks"></i> <span>Data Transaksi</span> <i class="fa fa-angle-down pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=barang_masuk"><i class="fa fa-level-down"></i> Barang Masuk </a></li>
				<li><a href="?module=barang_keluar"><i class="fa fa-level-up"></i> Pengajuan Agen </a></li>
      		</ul>
    	</li>
    <?php
	}
	else if ($_GET["module"]=="barang_keluar") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-tasks"></i> <span>Data Transaksi</span> <i class="fa fa-angle-down pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=barang_masuk"><i class="fa fa-level-down"></i> Barang Masuk </a></li>
				<li class="active"><a href="?module=barang_keluar"><i class="fa fa-level-up"></i> Pengajuan Agen </a></li>
      		</ul>
    	</li>
    <?php
	}
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-tasks"></i> <span>Data Transaksi</span> <i class="fa fa-angle-down pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=barang_masuk"><i class="fa fa-level-down"></i> Barang Masuk </a></li>
				<li><a href="?module=barang_keluar"><i class="fa fa-level-up"></i> Pengajuan Agen </a></li>				
      		</ul>
    	</li>
    <?php
	}
  // jika menu data proses dipilih, menu data proses aktif
  if ($_GET["module"]=="data_proses" || $_GET["module"]=="form_proses") { ?>
    <li class="active">
      <a href="?module=data_proses"><i class="fa fa-refresh"></i> Data Transaksi </a>
      </li>
  <?php
  }
  // jika tidak, menu data hasil tidak aktif
  else { ?>
    <li>
      <a href="?module=data_proses"><i class="fa fa-refresh"></i> Data Transaksi </a>
      </li>
  <?php
  }

	// jika menu user dipilih, menu user aktif
	if ($_GET["module"]=="user" || $_GET["module"]=="form_user") { ?>
		<li class="active">
			<a href="?module=user"><i class="fa fa-user"></i> Profil Agen</a>
	  	</li>
	<?php
	}
	// jika tidak, menu user tidak aktif
	else { ?>
		<li>
			<a href="?module=user"><i class="fa fa-user"></i> Profil Agen</a>
	  	</li>
	<?php
	}

	// jika menu ubah password dipilih, menu ubah password aktif
	if ($_GET["module"]=="password") { ?>
		<li class="active">
			<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
		</li>
	<?php
	}
	// jika tidak, menu ubah password tidak aktif
	else { ?>
		<li>
			<a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
		</li>
	<?php
	}
	?>
	</ul>
	<!--sidebar menu end-->

// jika hak akses = Manajer, tampilkan menu

<?php
}
else if ($_SESSION['hak_akses']=='Agen') { ?>

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
	if ($_GET["module"]=="barang_masuk") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-tasks"></i> <span>Data Transaksi</span> <i class="fa fa-angle-down pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li class="active"><a href="?module=barang_masuk"><i class="fa fa-level-down"></i> Barang Masuk </a></li>
				<li><a href="?module=barang_keluar"><i class="fa fa-level-up"></i> Pengajuan Barang </a></li>
      		</ul>
    	</li>
    <?php
	}
	else if ($_GET["module"]=="barang_keluar") { ?>
		<li class="active treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-tasks"></i> <span>Data Transaksi</span> <i class="fa fa-angle-down pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=barang_masuk"><i class="fa fa-level-down"></i> Barang Masuk </a></li>
				<li class="active"><a href="?module=barang_keluar"><i class="fa fa-level-up"></i> Pengajuan Barang </a></li>
      		</ul>
    	</li>
    <?php
	}
	else { ?>
		<li class="treeview">
          	<a href="javascript:void(0);">
            	<i class="fa fa-tasks"></i> <span>Data Transaksi</span> <i class="fa fa-angle-down pull-right"></i>
          	</a>
      		<ul class="treeview-menu">
        		<li><a href="?module=barang_masuk"><i class="fa fa-level-down"></i> Barang Masuk </a></li>
				<li><a href="?module=barang_keluar"><i class="fa fa-level-up"></i> Pengajuan Barang </a></li>				
      		</ul>
    	</li>
    <?php
	}
	if ($_GET["module"]=="data_persediaan") { ?>
		<li class="active">
		  <a href="?module=data_persediaan"><i class="fa fa-archive"></i> Persediaan </a>
		  </li>
	  <?php
	  }
	  // jika tidak, menu data hasil tidak aktif
	  else { ?>
		<li>
		  <a href="?module=data_persediaan"><i class="fa fa-archive"></i> Persediaan </a>
		  </li>
	  <?php
	  }
	if ($_GET["module"]=="data_proses") { ?>
		<li class="active">
		  <a href="?module=data_proses"><i class="fa fa-refresh"></i> Pesanan </a>
		  </li>
	  <?php
	  }
	  // jika tidak, menu data hasil tidak aktif
	  else { ?>
		<li>
		  <a href="?module=data_proses"><i class="fa fa-refresh"></i> Pesanan </a>
		  </li>
	  <?php
	  }
	
	if ($_GET["module"]=="data_hasil" || $_GET["module"]=="form_hasil") { ?>
		<li class="active">
		<a href="?module=data_hasil"><i class="fa fa-file"></i> Data Hasil </a>
		</li>
	<?php
	}
	// jika tidak, menu data hasil tidak aktif
	else { ?>
		<li>
		<a href="?module=data_hasil"><i class="fa fa-file"></i> Data Hasil </a>
		</li>
	<?php
	}
	
}
?>