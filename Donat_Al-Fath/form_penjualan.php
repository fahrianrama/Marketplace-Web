<?php
$database = new mysqli('localhost', 'root', '', 'toko_donat');
include 'header.php';
?>
<div class="limiter">
<div class="container-table100">
<div class="wrap-table100">
<div class="table100">
<?php
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='tambah') {
        ?>
        <h1 class="mb-5 text-center text-white ">Tambah Data</h1>
        <form action="form_penjualan.php?aksi=tambah" method="POST">
            <h4 class="mt-3 text-white mb-1">Nama Produk</h4>
            <select class="form-control" name="nama" required>
                <option value="">
                <?php
                    $query_barang = mysqli_query($database, "SELECT nama_produk FROM tb_produk ORDER BY id_produk ASC")
                                                        or die('Ada kesalahan pada query tampil barang: '.mysqli_error($mysqli));
                    while ($data_barang = mysqli_fetch_assoc($query_barang)) {
                    echo"<option>$data_barang[nama_produk] </option>";
                    }
                ?>
                </option>
            </select>
            <h4 class="mt-3 text-white mb-1">Jumlah</h4>
            <input type="text" class="form-control" name="jumlah" required>
            <div class="form-group text-right mt-5">
            <input type="submit" class="btn btn-success btn-block btn-submit" name="simpan" value="Simpan">
            <a href="dashboard.php" class="btn btn-danger btn-block btn-reset">Batal</a>
        </form>
        <?php
        if (isset($_POST['simpan'])) {
            $nama  = $_POST['nama'];
            $jumlah  = $_POST['jumlah'];
            $harga = 0;
            $query_barang = mysqli_query($database, "SELECT * FROM tb_produk ORDER BY id_produk ASC")
                                                        or die('Ada kesalahan pada query tampil barang: '.mysqli_error($mysqli));
            while ($data_barang = mysqli_fetch_assoc($query_barang)){
                if ($data_barang['nama_produk'] == $_POST['nama']){
                    $harga = $data_barang['harga_produk'];
                }
            }
            $tambah = mysqli_query($database, "INSERT INTO tb_penjualan(nama_produk,jumlah,harga) VALUES   
                                            ('$nama','$jumlah','$harga')");
            if ($tambah) {
                header("location: index.php");
            }  
        }
    }
    else if ($_GET['aksi']=='edit') {
        $src = mysqli_query($database, "SELECT * FROM tb_penjualan WHERE id_penjualan='$_GET[id]'");
        $src_val  = mysqli_fetch_assoc($src);
        ?>
        <h4 class="mb-5 text-center text-white ">Edit Data</h4>
        <form action="form_penjualan.php?aksi=editfetch" method="POST">
            <h4 class="mt-3 text-white mb-1">ID Penjualan</h4>
            <input type="text" class="form-control" name="id" value="<?php echo $_GET['id'];?>" readonly>
            <h4 class="mt-3 text-white mb-1">Nama Produk</h4>
            <input type="text" class="form-control" name="nama" value="<?php echo $src_val['nama_produk']; ?>" required>
            <h4 class="mt-3 text-white mb-1">Jumlah</h4>
            <input type="text" class="form-control" name="jumlah" value="<?php echo $src_val['jumlah']; ?>" required>
            <h4 class="mt-3 text-white mb-1">Harga Satuan</h4>
            <input type="text" class="form-control" name="harga" value="<?php echo $src_val['harga']; ?>" required>
            
            <div class="form-group text-right mt-4">
            <input type="submit" class="btn btn-success btn-block btn-submit" name="simpan" value="Simpan">
            <a href="index.php" class="btn btn-danger btn-block btn-reset">Batal</a>
        </form>
        <?php
        
    }
    else if ($_GET['aksi']=='editfetch') {
        if (isset($_POST['simpan'])) {
            $id  = $_POST['id'];
            $nama  = $_POST['nama'];
            $jumlah  = $_POST['jumlah'];
            $harga   = $_POST['harga'];
            $ubah = mysqli_query($database, "UPDATE tb_penjualan SET id_penjualan = '$id',nama_produk = '$nama',jumlah = '$jumlah',harga = '$harga' WHERE id_penjualan = '$id'") ; 
            if ($ubah) {
                header("location: index.php");
            }   
        }
    }
    else if ($_GET['aksi']=='hapus') {
        $delete = mysqli_query($database, "DELETE FROM tb_penjualan WHERE id_penjualan='$_GET[id]'");
        if ($delete) {
            header("location: index.php");
        }   
    }
}