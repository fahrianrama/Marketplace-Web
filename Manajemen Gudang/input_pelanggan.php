<!DOCTYPE html>
<html lang="en">
    <?php require_once("header.php");
    require_once("connect.php");
    if (isset($_POST['simpan'])){
        $id_pel = $_POST['id_pel'];
        $nama_pel = $_POST['nama_pel'];
        $no_tel = $_POST['no_tel'];
        $status = $_POST['status'];

        $query = mysqli_query($mysqli,"INSERT INTO tb_pelanggan(id_pelanggan,nama_pelanggan,no_tlp,status) VALUES ('$id_pel','$nama_pel','$no_tel','$status')") or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));
        if ($query){
            header("location:index.php?alert=1");
        } 
        }?>
        <div id="layoutSidenav">
            <?php require_once("sidenav_bar.php");?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Input Data Pelanggan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Input Pelanggan</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    Masukkan data pelanggan yang akan didaftarkan pada sistem
                                </p>
                                <br>
                                <form method="POST" action="input_pelanggan.php">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">ID Pelanggan</label>
                                        <br>
                                        <input type="number" class="form-control" name="id_pel" aria-describedby="emailHelp" placeholder="Masukkan ID" required>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">Nama Pelanggan</label>
                                        <br>
                                        <input type="text" class="form-control" name="nama_pel" placeholder="Masukkan nama pelanggan" required>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">Nomor Telepon</label>
                                        <br>
                                        <input type="text" class="form-control" name="no_tel" placeholder="Masukkan nomor telepon" required>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label for="exampleInputPassword1">Status</label>
                                        <br>
                                        <select class="form-control form-control-sm" name="status" required>
                                            <option value="" selected disabled>Pilih Status</option>
                                            <option value="Member">Member</option>
                                            <option value="Non Member">Non Member</option>
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
