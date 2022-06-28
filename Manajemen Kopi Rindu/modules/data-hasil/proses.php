

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
            $tanggal1       = mysqli_real_escape_string($mysqli, trim($_POST['tanggal1']));
            $tanggal2       = mysqli_real_escape_string($mysqli, trim($_POST['tanggal2']));
            
            $minsupport      = mysqli_real_escape_string($mysqli, trim($_POST['supportmin']));
            $minconfidence      = mysqli_real_escape_string($mysqli, trim($_POST['confmin']));

            // perintah query untuk menyimpan data ke tabel barang keluar
            $query = mysqli_query($mysqli, "INSERT INTO tb_hasil(tanggal_awal,tanggal_akhir,min_support,min_confidence) 
                                            VALUES('$tanggal1','$tanggal2','$minsupport','$minconfidence')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli)); 
                                            
        }
        if($query){              
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=data_hasil&alert=1");
        }  
    }
}       
?>