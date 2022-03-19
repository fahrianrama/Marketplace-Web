

<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $kode_transaksi = mysqli_real_escape_string($mysqli, trim($_POST['kode_transaksi']));
            
            $tanggal         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
            $exp             = explode('-',$tanggal);
            $tanggal_keluar   = $exp[2]."-".$exp[1]."-".$exp[0];
            
            $kode_barang       = mysqli_real_escape_string($mysqli, trim($_POST['kode_barang']));
            $kode_barang2       = mysqli_real_escape_string($mysqli, trim($_POST['kode_barang2']));
            $kode_barang3       = mysqli_real_escape_string($mysqli, trim($_POST['kode_barang3']));
            $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
            $jumlah_keluar2    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar2']));
            $jumlah_keluar3   = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar3']));
            $total_stok      = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));
            
            $created_user    = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel barang keluar
            $query = mysqli_query($mysqli, "INSERT INTO tb_keluar(kode_transaksi,tanggal_keluar,kode_barang,jumlah_keluar,created_user) 
                                            VALUES('$kode_transaksi','$tanggal_keluar','$kode_barang','$jumlah_keluar','$created_user')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli)); 
                                            
            if($_POST['kode_barang2']!="") {
                $querysecond = mysqli_query($mysqli, "INSERT INTO tb_keluar(kode_transaksi,tanggal_keluar,kode_barang,jumlah_keluar,created_user) 
                                            VALUES('$kode_transaksi','$tanggal_keluar','$kode_barang2','$jumlah_keluar2','$created_user')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));
            }
            
            if($_POST['kode_barang3']!="") {
                $querythird = mysqli_query($mysqli, "INSERT INTO tb_keluar(kode_transaksi,tanggal_keluar,kode_barang,jumlah_keluar,created_user) 
                                            VALUES('$kode_transaksi','$tanggal_keluar','$kode_barang3','$jumlah_keluar3','$created_user')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));
            }

            // cek query
            if ($query) {
                // perintah query untuk mengubah data pada tabel barang
                $query1 = mysqli_query($mysqli, "UPDATE tb_barang SET stok        =  stok - '$jumlah_keluar'
                                                              WHERE kode_barang   = '$kode_barang'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                if ($querysecond) {
                    $query2 = mysqli_query($mysqli, "UPDATE tb_barang SET stok        =  stok - '$jumlah_keluar2'
                                                              WHERE kode_barang   = '$kode_barang2'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                }
                if ($querythird) {
                    $query3 = mysqli_query($mysqli, "UPDATE tb_barang SET stok        =  stok - '$jumlah_keluar3'
                                                              WHERE kode_barang   = '$kode_barang3'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                }

                // cek query
                if ($query1) {                       
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=barang_keluar&alert=1");
                }
            }
        }   
    }
}       
?>