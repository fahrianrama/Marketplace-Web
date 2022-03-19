<!DOCTYPE html>
<html lang="en">
    <?php require_once("header.php");
    require_once("connect.php");
    if (isset($_POST['simpan'])){
        $id_bar = $_POST['id_bar'];
        $nama_bar = $_POST['nama_bar'];
        $id_kat = $_POST['id_kat'];
        $id_sat = $_POST['id_sat'];

        $query = mysqli_query($mysqli,"INSERT INTO tb_barang(id_barang,nama_barang,kategori_id,satuan_id) VALUES ('$id_bar','$nama_bar','$id_kat','$id_sat')") or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));
        if ($query){
            header("location:index.php?alert=1");
        } 
        }?>
        <div id="layoutSidenav">
            <?php require_once("sidenav_bar.php");?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Input Data Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Input Barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Masukkan data barang yang tersedia di toko
                                </p>
                                <br>
                                <form method="POST" action="input_barang.php">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ID Barang</label>
                                        <br>
                                        <input type="number" class="form-control" name="id_bar" aria-describedby="emailHelp" placeholder="Masukkan ID" required>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">Nama Barang</label>
                                        <br>
                                        <input type="text" class="form-control" name="nama_bar" placeholder="Masukkan Nama Barang" required>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">Kategori</label>
                                        <br>
                                        <select class="form-control form-control-sm" name="id_kat" required>
                                            <option value="" selected disabled>Pilih Kategori</option>
                                            <?php
                                            $query_kategori = mysqli_query($mysqli, "SELECT id_kategori, nama_kategori FROM tb_kategori ORDER BY id_kategori ASC")
                                                                                    or die('Ada kesalahan pada query tampil barang: '.mysqli_error($mysqli));
                                            while ($data_kategori = mysqli_fetch_assoc($query_kategori)) {
                                                echo"<option> $data_kategori[id_kategori] | $data_kategori[nama_kategori] </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">Satuan</label>
                                        <br>
                                        <select class="form-control form-control-sm" name="id_sat" required>
                                            <option value="" selected disabled>Pilih Satuan</option>
                                            <?php
                                            $query_satuan = mysqli_query($mysqli, "SELECT id_satuan, nama FROM tb_satuan ORDER BY id_satuan ASC")
                                                                                    or die('Ada kesalahan pada query tampil barang: '.mysqli_error($mysqli));
                                            while ($data_satuan = mysqli_fetch_assoc($query_satuan)) {
                                                echo"<option> $data_satuan[id_satuan] | $data_satuan[nama] </option>";
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
