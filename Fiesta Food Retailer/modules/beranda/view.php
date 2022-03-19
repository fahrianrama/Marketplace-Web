

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-home icon-title"></i> Beranda
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda</a></li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <div class="alert alert-info alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <p style="font-size:15px">
            <i class="icon fa fa-user"></i> Selamat datang <strong><?php echo $_SESSION['nama_user']; ?></strong> di Aplikasi Gudang Barang Fiesta Food Retailer. 
          </p>
          <p style="font-size:15px">"Fiesta Food Retailer Merupakan
          perusahaan yang meiliki kegiatan usaha utama yaitu menjual barang kering. Seluruh persediaan toko yang akan digunakan disimpan dalam gudang barang kering, jadi penyimpanan serta pengambilan persediaan bahan. diciptakan nya Aplikasi ini semoga bisa mempercepat dalam proses pemasukan barang masuk dan barang keluar di dalam pergudangan.&quot;</p>
        </div>
        
      </div>
      <h3 class="center">
        Pilih Menu
      </h3>
      <br>
      <?php
      if ($_SESSION['hak_akses']=='Super Admin') { ?>
      <table class="table">
          <tr>
            <td class="center">
              <a href="./main.php?module=user" class="btn btn-success btn-lg">Manajemen Profil Agen</button>
            </td>
            <td class="center">
              <a href="./main.php?module=barang" class="btn btn-danger btn-lg">Manajemen Persediaan</button>
            </td>
            <td class="center">
              <a href="./main.php?module=barang_keluar" class="btn btn-info btn-lg">Manajemen Pesanan</button>
            </td>
            
          </tr>
        </table>
        <?php }
        else if ($_SESSION['hak_akses']=='Agen') {
        ?>
        <table class="table">
          <tr>
            <td class="center">
              <a href="./main.php?module=barang_keluar" class="btn btn-success btn-lg">Manajemen Pengadaan</button>
            </td>
            <td class="center">
              <a href="./main.php?module=barang_masuk" class="btn btn-info btn-lg">Manajemen Persediaan</button>
            </td>
          </tr>
          <tr>
            <td class="center">
              <a href="./main.php?module=data_proses" class="btn btn-danger btn-lg">Manajemen Pesanan</button>
            </td>
            <td class="center">
              <a href="./main.php?module=data_hasil" class="btn btn-warning btn-lg">Laporan Keuangan</button>
            </td>
          </tr>
        </table>
        <?php }?>
    </div>
  </section>
  <style>
    table tr{
   height: 100px;
}
  </style>

   
    