

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
    if ($_SESSION['hak_akses']=='Super Admin') {
        if ($_GET['act']=='insert') {
            if (isset($_POST['simpan'])) {
                // ambil data hasil submit dari form
                $kode_transaksi = mysqli_real_escape_string($mysqli, trim($_POST['kode_transaksi']));
                
                $tanggal         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
                $exp             = explode('-',$tanggal);
                $tanggal_keluar   = $exp[2]."-".$exp[1]."-".$exp[0];
                
                $kode_barang       = mysqli_real_escape_string($mysqli, trim($_POST['kode_barang']));
                $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
                $total_stok      = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));
                
                $created_user    = $_SESSION['nama_user'];

                // perintah query untuk menyimpan data ke tabel barang keluar
                $query = mysqli_query($mysqli, "INSERT INTO tb_keluar(kode_transaksi,tanggal_keluar,kode_barang,jumlah_keluar,created_user) 
                                                VALUES('$kode_transaksi','$tanggal_keluar','$kode_barang','$jumlah_keluar','$created_user')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli)); 
                                                

                // cek query
                if ($query) {
                    // perintah query untuk mengubah data pada tabel barang
                    $query1 = mysqli_query($mysqli, "UPDATE tb_barang SET stok        =  stok - '$jumlah_keluar'
                                                                WHERE kode_barang   = '$kode_barang'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                    // cek query
                    if ($query1) {                       
                        // jika berhasil tampilkan pesan berhasil simpan data
                        header("location: ../../main.php?module=barang_keluar&alert=1");
                    }
                }
            }   
        }
        elseif ($_GET['act']=='delete') {
            if (isset($_GET['id'])) {
                // ambil data hasil submit dari form
                $kode_transaksi = $_GET['id'];
    
                // perintah query untuk mengubah data pada tabel users
                $query = mysqli_query($mysqli, "DELETE FROM tb_keluar WHERE kode_transaksi = '$kode_transaksi'")
                                                or die('Ada kesalahan pada query update status on : '.mysqli_error($mysqli));
    
                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=barang_keluar&alert=4");
                }
            }
        }
        elseif ($_GET['act']=='acc') {
            if (isset($_GET['id'])) {
                // ambil data hasil submit dari form
                $kode_transaksi = $_GET['id'];
    
                // perintah query untuk mengubah data pada tabel users
                $query = mysqli_query($mysqli, "UPDATE tb_keluar SET status_terima  = 'terima' WHERE kode_transaksi = '$kode_transaksi'")
                                                or die('Ada kesalahan pada query update status on : '.mysqli_error($mysqli));
                $caridata = mysqli_query($mysqli,"SELECT * FROM tb_keluar WHERE kode_transaksi = '$kode_transaksi'");
                $data = mysqli_fetch_assoc($caridata);
                $kode_barang = $data['kode_barang'];
                $caribarang = mysqli_query($mysqli,"SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang'");
                $databarang = mysqli_fetch_assoc($caribarang);

                $nama_barang = $databarang['nama_barang'];
                $kategori = $databarang['kategori'];
                $harga_beli = $databarang['harga_beli'];
                $harga_jual = $databarang['harga_jual'];
                $satuan = $databarang['satuan'];
                $stok = $data['jumlah_keluar'];
                $created_user = $databarang['created_user'];


                $masukbarang = mysqli_query($mysqli,"INSERT INTO tb_stok(kode_barang,nama_barang,kategori,harga_beli,harga_jual,satuan,stok,created_user,updated_user) 
                                            VALUES('$kode_barang','$nama_barang','$kategori','$harga_beli','$harga_jual','$satuan','$stok','$created_user','$created_user')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));
                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=barang_keluar&alert=3");
                }
            }
        }
        elseif ($_GET['act']=='decline') {
            if (isset($_GET['id'])) {
                // ambil data hasil submit dari form
                $kode_transaksi = $_GET['id'];
    
                // perintah query untuk mengubah data pada tabel users
                $query = mysqli_query($mysqli, "UPDATE tb_keluar SET status_terima  = 'tolak' WHERE kode_transaksi = '$kode_transaksi'")
                                                or die('Ada kesalahan pada query update status on : '.mysqli_error($mysqli));
    
                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=barang_keluar&alert=4");
                }
            }
        }
    }
    else if ($_SESSION['hak_akses']=='Agen') {
        if ($_GET['act']=='insertpes') {
            if (isset($_POST['simpan'])) {
                // ambil data hasil submit dari form
                $kode_transaksi = mysqli_real_escape_string($mysqli, trim($_POST['kode_transaksi']));
                
                $tanggal         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
                $exp             = explode('-',$tanggal);
                $tanggal_keluar   = $exp[2]."-".$exp[1]."-".$exp[0];
                
                $kode_barang       = mysqli_real_escape_string($mysqli, trim($_POST['kode_barang']));
                $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
                $total_stok      = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));
                
                $created_user    = $_SESSION['nama_user'];

                // perintah query untuk menyimpan data ke tabel barang keluar
                $query = mysqli_query($mysqli, "INSERT INTO tb_pesanan(kode_transaksi,tanggal_keluar,kode_barang,jumlah_keluar,created_user) 
                                                VALUES('$kode_transaksi','$tanggal_keluar','$kode_barang','$jumlah_keluar','$created_user')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli)); 
                                                

                // cek query
                if ($query) {
                    // perintah query untuk mengubah data pada tabel barang
                    $query1 = mysqli_query($mysqli, "UPDATE tb_stok SET stok        =  stok - '$jumlah_keluar'
                                                                WHERE kode_barang   = '$kode_barang'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                    // cek query
                    if ($query1) {                       
                        // jika berhasil tampilkan pesan berhasil simpan data
                        header("location: ../../main.php?module=data_proses&alert=1");
                    }
                }
            }   
        }
        else if ($_GET['act']=='insert') {
            if (isset($_POST['simpan'])) {
                // ambil data hasil submit dari form
                $kode_transaksi = mysqli_real_escape_string($mysqli, trim($_POST['kode_transaksi']));
                
                $tanggal         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
                $exp             = explode('-',$tanggal);
                $tanggal_keluar   = $exp[2]."-".$exp[1]."-".$exp[0];
                
                $kode_barang       = mysqli_real_escape_string($mysqli, trim($_POST['kode_barang']));
                $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
                $total_stok      = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));
                
                $created_user    = $_SESSION['nama_user'];

                // perintah query untuk menyimpan data ke tabel pengajuan
                $query = mysqli_query($mysqli, "INSERT INTO tb_pengajuan(kode_transaksi,tanggal_keluar,kode_barang,jumlah_keluar,created_user) 
                                                VALUES('$kode_transaksi','$tanggal_keluar','$kode_barang','$jumlah_keluar','$created_user')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli)); 
                                                

                // cek query
                if ($query) {
                    // perintah query untuk mengubah data pada tabel barang
                    // cek query
                    header("location: ../../main.php?module=barang_keluar&alert=1");
                }
            }   
        }
        elseif ($_GET['act']=='ajukan') {
            if (isset($_GET['id'])) {
                // ambil data hasil submit dari form
                $kode_transaksi = $_GET['id'];
    
                // perintah query untuk mengubah data pada tabel users
                $query = mysqli_query($mysqli, "SELECT * FROM tb_pengajuan WHERE kode_transaksi = '$kode_transaksi'")
                                                or die('Ada kesalahan pada query update status on : '.mysqli_error($mysqli));
    
                // cek query
                while ($data = mysqli_fetch_assoc($query)) {
                    $tanggal_keluar = $data['tanggal_keluar'];
                    $kode_barang = $data['kode_barang'];
                    $jumlah_keluar = $data['jumlah_keluar'];
                    $created_user = $data['created_user'];

                    $queryinput = mysqli_query($mysqli, "INSERT INTO tb_keluar(kode_transaksi,tanggal_keluar,kode_barang,jumlah_keluar,created_user,status_terima) 
                                                VALUES('$kode_transaksi','$tanggal_keluar','$kode_barang','$jumlah_keluar','$created_user','tolak')")
                                                or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli)); 
                    $query1 = mysqli_query($mysqli, "UPDATE tb_barang SET stok        =  stok - '$jumlah_keluar'
                    WHERE kode_barang   = '$kode_barang'")
                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));
                    
                    $querydel = mysqli_query($mysqli, "DELETE FROM tb_pengajuan WHERE kode_transaksi = '$kode_transaksi'")
                                or die('Ada kesalahan pada query update status on : '.mysqli_error($mysqli));
                    if($queryinput && $query1 && $querydel){
                        // jika berhasil tampilkan pesan berhasil simpan data
                        header("location: ../../main.php?module=barang_keluar&alert=1");
                    }                                                
                }
            }
        }
        elseif ($_GET['act']=='delete') {
            if (isset($_GET['id'])) {
                // ambil data hasil submit dari form
                $kode_transaksi = $_GET['id'];
    
                // perintah query untuk mengubah data pada tabel users
                $query = mysqli_query($mysqli, "DELETE FROM tb_pengajuan WHERE kode_transaksi = '$kode_transaksi'")
                                                or die('Ada kesalahan pada query update status on : '.mysqli_error($mysqli));
    
                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=barang_keluar&alert=4");
                }
            }
        }
    }
}       
?>