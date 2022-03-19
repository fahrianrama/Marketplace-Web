<!DOCTYPE html>
<html lang="en">
    <?php require_once("header.php");
    require_once("connect.php");?>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">CupCup Market</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <?php require_once("sidenav_bar.php");?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tampilkan Transaksi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tampilkan Transaksi</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Berikut merupakan beberapa transaksi yang telah dimasukkan oleh user
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabel Transaksi
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Transaksi</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Diskon</th>
                                            <th>ID Pelanggan</th>
                                            <th>Nama Pelanggan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $query = mysqli_query($mysqli,"SELECT * FROM tb_transaksi INNER JOIN tb_barang ON tb_transaksi.id_barang = tb_barang.id_barang INNER JOIN tb_pelanggan ON tb_transaksi.id_pelanggan = tb_pelanggan.id_pelanggan");
                                        while ($data = mysqli_fetch_assoc($query)){
                                            ?> <tr>
                                                <td><?php echo($data['id_transaksi']);?></td>
                                                <td><?php echo($data['nama_transaksi']);?></td>
                                                <td><?php echo($data['tgl_transaksi']);?></td>
                                                <td>Rp. <?php echo($data['harga']);?></td>
                                                <td><?php echo($data['qty']);?></td>
                                                <td><?php echo($data['id_barang']);?></td>
                                                <td><?php echo($data['nama_barang']);?></td>
                                                <td><?php echo($data['diskon']);?>%</td>
                                                <td><?php echo($data['id_pelanggan']);?></td>
                                                <td><?php echo($data['nama_pelanggan']);?></td>
                                            </tr> <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; CupCup Market</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
