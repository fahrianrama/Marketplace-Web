
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-level-up icon-title"></i> Data Pesanan Customer
    <!-- button akhiri penjualan -->
    <a href="?module=proses_data_proses&act=endtoday" style="margin-left: 20px;" class="btn btn-danger btn-social pull-right" title="Akhiri Penjualan">
      <i class="fa fa-plus"></i> Akhiri Penjualan
    </a>

    <a class="btn btn-primary btn-social pull-right" href="?module=form_data_proses&form=add" title="Tambah Data" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Tambah
    </a>
  </h1>

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

    <?php  
    if ($_SESSION['hak_akses']=='Super Admin') {
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) {
      echo "";
    } 
    // jika alert = 1
    // tampilkan pesan Sukses "Data Barang Masuk berhasil disimpan"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Hasil berhasil disimpan.
            </div>";
    }
    if (isset($_POST['cari'])) {
      $isiawal = $_POST['tanggal_awal'];
      $isiakhir = $_POST['tanggal_akhir'];
    }
    else if (isset($_POST['proses'])) {
      $isiawal = $_POST['tanggal_awal'];
      $isiakhir = $_POST['tanggal_akhir'];
    }
    else {
      $isiawal = date("d-m-Y");
      $isiakhir = date("d-m-Y");
    }
    ?>

      <div class="box box-primary">
        <div class="box-body">
          <table class="table">

            <td >
            <div class="form-group">
              <form role="form" class="form-horizontal" action="./main.php?module=data_proses" method="POST" name="formcari">
                
                <table>
                  <thead>
                    <h3>Cari Data Transaksi</h3>
                  </thead>
                  <tbody >
                  <tr >
                    <td>
                      <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_awal" autocomplete="off" value="<?php echo $isiawal; ?>" required>
                    </td>
                    <td>
                      <label class="col-sm-4 control-label">-</label>
                    </td>
                    <td>
                      <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_akhir" autocomplete="off" value="<?php echo $isiakhir; ?>" required>
                    </td>
                  </tr>
                  </tbody>
                </table>
                <div class="box-footer">
                  <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-submit" name="cari" value="Cari">
                  </div>
                </div><!-- /.box footer -->
              </form>
            </div>
            </td>
            
        </table>
        </div>
          
            <?php

            // fungsi untuk pengecekan status login user 
            // jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
            if (empty($_SESSION['username']) && empty($_SESSION['password'])){
                echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
            }
            // jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
            else {
                    if (isset($_POST['cari'])) {
                        // ambil data hasil submit dari form
                        $tanggal         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_awal']));
                        $exp             = explode('-',$tanggal);
                        $tanggal_awal  = $exp[2]."-".$exp[1]."-".$exp[0];
                        $tanggal2         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_akhir']));
                        $exp             = explode('-',$tanggal2);
                        $tanggal_akhir   = $exp[2]."-".$exp[1]."-".$exp[0];
                        
                        $created_user    = $_SESSION['id_user'];
                        $no = 1;
                        // fungsi query untuk menampilkan data dari tabel barang
                        $query = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_keluar,a.kode_barang,a.jumlah_keluar,b.kode_barang,b.harga_jual,b.nama_barang,b.satuan
                                                        FROM tb_keluar as a INNER JOIN tb_barang as b ON a.kode_barang=b.kode_barang WHERE (a.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir') ORDER BY kode_transaksi DESC ")
                                                        or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));

                        ?>
                        <!-- tampilan tabel Barang -->
                        <table id="tableData" class="table table-bordered table-striped table-hover">
                          <!-- tampilan tabel header -->
                          <thead>
                            <tr>
                              <th class="center">No.</th>
                              <th class="center">Kode Transaksi</th>
                              <th class="center">Tanggal</th>
                              <th class="center">Kode Barang</th>
                              <th class="center">Nama Barang</th>
                              <th class="center">Harga Jual</th>
                              <th class="center">Jumlah Keluar</th>
                              <th class="center">Satuan</th>
                            </tr>
                          </thead>
                          <!-- tampilan tabel body -->
                          <tbody>
                          <?php
                          // tampilkan data
                          while ($data = mysqli_fetch_assoc($query)) { 
                            $tanggal         = $data['tanggal_keluar'];
                            $exp             = explode('-',$tanggal);
                            $tanggal_keluar   = $exp[2]."-".$exp[1]."-".$exp[0];
                            $harga_jual = format_rupiah($data['harga_jual']);
                            
                            // menampilkan isi tabel dari database ke tabel di aplikasi
                              echo "<tr>
                                      <td width='30' class='center'>$no</td>
                                      <td width='100' class='center'>$data[kode_transaksi]</td>
                                      <td width='80' class='center'>$tanggal_keluar</td>
                                      <td width='80' class='center'>$data[kode_barang]</td>
                                      <td width='200'>$data[nama_barang]</td>
                                      <td width='100' align='right'>Rp. $harga_jual</td>
                                      <td width='100' align='right'>$data[jumlah_keluar]</td>
                                      <td width='80' class='center'>$data[satuan]</td>
                                    </tr>";
                              $no++;
                            } ?>
                          </tbody>
                        </table>
                        
                            <?php
                      }
                      ?>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->
