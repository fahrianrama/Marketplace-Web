<?php 
    $database = new mysqli('localhost', 'root', '', 'toko_donat');
?>
<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
                    <div class="container-fluid">
                    <button
                            class="navbar-toggler"
                            type="button"
                            data-mdb-toggle="collapse"
                            data-mdb-target="#navbarExample01"
                            aria-controls="navbarExample01"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                    >
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarExample01">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produk.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        </ul>
                    </div>
                    </div>
                </nav>
                <!-- Navbar -->

                <!-- Background image -->
                <div
                        class="p-5 text-center bg-image"
                        style="
                        background-image: url('images/header.png');
                        height: 165px;
                        margin-top: 58px;
                        margin-bottom: 30px;
                        "
                >
                    <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="text-white">
                        <h1 class="mb-3">Toko Donat Al-Fatih</h1>
                        <h4 class="mb-3">Jl.belibis no 4</h4>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- Background image -->
            <h1 class="text-white text-center mb-4">Data Penjualan</h1>
            <a class='btn btn-info btn-block mb-3' href="form_penjualan.php?aksi=tambah">Tambah Data</a>
                <table>
                    <thead>
                        <tr class="table100-head">
                            <th class="column2">ID Produk</th>
                            <th class="column2">Nama Produk</th>
                            <th class="column2">Jumlah Terjual</th>
                            <th class="column2">Harga Satuan</th>
                            <th class="column2">Total</th>
                            <th class="column2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hal = (isset($_POST['page']))? $_POST['page'] : 1;
                        $bts = 10; 
                        $bts_mulai = ($hal - 1) * $bts;

                        $query = "SELECT * FROM tb_penjualan ORDER BY id_penjualan ASC LIMIT $bts_mulai, $bts";
                        $query_get = $database->prepare($query);
                        $query_get->execute();
                        $hasil = $query_get->get_result();
                        while ($data = $hasil->fetch_assoc()) {
                        $total = $data['jumlah'] * $data['harga'];
                        ?>
                        <tr scope="row">
                            <td><?php echo $data["id_penjualan"]; ?></td>
                            <td><?php echo $data["nama_produk"]; ?></td>
                            <td><?php echo $data["jumlah"]; ?></td>
                            <td>Rp <?php echo $data["harga"]; ?></td>
                            <td>Rp <?php echo $total; ?></td>
                            
                            <td><a class='btn btn-dark btn-sm' href="form_penjualan.php?aksi=edit&id=<?php echo $data['id_penjualan']?>">Edit</a>
                                <a class='btn btn-dark btn-sm' href="form_penjualan.php?aksi=hapus&id=<?php echo $data['id_penjualan']?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                    $query_jumlah = "SELECT count(*) AS jumlah FROM tb_penjualan";
                    $query_get = $database->prepare($query_jumlah);
                    $query_get->execute();
                    $hasil = $query_get->get_result();
                    $data = $hasil->fetch_assoc();
                    $total_hasil = $data['jumlah'];?>
                    <nav class="mt-2">
                    <ul class="pagination justify-content-center">
                        <?php
                        $halaman_total = ceil($total_hasil / $bts);
                        $data_total = 3;
                        $mulai = ($hal > $data_total)? $hal - $data_total : 1;
                        $akhir = ($hal < ($halaman_total - $data_total))? $hal + $data_total : $halaman_total;
                    
                        

                        if($hal == 1){
                            echo '<li class="page-item disabled"><a class="page-link" href="#">Pertama</a></li>';
                            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                        } else {
                            $link_prev = ($hal > 1)? $hal - 1 : 1;
                            echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">Pertama</a></li>';
                            echo '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                        }

                        for($i = $mulai; $i <= $akhir; $i++){
                            $link_active = ($hal == $i)? ' active' : '';
                            echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
                        }

                        if($hal == $halaman_total){
                            echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                            echo '<li class="page-item disabled"><a class="page-link" href="#">Terakhir</a></li>';
                        } else {
                            $link_next = ($hal < $halaman_total)? $hal + 1 : $halaman_total;
                            echo '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                            echo '<li class="page-item halaman" id="'.$halaman_total.'"><a class="page-link" href="#">Terakhir</a></li>';
                        }
                        ?>
                    </ul>
                    </nav>
                
            </div>
        </div>
    </div>
</div>