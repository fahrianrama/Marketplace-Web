

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-level-up icon-title"></i> Data Pengajuan Cabang

    <a class="btn btn-primary btn-social pull-right" href="?module=form_barang_keluar&form=add" title="Tambah Data" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Tambah
    </a>
  </h1>

</section>

<!-- Main content -->
<section class="content">
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
                <th class="center">Jumlah Diajukan</th>
                
                <th class="center">Satuan</th>
                <th class="center">Proses</th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel barang
            if ($_SESSION['hak_akses']=='Super Admin') {
            $query = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_keluar,a.kode_barang,a.jumlah_keluar,a.created_user,a.status_terima,b.kode_barang,b.harga_jual,b.nama_barang,b.satuan
                                            FROM tb_keluar as a INNER JOIN tb_barang as b ON a.kode_barang=b.kode_barang ORDER BY kode_transaksi DESC")
                                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
            }
            else if ($_SESSION['hak_akses']=='Agen') {
              $query = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_keluar,a.kode_barang,a.jumlah_keluar,a.created_user,b.kode_barang,b.harga_jual,b.nama_barang,b.satuan
                                            FROM tb_pengajuan as a INNER JOIN tb_barang as b ON a.kode_barang=b.kode_barang ORDER BY kode_transaksi DESC")
                                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
            }
            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              $tanggal         = $data['tanggal_keluar'];
              $exp             = explode('-',$tanggal);
              $tanggal_keluar   = $exp[2]."-".$exp[1]."-".$exp[0];
			        $harga_jual = format_rupiah($data['harga_jual']);
              if ($_SESSION['hak_akses']=='Agen') {
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
                          <div>";

                          echo "<a data-toggle='tooltip' data-placement='top' title='Ajukan' class='btn btn-primary btn-sm' href='modules/barang-keluar/proses.php?act=ajukan&id=$data[kode_transaksi]'>
                                  <i style='color:#fff' class='glyphicon glyphicon-check'></i>
                              </a>"
                            ?>
                            <a data-toggle='tooltip' data-placement='top' title='Hapus' class='btn btn-primary btn-sm' href='modules/barang-keluar/proses.php?act=delete&id=<?php echo $data["kode_transaksi"];?>'>
                                  <i style='color:#fff' class='glyphicon glyphicon-minus-sign'></i>
                              </a>
                            </div>
                        </td>
                        </tr>
                        <?php ;
                  }
                }
                else{
                  echo "<tr>
                        <td width='30' class='center'>$no</td>
                        <td width='30' class='center'>$data[created_user]</td>
                        <td width='100' class='center'>$data[kode_transaksi]</td>
                        <td width='80' class='center'>$tanggal_keluar</td>
                        <td width='80' class='center'>$data[kode_barang]</td>
                        <td width='200'>$data[nama_barang]</td>
                        <td width='100' align='right'>Rp. $harga_jual</td>
                        <td width='100' align='right'>$data[jumlah_keluar]</td>
                        <td width='80' class='center'>$data[satuan]</td>
                        <td class='center' width='100'>
                        <div>";

                        if ($data['status_terima']=='terima') { ?>
                          <a data-toggle="tooltip" data-placement="top" title="Batalkan" style="margin-right:5px" class="btn btn-warning btn-sm" href="modules/barang-keluar/proses.php?act=decline&id=<?php echo $data['kode_transaksi'];?>">
                              <i style="color:#fff" class="glyphicon glyphicon-remove"></i>
                          </a>
                        <?php
                        } 
                        else { ?>
                          <a data-toggle="tooltip" data-placement="top" title="Setujui" style="margin-right:5px" class="btn btn-success btn-sm" href="modules/barang-keluar/proses.php?act=acc&id=<?php echo $data['kode_transaksi'];?>">
                              <i style="color:#fff" class="glyphicon glyphicon-check"></i>
                          </a>
                        <?php
                        }
                          ?>
                          <a data-toggle='tooltip' data-placement='top' title='Hapus' class='btn btn-primary btn-sm' href='modules/barang-keluar/proses.php?act=delete&id=<?php echo $data["kode_transaksi"];?>'>
                                <i style='color:#fff' class='glyphicon glyphicon-minus-sign'></i>
                            </a>
                          </div>
                      </td>
                      </tr>
                      <?php ;
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