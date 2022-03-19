<script type="text/javascript">
  function tampil_barang(input){
    var num = input.value;

    $.post("modules/barang-keluar/barang.php", {
      dataidbarang: num,
    }, function(response) {      
      $('#stok').html(response)

      document.getElementById('jumlah_keluar').focus();
    });
  }
  function tampil_barang2(input){
    var num = input.value;

    $.post("modules/barang-keluar/barang.php", {
      dataidbarang: num,
    }, function(response) {      
      $('#stok2').html(response)

      document.getElementById('jumlah_keluar2').focus();
    });
  }
  function tampil_barang3(input){
    var num = input.value;

    $.post("modules/barang-keluar/barang.php", {
      dataidbarang: num,
    }, function(response) {      
      $('#stok3').html(response)

      document.getElementById('jumlah_keluar3').focus();
    });
  }

  function hitung_total_keluar() {
    jml = document.formBarangKeluar.jumlah_keluar.value;
    jml2 = document.formBarangKeluar.jumlah_keluar2.value;
    jml3 = document.formBarangKeluar.jumlah_keluar3.value;

    if (jml == "") {
      var hasil = "";
    }
    else {
      if (jml2 == ""){
        var hasil = eval(jml);
      }
      else{
        if (jml3 == ""){
          var hasil = eval(jml)+eval(jml2);
        }
        else{
          var hasil = eval(jml) + eval(jml2) + eval(jml3);
        }
      }
    }

    document.formBarangKeluar.total_keluar.value = (hasil);
  }
</script>

<?php  
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form']=='add') { ?> 
  <!-- tampilan form add data -->
	<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Input Data Barang Keluar
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=barang-keluar"> Barang Keluar </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/barang-keluar/proses.php?act=insert" method="POST" name="formBarangKeluar">
            <div class="box-body">
              <?php  
              // fungsi untuk membuat kode transaksi
              $query_id = mysqli_query($mysqli, "SELECT RIGHT(kode_transaksi,7) as kode FROM tb_keluar
                                                ORDER BY kode_transaksi DESC LIMIT 1")
                                                or die('Ada kesalahan pada query tampil kode_transaksi : '.mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);

              if ($count <> 0) {
                  // mengambil data kode transaksi
                  $data_id = mysqli_fetch_assoc($query_id);
                  $kode    = $data_id['kode']+1;
              } else {
                  $kode = 1;
              }

              // buat kode_transaksi
              $tahun          = date("Y");
              $buat_id        = str_pad($kode, 7, "0", STR_PAD_LEFT);
              $kode_transaksi = "BK-$tahun-$buat_id";
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="kode_transaksi" value="<?php echo $kode_transaksi; ?>" readonly required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_keluar" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
                </div>
              </div>
              <hr>

              <div class="form-group">
                <label class="col-sm-2 control-label">Barang 1</label>
               <div class="col-sm-5">
                  <select class="chosen-select" name="kode_barang" data-placeholder="-- Pilih Barang --" onchange="tampil_barang(this)" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                      $query_barang = mysqli_query($mysqli, "SELECT kode_barang, nama_barang FROM tb_barang ORDER BY nama_barang ASC")
                                                            or die('Ada kesalahan pada query tampil barang: '.mysqli_error($mysqli));
                      while ($data_barang = mysqli_fetch_assoc($query_barang)) {
                        echo"<option value=\"$data_barang[kode_barang]\"> $data_barang[kode_barang] | $data_barang[nama_barang] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              
              <span id='stok'>
              <div class="form-group">
                <label class="col-sm-2 control-label">Stok</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="stok" name="stok" readonly required>
                </div>
              </div>
              </span>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah Barang 1</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="jumlah_keluar" name="jumlah_keluar" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="hitung_total_keluar(this)" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Barang 2</label>
               <div class="col-sm-5">
                  <select class="chosen-select" name="kode_barang2" data-placeholder="-- Pilih Barang --" onchange="tampil_barang2(this)" autocomplete="off" >
                    <option value=""></option>
                    <?php
                      $query_barang = mysqli_query($mysqli, "SELECT kode_barang, nama_barang FROM tb_barang ORDER BY nama_barang ASC")
                                                            or die('Ada kesalahan pada query tampil barang: '.mysqli_error($mysqli));
                      while ($data_barang = mysqli_fetch_assoc($query_barang)) {
                        echo"<option value=\"$data_barang[kode_barang]\"> $data_barang[kode_barang] | $data_barang[nama_barang] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              
              <span id='stok2'>
              <div class="form-group">
                <label class="col-sm-2 control-label">Stok</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="stok2" name="stok2" readonly>
                </div>
              </div>
              </span>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah Barang 2</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="jumlah_keluar2" name="jumlah_keluar2" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="hitung_total_keluar(this)">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Barang 3</label>
               <div class="col-sm-5">
                  <select class="chosen-select" name="kode_barang3" data-placeholder="-- Pilih Barang --" onchange="tampil_barang3(this)" autocomplete="off">
                    <option value=""></option>
                    <?php
                      $query_barang = mysqli_query($mysqli, "SELECT kode_barang, nama_barang FROM tb_barang ORDER BY nama_barang ASC")
                                                            or die('Ada kesalahan pada query tampil barang: '.mysqli_error($mysqli));
                      while ($data_barang = mysqli_fetch_assoc($query_barang)) {
                        echo"<option value=\"$data_barang[kode_barang]\"> $data_barang[kode_barang] | $data_barang[nama_barang] </option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              
              <span id='stok3'>
              <div class="form-group">
                <label class="col-sm-2 control-label">Stok</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="stok3" name="stok3" readonly>
                </div>
              </div>
              </span>

              <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah Barang 3</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="jumlah_keluar3" name="jumlah_keluar3" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" onkeyup="hitung_total_keluar(this)">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Total Keluar</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="total_keluar" name="total_keluar" readonly>
                </div>
              </div>

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=barang-keluar" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div><!--/.col -->
    </div>   <!-- /.row -->
  </section><!-- /.content -->
<?php
}
?>