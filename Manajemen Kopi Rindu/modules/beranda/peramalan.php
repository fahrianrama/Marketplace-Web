<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<!-- get count barang in tb_barang -->
<?php
$query = "SELECT COUNT(*) as total FROM tb_barang";
$data = mysqli_query($mysqli, $query) or die('Ada kesalahan pada query: '.mysqli_error($mysqli));
$row = mysqli_fetch_assoc($data);
$total_barang = $row['total'];
$id = [];
for($i=0;$i<$total_barang;$i++){
    $id[$i] = "MyChart".$i;
    echo '<canvas id="'.$id[$i].'" style="margin-top:30px;width:100%;max-width:1100px"></canvas>';
}

$username = $_SESSION['nama_user'];
// select from table tb_peramalan which user is username
$query = mysqli_query($mysqli, "SELECT kode_barang, nama_barang FROM tb_barang") or die('Ada kesalahan pada query user: '.mysqli_error($mysqli));
$counterbarang = 0;
while ($data = mysqli_fetch_assoc($query)) {
    // get data by week
    // if hak akses super admin
    if($_SESSION['hak_akses'] == 'Super Admin'){
        $query2 = mysqli_query($mysqli, "SELECT * FROM tb_peramalan WHERE tanggal BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() AND kode_barang ='$data[kode_barang]' ORDER BY tanggal ASC") or die('Ada kesalahan pada query user: '.mysqli_error($mysqli));
    }
    else{
        $query2 = mysqli_query($mysqli, "SELECT * FROM tb_peramalan WHERE username='$username' AND tanggal BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() AND kode_barang ='$data[kode_barang]' ORDER BY tanggal ASC") or die('Ada kesalahan pada query user: '.mysqli_error($mysqli));
    }
    $data_ramal = [];
    $data_real = [];
    $tanggal = [];
    $count = 0;
    while($data2 = mysqli_fetch_assoc($query2)){
        $data_real[$count] = $data2['penjualan'];
        // hari
        $tanggal[$count] = date('d', strtotime($data2['tanggal']));
        if($count == 0){
            $data_ramal[$count] = round($data2['penjualan']);
        }
        else{
            $data_ramal[$count] = round((0.7 * $data2['penjualan']) + (0.3)*$data_ramal[$count-1]);
        }
        // update peramalan to table tb_peramalan
        // if get act ramal
        if(isset($_GET['act']) && $_GET['act'] == 'ramal'){
            $query3 = mysqli_query($mysqli, "UPDATE tb_peramalan SET peramalan='$data_ramal[$count]' WHERE id='$data2[id]'") or die('Ada kesalahan pada query user: '.mysqli_error($mysqli));
        }
        $count += 1;
    }
    // add tanggal to array to next day
    $tanggal[$count] = date('d', strtotime('tomorrow'));
    if($count == 0){
        
    }
    else{
        $data_ramal[$count] = round((0.7 * $data_ramal[$count-1]) + (0.3)*$data_real[$count-1]);
    }
    
    ?>
    <script>
        var xValues = <?php echo json_encode($tanggal); ?>;
        new Chart("<?php echo $id[$counterbarang] ?>", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    label: "Perkiraan Penjualan",
                    backgroundColor: "rgba(0,0,0,0)",
                    borderColor: 'yellow',
                    data: <?php echo json_encode($data_ramal); ?>,
                },
                {
                    label: "Real Penjualan",
                    backgroundColor: "rgba(0,0,0,0)",
                    borderColor: "green",
                    data: <?php echo json_encode($data_real); ?>,
                }]
            },
            options:{
                title: {
                    display: true,
                    text: 'Peramalan <?php echo $data['nama_barang']; ?>'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Hari'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                        }
                    }]
                }
            }
        });
    </script>
    <?php
    $counterbarang += 1;
}
?>
