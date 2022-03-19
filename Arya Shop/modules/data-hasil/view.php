
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
              Data Hasil berhasil dihapus.
            </div>";
    }
    ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-folder-o icon-title"></i> Data Hasil

    <a class="btn btn-primary btn-social pull-right" href="?module=form_barang&form=add" title="Tambah Data" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Tambah
    </a>
  </h1>

</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel barang -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Tanggal Awal</th>
                <th class="center">Tanggal Akhir</th>
                <th class="center">Min. Support</th>
                <th class="center">Min. Confidence</th>
                <th class="center">Action</th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel barang
            $query = mysqli_query($mysqli, "SELECT * FROM tb_hasil")
                                            or die('Ada kesalahan pada query tampil Data barang: '.mysqli_error($mysqli));

            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              // menampilkan isi tabel dari database ke tabel di aplikasi
              echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='180' class='center'>$data[tanggal_awal]</td>
                      <td width='180' class='center'>$data[tanggal_akhir]</td>
					            <td width='100' class='center'>$data[min_support]%</td>
                      <td width='100' class='center'>$data[min_confidence]%</td>"?>
                      <form role="form" action="http://localhost/Arya%20Shop/main.php?module=data_show" method="POST" name="formproses">
                        <input type="hidden" class="form-control" id="tanggal_awal" name="tanggal_awal" value="<?php echo $data['tanggal_awal'];?>">
                        <input type="hidden" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?php echo $data['tanggal_akhir'];?>">
                        <input type="hidden" class="form-control" id="min_support" name="min_support" value="<?php echo $data['min_support'];?>">
                        <input type="hidden" class="form-control" id="min_confidence" name="min_confidence" value="<?php echo $data['min_confidence'];?>">
                      <td class='center' width='80'>
                        <div>
                          <input type="submit" data-toggle='tooltip' data-placement='top' title='Tampil' style='margin-right:5px' class='btn btn-primary btn-sm' value="Show">
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>
                      </form>
                          <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="modules/data-hasil/proses.php?act=delete&id=<?php echo $data['min_confidence'];?>" onclick="return confirm('Anda yakin ingin menghapus hasil <?php echo $data['tanggal_awal']; ?> ?');">
                              <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                          </a>
            <?php
              echo "    </div>
                      </td>
                    </tr>";
              $no++;
            }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content