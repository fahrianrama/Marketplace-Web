

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
            <i class="icon fa fa-user"></i> Selamat datang <strong><?php echo $_SESSION['nama_user']; ?></strong> di Aplikasi Management Kopi Rindu. 
          </p>
          <p style="font-size:15px">"Management Kopi Rindu Merupakan
          aplikasi untuk memanajemen stok dan membantu pegawai atau karyawan pada tiap cabang untuk memperkirakan banyaknya stok yang akan diajukan kepada gudang untuk kedepannya, fitur yang terdapat dalam aplikasi
          ini adalah, manajemen stok dan transaksi/pesanan, perkiraan/ramalan penjualan kedepan, serta pengaturan permintaan dan pengajuan restok pada gudang bagi tiap cabang.&quot;</p>
        </div>
        
      </div>
      <!-- button ramal -->
      <div class="col-md-12">
          <form action="?module=beranda&act=ramal" method="POST">
            <button type="submit" class="btn btn-primary btn-lg btn-block" name="ramal">
              <i class="fa fa-calendar"></i> Ramal Penjualan
            </button>
          </form>
      </div>
      <br>
      <!-- exponential smoothing -->
      <!-- if isset ramal -->
      <?php
        include_once "peramalan.php"; ?>

    </div>
  </section>
  <style>
    table tr{
   height: 100px;
}
  </style>

   
    