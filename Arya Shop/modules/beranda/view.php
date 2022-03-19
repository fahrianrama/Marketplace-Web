

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
            <i class="icon fa fa-user"></i> Selamat datang <strong><?php echo $_SESSION['nama_user']; ?></strong> di Aplikasi Gudang Barang Arya Shop. 
          </p>
          <p style="font-size:15px">"Arya Shop Merupakan
          perusahaan yang meiliki kegiatan usaha utama yaitu menjual barang kering. Seluruh persediaan toko yang akan digunakan disimpan dalam gudang barang kering, jadi penyimpanan serta pengambilan persediaan bahan. diciptakan nya Aplikasi ini semoga bisa mempercepat dalam proses pemasukan barang masuk dan barang keluar di dalam pergudangan.&quot;</p>
        </div>
        
      </div>
      <h3 class="center">
        Pilih Menu
      </h3>
      <table class="table" border="2">
          <tr>
            <td width = "365" class="center">
              <a href="http://localhost/Arya%20Shop/main.php?module=barang_keluar" class="btn btn-primary">Data Transaksi</button>
            </td>
            <td class="center">
              <a href="http://localhost/Arya%20Shop/main.php?module=data_proses" class="btn btn-warning">Data Proses</button>
            </td>
            <td class="center">
              <a href="http://localhost/Arya%20Shop/main.php?module=data_hasil" class="btn btn-success">Data Hasil</button>
            </td>
          </tr>
        </table>
    </div>
  </section>

   
    