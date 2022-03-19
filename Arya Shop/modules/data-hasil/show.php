
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-refresh icon-title"></i> Data Proses
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
              Data Hasil berhasil disimpan.
            </div>";
    }

            // fungsi untuk pengecekan status login user 
            // jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
            if (empty($_SESSION['username']) && empty($_SESSION['password'])){
                echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
            }
            // jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
            else {
                        $tanggal_awal         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_awal']));
                        $tanggal_akhir        = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_akhir']));
                        $minsupport      = $_POST['min_support'];
                        $minconfidence   = $_POST['min_confidence'];
                        $totaltransaksi = 0;
                        $created_user    = $_SESSION['id_user'];
                        $totalflow = mysqli_query($mysqli, "SELECT * FROM tb_keluar")
                        or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                        while ($querykeluar = mysqli_fetch_assoc($totalflow)) {
                          $barangkeluar = $querykeluar['jumlah_keluar'];
                          $totaltransaksi += $barangkeluar;
                        }
                        // fungsi query untuk menampilkan data dari tabel barang
                        $flowdata = mysqli_query($mysqli, "SELECT DISTINCT kode_barang FROM tb_keluar WHERE (tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir')")
                                                        or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                        
                        $jumlahmb = 0;
                        $jumlahbu = 0;
                        $totalproses = 0;
                        $totalproses2 = 0;
                        $totalproses3 = 0;
                        $tempbarang = "";
                        $namaproduk = "";
                        $flowproses = mysqli_query($mysqli, "SELECT DISTINCT kode_transaksi FROM tb_keluar WHERE tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'")
                        or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                        while ($queryproses = mysqli_fetch_assoc($flowproses)) {
                          $totalproses += 1;
                        }
                        $flowproses2 = mysqli_query($mysqli, "SELECT kode_transaksi, COUNT(kode_transaksi) FROM tb_keluar WHERE tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY kode_transaksi HAVING COUNT(kode_transaksi)>1 AND COUNT(kode_transaksi)<3")
                        or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                        while ($queryproses2 = mysqli_fetch_assoc($flowproses2)) {
                          $totalproses2 += 1;
                        }
                        $flowproses3 = mysqli_query($mysqli, "SELECT kode_transaksi, COUNT(kode_transaksi) FROM tb_keluar WHERE tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY kode_transaksi HAVING COUNT(kode_transaksi)>2")
                        or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                        while ($queryproses3 = mysqli_fetch_assoc($flowproses3)) {
                          $totalproses3 += 1;
                        }
                        
                        ?>
                        <div class="panel panel-primary">
                        <table class="table table-hover">
                          <h3 class="center">Data Proses</h3>
                          <tr>
                            <td width = "600" class="center">
                              <b>Min Support Absolut</b>
                            </td>
                            <td>
                              <?php echo $minsupport;?>%
                            </td>
                          </tr>
                          <tr>
                            <td class="center">
                              <b>Min Confidence</b>
                            </td>
                            <td>
                            <?php echo $minconfidence;?>%
                            </td>
                          </tr>
                          <tr>
                            <td class="center">
                              <b>Date</b>
                            <td>
                            <?php echo $tanggal_awal;?> - <?php echo $tanggal_akhir;?>
                            </td>
                          </tr>
                          <tr>
                            <td class="center">
                              <?php echo "";?>
                            </td>
                            <td>
                            </td>
                          </tr>
                        </table>
                        </div>
                        <div class="panel panel-primary">
                        <table class="table table-hover">
                          <h3 class="center">Total Data Transaksi</h3>
                        <?php
                        while ($data = mysqli_fetch_assoc($flowdata)) {
                          $transaksibarang = 0;
                          $jumlahbar = 0;
                          $kodebarang = $data['kode_barang'];
                            $hitungbar = mysqli_query($mysqli, "SELECT * FROM tb_keluar WHERE kode_barang = '$kodebarang' AND tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                            while ($data1 = mysqli_fetch_assoc($hitungbar)) {
                              $total         = $data1['jumlah_keluar'];
                              $jumlahbar += $total;
                              $transaksibarang ++;
                            }
                            $namabarang = mysqli_query($mysqli, "SELECT * FROM tb_barang WHERE kode_barang = '$kodebarang'")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                            while ($nambar = mysqli_fetch_assoc($namabarang)) {
                              $namaproduk         = $nambar['nama_barang'];
                            }
                            if($jumlahbar>0)
                            {
                              $totalbarang = $jumlahbar/$totaltransaksi*100;
                            ?>
                            <tr class="center">
                              <td width="300">
                              <b><?php echo $namaproduk;?></b>
                              </td>
                              <td class="center">
                              <?php echo number_format($totalbarang,2,",",".");?>% dari Total Barang
                                </td>
                              <td class="center">
                              (<?php echo number_format($transaksibarang);?>) Transaksi
                              </td>
                              </tr>
                              
                            <?php
                            $tempbarang = $kodebarang;
                            }
                          }
                        ?>
                        <tr>
                        <td>
                        </td>
                        </tr>
                        </table>
                        </div>
                        <div class="panel panel-primary">
                        <table class="table table-hover">
                          <h3 class="center">Itemset 1</h3>
                          <thead>
                            <tr>
                              <th class="center">No.</th>
                              <th class="center">Item</th>
                              <th class="center">Jumlah</th>
                              <th class="center">Support</th>
                              <th class="center">Keterangan</th>
                            </tr>
                          </thead>
                        <?php
                        $deletetable = mysqli_query($mysqli, "TRUNCATE TABLE tb_itemset");
                        $nomor = 1;
                        $flowdata = mysqli_query($mysqli, "SELECT DISTINCT kode_barang FROM tb_keluar WHERE tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'")
                        or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                        while ($data = mysqli_fetch_assoc($flowdata)) {
                          $jumlahmk = 0;
                          $kodebarang = $data['kode_barang'];
                            $hitungbar = mysqli_query($mysqli, "SELECT * FROM tb_keluar WHERE kode_barang = '$kodebarang' AND tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                            while ($data1 = mysqli_fetch_assoc($hitungbar)) {
                              $jumlahmk++;
                            }
                            $namabarang = mysqli_query($mysqli, "SELECT * FROM tb_barang WHERE kode_barang = '$kodebarang'")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                            while ($nambar = mysqli_fetch_assoc($namabarang)) {
                              $namaproduk         = $nambar['nama_barang'];
                            }
                            
                            if($jumlahmk>0)
                            {
                              $support = $jumlahmk/$totalproses*100;
                              $queryset1 = mysqli_query($mysqli,"INSERT INTO tb_itemset(item,jumlah,support) VALUES('$namaproduk','$jumlahmk','$support')");
                            ?>
                            <tr class="center">
                              <td>
                                <?php echo $nomor;?>
                              </td>
                              <td>
                              <?php echo $namaproduk;?>
                              </td>
                              <td>
                                <?php echo $jumlahmk?>
                              </td>
                              <td class="center">
                              <?php echo number_format($support,2,",",".");?>%
                              </td>
                              <td>
                                <?php if ($support>$minsupport){
                                  ?><button type="button" class="btn btn-success">Lolos</button><?php
                                }
                                  else {
                                  ?><button type="button" class="btn btn-danger">Tidak Lolos</button> <?php
                                }
                                ?>
                              </td>
                            </tr>
                            <?php
                            $nomor++;
                            $tempbarang = $kodebarang;
                            }
                          }
                        ?>
                        <tr>
                          <td>
                          </td>
                        </tr>
                        </table>
                        </div>
                        <div class="panel panel-primary">
                        <table class="table table-hover">
                          <h3 class="center">Itemset 1 yang Lolos</h3>
                          <thead>
                            <tr>
                              <th class="center">No.</th>
                              <th class="center">Item</th>
                              <th class="center">Jumlah</th>
                              <th class="center">Support</th>
                            </tr>
                          </thead>
                        <?php
                        $nomor = 1;
                        $flowdata = mysqli_query($mysqli, "SELECT DISTINCT kode_barang FROM tb_keluar WHERE (tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir')")
                        or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                        while ($data = mysqli_fetch_assoc($flowdata)) {
                          $jumlahmk = 0;
                          $kodebarang = $data['kode_barang'];
                            $hitungbar = mysqli_query($mysqli, "SELECT * FROM tb_keluar WHERE kode_barang = '$kodebarang' AND (tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir')")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                            while ($data1 = mysqli_fetch_assoc($hitungbar)) {
                              $jumlahmk++;
                            }
                            $namabarang = mysqli_query($mysqli, "SELECT * FROM tb_barang WHERE kode_barang = '$kodebarang'")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                            while ($nambar = mysqli_fetch_assoc($namabarang)) {
                              $namaproduk         = $nambar['nama_barang'];
                            }
                            if($jumlahmk>0)
                            {
                              $support = $jumlahmk/$totalproses*100;
                              if($support>$minsupport)
                              {
                            ?>
                            <tr class="center">
                              <td>
                                <?php echo $nomor;?>
                              </td>
                              <td width='300'>
                              <?php echo $namaproduk;?>
                              </td>
                              <td>
                                <?php echo $jumlahmk?>
                              </td>
                              <td class="center">
                              <?php echo number_format($support,2,",",".");?>%
                              </td>
                            </tr>
                            <?php
                              }
                            $nomor++;
                            $tempbarang = $kodebarang;
                              }
                            }
                          ?><td></td><?php
                          ?>
                        </table>
                        </div>
                        <div class="panel panel-primary">
                        <table class="table table-hover">
                          <h3 class="center">Itemset 2</h3>
                          <thead>
                            <tr>
                              <th class="center">No.</th>
                              <th class="center">Item 1</th>
                              <th class="center">Item 2</th>
                              <th class="center">Jumlah</th>
                              <th class="center">Support</th>
                              <th class="center">Keterangan</th>
                            </tr>
                          </thead>
                        <?php
                        $temptransaksi = 0;
                        $nomor = 1;
                        $tempitem1 = null;
                        $tempitem2 = null;
                        $deletetable = mysqli_query($mysqli, "TRUNCATE TABLE tb_itemset2");
                        $flowdata = mysqli_query($mysqli, "SELECT kode_transaksi, COUNT(kode_transaksi) FROM tb_keluar WHERE tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY kode_transaksi HAVING COUNT(kode_transaksi)>1 AND COUNT(kode_transaksi)<3 ORDER BY kode_barang ASC")
                        or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                        while ($data = mysqli_fetch_assoc($flowdata)) {
                          $kodebarang = "";
                          $kodebarang2 = "";
                          $jumlah2set = 0;
                          $kodetransaksi = $data['kode_transaksi'];
                          $hitungbar = mysqli_query($mysqli, "SELECT * FROM tb_keluar WHERE kode_transaksi = '$kodetransaksi' AND tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'")
                          or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                          while ($data1 = mysqli_fetch_assoc($hitungbar)) {
                            if ($kodebarang == "")
                            {
                              $kodebarang = $data1['kode_barang'];
                            }
                            else{
                              $kodebarang2 = $data1['kode_barang'];
                            }
                          }
                            $jumlah2set ++;
                            
                            if ($jumlah2set>0)
                            {
                              $support = $jumlah2set/$totalproses2*100;
                            }
                            else{
                              $support = 0;
                            }
                            $tempitem1 = $kodebarang;
                            $tempitem2 = $kodebarang2;
                            $namabarang = mysqli_query($mysqli, "SELECT * FROM tb_barang WHERE kode_barang = '$tempitem1'")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                            while ($nambar = mysqli_fetch_assoc($namabarang)) {
                              $namaproduk         = $nambar['nama_barang'];
                            }
                            $namabarang2 = mysqli_query($mysqli, "SELECT * FROM tb_barang WHERE kode_barang = '$tempitem2'")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                            while ($nambar = mysqli_fetch_assoc($namabarang2)) {
                              $namaproduk2        = $nambar['nama_barang'];
                            }
                            $available = "n";

                            $querycek = mysqli_query($mysqli, "SELECT * FROM tb_itemset2 WHERE item1 = '$namaproduk' AND item2 = '$namaproduk2'");
                            while ($checker = mysqli_fetch_assoc($querycek)) {
                              $available = "y";
                            }
                            if ($available == "y"){
                              $queryubah = mysqli_query($mysqli, "SELECT * FROM tb_itemset2 WHERE item1 = '$namaproduk' AND item2 = '$namaproduk2'");
                              $cekjumlah = mysqli_fetch_assoc($queryubah);
                              $jumlahawal = $cekjumlah['jumlah'];
                              $jumlahakhir = $jumlahawal+1;
                              $supportawal = $cekjumlah['support'];
                              $supportakhir = $supportawal+$support;
                              $queryset = mysqli_query($mysqli, "UPDATE tb_itemset2 SET jumlah='$jumlahakhir',support = '$supportakhir' WHERE item1 = '$namaproduk' AND item2 = '$namaproduk2'");
                            }
                            else{
                              $querysimpan = mysqli_query($mysqli, "INSERT INTO tb_itemset2(item1,item2,jumlah,support) 
                                            VALUES('$namaproduk','$namaproduk2','$jumlah2set','$support')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli)); 
                            }
                          }
                            $queryprint = mysqli_query($mysqli,"SELECT * FROM tb_itemset2");
                            while ($printer = mysqli_fetch_assoc($queryprint)){
                              $item1 = $printer['item1'];
                              $item2 = $printer['item2'];
                              $jumlah = $printer['jumlah'];
                              $supportprint = $printer['support'];
                            ?>
                            <tr class="center">
                              <td>
                                <?php echo $nomor;?>
                              </td>
                              <td>
                              <?php echo $item1;?>
                              </td>
                              <td>
                              <?php echo $item2;?>
                              </td>
                              <td>
                                <?php echo $jumlah?>
                              </td>
                              <td class="center">
                              <?php echo number_format($supportprint,2,",",".");?>%
                              </td>
                              <td>
                                <?php if ($supportprint>$minsupport){
                                  ?><button type="button" class="btn btn-success">Lolos</button><?php
                                }
                                  else {
                                  ?><button type="button" class="btn btn-danger">Tidak Lolos</button> <?php
                                }
                                ?>
                              </td>
                            </tr>
                            <?php
                            $nomor++;
                        }
                        ?>
                        <td>

                        </td>
                        </table>
                        </div>
                        <div class="panel panel-primary">
                        <table class="table table-hover">
                          <h3 class="center">Itemset 2 yang Lolos</h3>
                          <thead>
                            <tr>
                              <th class="center">No.</th>
                              <th class="center">Item 1</th>
                              <th class="center">Item 2</th>
                              <th class="center">Jumlah</th>
                              <th class="center">Support</th>
                            </tr>
                          </thead>
                          <?php
                          $nomor = 1;
                          $queryprint = mysqli_query($mysqli,"SELECT * FROM tb_itemset2");
                            while ($printer = mysqli_fetch_assoc($queryprint)){
                              $item1 = $printer['item1'];
                              $item2 = $printer['item2'];
                              $jumlah = $printer['jumlah'];
                              $supportprint = $printer['support'];
                              if ($supportprint>$minsupport)
                              {
                            ?>
                            <tr class="center">
                              <td>
                                <?php echo $nomor;?>
                              </td>
                              <td >
                              <?php echo $item1;?>
                              </td>
                              <td>
                              <?php echo $item2;?>
                              </td>
                              <td>
                                <?php echo $jumlah?>
                              </td>
                              <td class="center">
                              <?php echo number_format($supportprint,2,",",".");?>%
                              </td>
                            </tr>
                            <?php
                            $nomor++; 
                              }
                            }
                            ?>
                            <td>
                          
                          </td>
                        </table>
                        </div>
                        <div class="panel panel-primary">
                        <table class="table table-hover">
                          <h3 class="center">Itemset 3</h3>
                          <thead>
                            <tr>
                              <th class="center">No.</th>
                              <th class="center">Item 1</th>
                              <th class="center">Item 2</th>
                              <th class="center">Item 3</th>
                              <th class="center">Jumlah</th>
                              <th class="center">Support</th>
                              <th class="center">Keterangan</th>
                            </tr>
                          </thead>
                        <?php
                        $nomor = 1;
                        $deletetable = mysqli_query($mysqli, "TRUNCATE TABLE tb_itemset3");
                        $flowdata = mysqli_query($mysqli, "SELECT kode_transaksi, COUNT(kode_transaksi) FROM tb_keluar WHERE tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir' GROUP BY kode_transaksi HAVING COUNT(kode_transaksi)>2 ORDER BY kode_barang ASC")
                        or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                        while ($data = mysqli_fetch_assoc($flowdata)) {
                          $kodebarang = "";
                          $kodebarang2 = "";
                          $kodebarang3 = "";
                          $jumlah3set = 0;
                          $kodetransaksi = $data['kode_transaksi'];
                          $hitungbar = mysqli_query($mysqli, "SELECT * FROM tb_keluar WHERE kode_transaksi = '$kodetransaksi' AND tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'")
                          or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                          while ($data1 = mysqli_fetch_assoc($hitungbar)) {
                            if ($kodebarang == "")
                            {
                              $kodebarang = $data1['kode_barang'];
                            }
                            else if ($kodebarang!="") {
                              if ($kodebarang2 == ""){
                                $kodebarang2 = $data1['kode_barang'];
                              }
                            }
                            if ($kodebarang2!=""){
                              $kodebarang3 = $data1['kode_barang'];
                            }
                          }
                            $jumlah3set ++;
                            
                            if ($jumlah3set>0)
                            {
                              $support = $jumlah3set/$totalproses3*100;
                            }
                            else{
                              $support = 0;
                            }
                            $namabarang = mysqli_query($mysqli, "SELECT * FROM tb_barang WHERE kode_barang = '$kodebarang'")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                            while ($nambar = mysqli_fetch_assoc($namabarang)) {
                              $namaproduk         = $nambar['nama_barang'];
                            }
                            $namabarang2 = mysqli_query($mysqli, "SELECT * FROM tb_barang WHERE kode_barang = '$kodebarang2'")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                            while ($nambar = mysqli_fetch_assoc($namabarang2)) {
                              $namaproduk2        = $nambar['nama_barang'];
                            }
                            $namabarang3 = mysqli_query($mysqli, "SELECT * FROM tb_barang WHERE kode_barang = '$kodebarang3'")
                            or die('Ada kesalahan pada query tampil Data Barang Masuk: '.mysqli_error($mysqli));
                            while ($nambar = mysqli_fetch_assoc($namabarang3)) {
                              $namaproduk3        = $nambar['nama_barang'];
                            }
                            $available = "n";

                            $querycek = mysqli_query($mysqli, "SELECT * FROM tb_itemset3 WHERE item1 = '$namaproduk' AND item2 = '$namaproduk2' AND item3 = '$namaproduk3'");
                            while ($checker = mysqli_fetch_assoc($querycek)) {
                              $available = "y";
                            }
                            if ($available == "y"){
                              $queryubah = mysqli_query($mysqli, "SELECT * FROM tb_itemset3 WHERE item1 = '$namaproduk' AND item2 = '$namaproduk2' AND item3 = '$namaproduk3'");
                              $cekjumlah = mysqli_fetch_assoc($queryubah);
                              $jumlahawal = $cekjumlah['jumlah'];
                              $jumlahakhir = $jumlahawal+1;
                              $supportawal = $cekjumlah['support'];
                              $supportakhir = $supportawal+$support;
                              $queryset = mysqli_query($mysqli, "UPDATE tb_itemset3 SET jumlah='$jumlahakhir',support = '$supportakhir' WHERE item1 = '$namaproduk' AND item2 = '$namaproduk2' AND item3 = '$namaproduk3'");
                            }
                            else{
                              $querysimpan = mysqli_query($mysqli, "INSERT INTO tb_itemset3(item1,item2,item3,jumlah,support) 
                                            VALUES('$namaproduk','$namaproduk2', '$namaproduk3' ,'$jumlah2set','$support')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli)); 
                            }
                          }
                            $queryprint = mysqli_query($mysqli,"SELECT * FROM tb_itemset3");
                            while ($printer = mysqli_fetch_assoc($queryprint)){
                              $item1 = $printer['item1'];
                              $item2 = $printer['item2'];
                              $item3 = $printer['item3'];
                              $jumlah = $printer['jumlah'];
                              $supportprint = $printer['support'];
                            ?>
                            <tr class="center">
                              <td>
                                <?php echo $nomor;?>
                              </td>
                              <td>
                              <?php echo $item1;?>
                              </td>
                              <td>
                              <?php echo $item2;?>
                              </td>
                              <td>
                              <?php echo $item3;?>
                              </td>
                              <td>
                                <?php echo $jumlah?>
                              </td>
                              <td class="center">
                              <?php echo number_format($supportprint,2,",",".");?>%
                              </td>
                              <td>
                                <?php if ($supportprint>$minsupport){
                                  ?><button type="button" class="btn btn-success">Lolos</button><?php
                                }
                                  else {
                                  ?><button type="button" class="btn btn-danger">Tidak Lolos</button> <?php
                                }
                                ?>
                              </td>
                            </tr>
                            <?php
                            $nomor++;
                        }
                        ?>
                        <td>
                          
                          </td>
                        </table>
                        </div>
                        <div class="panel panel-primary">
                        <table class="table table-hover">
                          <h3 class="center">Itemset 3 yang Lolos</h3>
                          <thead>
                            <tr>
                              <th class="center">No.</th>
                              <th class="center">Item 1</th>
                              <th class="center">Item 2</th>
                              <th class="center">Item 3</th>
                              <th class="center">Jumlah</th>
                              <th class="center">Support</th>
                            </tr>
                          </thead>
                          <?php
                          $nomor = 1;
                          $queryprint = mysqli_query($mysqli,"SELECT * FROM tb_itemset3");
                            while ($printer = mysqli_fetch_assoc($queryprint)){
                              $item1 = $printer['item1'];
                              $item2 = $printer['item2'];
                              $item3 = $printer['item3'];
                              $jumlah = $printer['jumlah'];
                              $supportprint = $printer['support'];
                              if ($supportprint>$minsupport)
                              {
                            ?>
                            <tr class="center">
                              <td>
                                <?php echo $nomor;?>
                              </td>
                              <td >
                              <?php echo $item1;?>
                              </td>
                              <td>
                              <?php echo $item2;?>
                              </td>
                              <td>
                              <?php echo $item3;?>
                              </td>
                              <td>
                                <?php echo $jumlah?>
                              </td>
                              <td class="center">
                              <?php echo number_format($supportprint,2,",",".");?>%
                              </td>
                            </tr>
                            <?php
                            $nomor++; 
                              }
                            }
                            ?>
                            <td>
                          
                          </td>
                        </table>
                        </div>
                        <div class="panel panel-primary">
                        <table class="table table-hover">
                          <h3 class="center">Confidence Itemset 3</h3>
                          <thead>
                            <tr>
                              <th class="center">No.</th>
                              <th class="center">X => Y</th>
                              <th class="center">Support X U Y</th>
                              <th class="center">Support X</th>
                              <th class="center">Confidence</th>
                              <th class="center">Keterangan</th>
                            </tr>
                          </thead>
                          <?php
                          $nomor = 1;
                          $queryprint = mysqli_query($mysqli,"SELECT * FROM tb_itemset3");
                            while ($verif = mysqli_fetch_assoc($queryprint)){
                              $item1 = $verif['item1'];
                              $item2 = $verif['item2'];
                              $item3 = $verif['item3'];
                              $support2set = 0;
                              $confidece = 0;
                              $supportprint = $verif['support'];
                              $available = "n";
                              $queryset2 = mysqli_query($mysqli,"SELECT * FROM tb_itemset2 WHERE item1 = '$item1' AND item2 = '$item2'");
                              while ($verif2 = mysqli_fetch_assoc($queryset2)){
                                $available = "y";
                                $support2set = $verif2['support'];
                              }
                              if ($support2set>0){
                                $confidece = $supportprint/$support2set*100;
                              }
                              
                            ?>
                            <tr class="center">
                              <td>
                                <?php echo $nomor;?>
                              </td>
                              <td >
                              <?php echo $item1,',',$item2,' => ',$item3;?>
                              </td>
                              <td>
                              <?php echo number_format($supportprint,2,",",".");?>%
                              </td>
                              <td>
                              <?php echo number_format($support2set,2,",",".");?>%
                              </td>
                              <td>
                                <?php echo number_format($confidece,2,",",".");?>%
                              </td>
                              <td>
                                <?php if ($confidece>$minconfidence){
                                  ?><button type="button" class="btn btn-success">Lolos</button><?php
                                }
                                  else {
                                  ?><button type="button" class="btn btn-danger">Tidak Lolos</button> <?php
                                }
                                ?>
                              </td>
                            </tr>
                            <?php
                            $nomor++; 
                            }
                            ?>
                            <td>
                           
                          </td>
                        </table>
                        </div>

                        <div class="panel panel-primary">
                        <table class="table table-hover">
                          <h3 class="center">Confidence Itemset 2</h3>
                          <thead>
                            <tr>
                              <th class="center">No.</th>
                              <th class="center">X => Y</th>
                              <th class="center">Support X U Y</th>
                              <th class="center">Support X</th>
                              <th class="center">Confidence</th>
                              <th class="center">Keterangan</th>
                            </tr>
                          </thead>
                          <?php
                          $nomor = 1;
                          $queryprint = mysqli_query($mysqli,"SELECT * FROM tb_itemset2");
                            while ($verif = mysqli_fetch_assoc($queryprint)){
                              $item1 = $verif['item1'];
                              $item2 = $verif['item2'];
                              $support1set = 0;
                              $confidece = 0;
                              $supportprint = $verif['support'];
                              $available = "n";
                              $querycek2 = mysqli_query($mysqli,"SELECT * FROM tb_itemset WHERE item = '$item1'");
                              while ($verif3 = mysqli_fetch_assoc($querycek2)){
                                $available = "y";
                                $support1set = $verif3['support'];
                              }
                              if ($support1set>0){
                                $confidece = $supportprint/$support1set*100;
                              }
                              
                            ?>
                            <tr class="center">
                              <td>
                                <?php echo $nomor;?>
                              </td>
                              <td >
                              <?php echo $item1,' => ',$item2;?>
                              </td>
                              <td>
                              <?php echo number_format($supportprint,2,",",".");?>%
                              </td>
                              <td>
                              <?php echo number_format($support1set,2,",",".");?>%
                              </td>
                              <td>
                                <?php echo number_format($confidece,2,",",".");?>%
                              </td>
                              <td>
                                <?php if ($confidece>$minconfidence){
                                  ?><button type="button" class="btn btn-success">Lolos</button><?php
                                }
                                  else {
                                  ?><button type="button" class="btn btn-danger">Tidak Lolos</button> <?php
                                }
                                ?>
                              </td>
                            </tr>
                            <?php
                            $nomor++; 
                            }
                            ?>
                            <td>
                           
                          </td>
                        </table>
                        </div>
                        
                      <div class="panel panel-primary">
                      <table class="table table-hover">
                        <h3 class="center">Simpan Data</h3>
                        <thead>
                          <tr>
                            <th class="center">
                            <form role="form" action="modules/data-proses/proses.php?act=insert" method="POST" name="formsimpan">
                              <input type="hidden" class="form-control" id="tanggal2" name="tanggal2" value="<?php echo $tanggal_akhir;?>">
                              <input type="hidden" class="form-control" id="tanggal1" name="tanggal1" value="<?php echo $tanggal_awal;?>">
                              <input type="hidden" class="form-control" id="supportmin" name="supportmin" value="<?php echo $minsupport;?>">
                              <input type="hidden" class="form-control" id="confmin" name="confmin" value="<?php echo $minconfidence;?>">
                              <input type="submit" class="btn btn-success" name="simpan" value="Simpan">
                            </form>
                            </th>
                          </tr>
                        </thead>
                      </table>
                      <?php
                      //proses batas
                        }
                        ?>
                        <tr>
                          <td>
                          </td>
                        </tr>
                        </table>
                        </div>
                    </tbody>
                  </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content