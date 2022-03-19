<!DOCTYPE html>
<html lang="en">
    <?php require_once("header.php");
    require_once("connect.php");
    if (isset($_POST['simpan'])){
        $id_trans = $_POST['id_trans'];
        $nama_trans = $_POST['nama_trans'];
        $tgl_trans = $_POST['tgl_trans'];
        $harga = $_POST['harga'];
        $qty = $_POST['qty'];
        $id_bar = $_POST['id_bar'];
        $id_pel = $_POST['id_pel'];
        $diskon = $_POST['diskon'];

        $query = mysqli_query($mysqli,"INSERT INTO tb_transaksi(id_transaksi,nama_transaksi,tgl_transaksi,harga,qty,id_barang,diskon,id_pelanggan) 
        VALUES ('$id_trans','$nama_trans','$tgl_trans','$harga','$qty','$id_bar','$diskon','$id_pel')") or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));
        if ($query){
            header("location:index.php?alert=1");
        } 
        }?>
        <div id="layoutSidenav">
            <?php require_once("sidenav_bar.php");?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Input Data Transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Input Transaksi</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Masukkan data transaksi yang telah dilakukan oleh customer
                                </p>
                                <br>
                                <form method="POST" action="input_transaksi.php">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ID Transaksi</label>
                                        <br>
                                        <input type="number" class="form-control" name="id_trans" aria-describedby="emailHelp" placeholder="Masukkan ID" required>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">Nama Transaksi</label>
                                        <br>
                                        <input type="text" class="form-control" name="nama_trans" placeholder="Masukkan nama transaksi" required>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">Tanggal Transaksi</label>
                                        <br>
                                        <input type="date" class="form-control" name="tgl_trans" placeholder="Masukkan tanggal transaksi" required>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">Harga</label>
                                        <br>
                                        <input type="number" class="form-control" name="harga" placeholder="Masukkan harga barang" required>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">Jumlah</label>
                                        <br>
                                        <input type="number" class="form-control" name="qty" placeholder="Masukkan jumlah barang" required>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">ID Barang</label>
                                        <br>
                                        <select class="form-control form-control-sm" name="id_bar" required>
                                            <option value="" selected disabled>Pilih Barang</option>
                                            <?php
                                            $query_barang = mysqli_query($mysqli, "SELECT id_barang, nama_barang FROM tb_barang ORDER BY id_barang ASC")
                                                                                    or die('Ada kesalahan pada query tampil barang: '.mysqli_error($mysqli));
                                            while ($data_barang = mysqli_fetch_assoc($query_barang)) {
                                                echo"<option value='$data_barang[id_barang]'> $data_barang[id_barang] | $data_barang[nama_barang] </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">Diskon</label>
                                        <br>
                                        <select class="form-control form-control-sm" id="diskon" name="diskon" required >
                                            <option value="5">5%</option>
                                            <option value="0">0%</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">ID Pelanggan</label>
                                        <br>
                                        <select class="form-control form-control-sm" name="id_pel" required>
                                            <option value="" selected disabled>Pilih Pelanggan</option>
                                            <?php
                                            $query_pelanggan = mysqli_query($mysqli, "SELECT id_pelanggan, nama_pelanggan FROM tb_pelanggan ORDER BY id_pelanggan ASC")
                                                                                    or die('Ada kesalahan pada query tampil barang: '.mysqli_error($mysqli));
                                            while ($data_pelanggan= mysqli_fetch_assoc($query_pelanggan)) {
                                                echo"<option value='$data_pelanggan[id_pelanggan]'> $data_pelanggan[id_pelanggan] | $data_pelanggan[nama_pelanggan] </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <br>
                                    <button type="submit" name="simpan" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; CupCup Market 2022</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
