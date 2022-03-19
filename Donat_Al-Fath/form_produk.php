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
        <form action="form_produk.php?aksi=tambah" method="POST">
            <h4 class="mt-3 text-white mb-1">Nama Produk</h4>
            <input type="text" class="form-control" name="nama" required>
            <h4 class="mt-3 text-white mb-1">Harga Satuan</h4>
            <input type="text" class="form-control mb-5" name="harga" required>
            <div class="form-group text-right">
            <input type="submit" class="btn btn-success btn-block btn-submit" name="simpan" value="Simpan">
            <a href="produk.php" class="btn btn-danger btn-block btn-reset">Batal</a>
        </form>
        <?php
        if (isset($_POST['simpan'])) {
            $nama  = $_POST['nama'];
            $harga = $_POST['harga'];
            $tambah = mysqli_query($database, "INSERT INTO tb_produk(nama_produk,harga_produk) VALUES   
                                            ('$nama','$harga')");
            if ($tambah) {
                header("location: produk.php");
            }  
        }
    }
    else if ($_GET['aksi']=='edit') {
        $src = mysqli_query($database, "SELECT * FROM tb_produk WHERE id_produk='$_GET[id]'");
        $src_val  = mysqli_fetch_assoc($src);
        ?>
        <h4 class="mb-5 text-center text-white ">Edit Data</h4>
        <form action="form_produk.php?aksi=editfetch" method="POST">
            <h4 class="mt-3 text-white mb-1">ID produk</h4>
            <input type="text" class="form-control" name="id" value="<?php echo $_GET['id'];?>" readonly>
            <h4 class="mt-3 text-white mb-1">Nama Produk</h4>
            <input type="text" class="form-control" name="nama" value="<?php echo $src_val['nama_produk']; ?>" required>
            <h4 class="mt-3 text-white mb-1">Harga Satuan</h4>
            <input type="text" class="form-control" name="harga" value="<?php echo $src_val['harga_produk']; ?>" required>
            
            <div class="form-group text-right mt-5">
            <input type="submit" class="btn btn-success btn-block btn-submit" name="simpan" value="Simpan">
            <a href="produk.php" class="btn btn-danger btn-block btn-reset">Batal</a>
        </form>
        <?php
        
    }
    else if ($_GET['aksi']=='editfetch') {
        if (isset($_POST['simpan'])) {
            $id  = $_POST['id'];
            $nama  = $_POST['nama'];
            $harga   = $_POST['harga'];
            $ubah = mysqli_query($database, "UPDATE tb_produk SET id_produk = '$id',nama_produk = '$nama',harga_produk = '$harga' WHERE id_produk = '$id'") ; 
            if ($ubah) {
                header("location: produk.php");
            }   
        }
    }
    else if ($_GET['aksi']=='hapus') {
        $delete = mysqli_query($database, "DELETE FROM tb_produk WHERE id_produk='$_GET[id]'");
        if ($delete) {
            header("location: produk.php");
        }   
    }
}