<?php }
    }
else if ($_SESSION['hak_akses']=='Agen') { ?>
<div class="row">
    <div class="col-md-12">

    <?php  
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) {
      echo "";
    } 
    // jika alert = 1
    // tampilkan pesan Sukses "Data Barang Masuk berhasil disimpan"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Barang Keluar berhasil disimpan.
            </div>";
    }
    ?>

      <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel Barang -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <?php if ($_SESSION['hak_akses']=='Super Admin') {?>
                <th class="center">Agen</th><?php } ?>
                <th class="center">Kode Transaksi</th>
                <th class="center">Tanggal</th>
                <th class="center">Kode Barang</th>
                <th class="center">Nama Barang</th>
                <th class="center">Harga Jual</th>
                <th class="center">Jumlah Keluar</th>
                
                <th class="center">Satuan</th>
                <th class="center">Proses</th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel barang
            $query = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_keluar,a.kode_barang,a.jumlah_keluar,a.created_user,a.status_terima,b.kode_barang,b.harga_jual,b.nama_barang,b.satuan
                                            FROM tb_pesanan as a INNER JOIN tb_barang as b ON a.kode_barang=b.kode_barang ORDER BY kode_transaksi DESC")
                                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              $tanggal         = $data['tanggal_keluar'];
              $exp             = explode('-',$tanggal);
              $tanggal_keluar   = $exp[2]."-".$exp[1]."-".$exp[0];
			        $harga_jual = format_rupiah($data['harga_jual']);
              if ($_SESSION['hak_akses']=='Agen' && $data['tanggal_keluar'] == date('Y-m-d')) {
                if ($data['created_user'] == $_SESSION['nama_user']){
                // menampilkan isi tabel dari database ke tabel di aplikasi
                  echo "<tr>
                          <td width='30' class='center'>$no</td>
                          <td width='100' class='center'>$data[kode_transaksi]</td>
                          <td width='80' class='center'>$tanggal_keluar</td>
                          <td width='80' class='center'>$data[kode_barang]</td>
                          <td width='200'>$data[nama_barang]</td>
                          <td width='100' align='right'>Rp. $harga_jual</td>
                          <td width='100' align='right'>$data[jumlah_keluar]</td>
                          <td width='80' class='center'>$data[satuan]</td>
                          <td class='center' width='100'>
                          <div>";?>
                            <a data-toggle='tooltip' data-placement='top' title='Hapus' class='btn btn-primary btn-sm' href='modules/barang-keluar/proses.php?act=delete&id=<?php echo $data["kode_transaksi"];?>'>
                                  <i style='color:#fff' class='glyphicon glyphicon-minus-sign'></i>
                              </a>
                            </div>
                        </td>
                        </tr>
                        <?php ;
                  }
                }
                }
              $no++;
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content
<?php
}
?>