<?php 
 
session_start();
 
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
?>
<?php
include 'header.php';
?>
<div id="tabel">
<script>
    $(document).ready(function(){
            load_data();
            function load_data(page){
                $.ajax({
                    url:"get_data.php",
                    method:"POST",
                    data:{page:page},
                    success:function(data){
                        $('#tabel').html(data);
                    }
                })
            }
            $(document).on('click', '.halaman', function(){
                var page = $(this).attr("id");
                load_data(page);
            });
    });
</script>
</div>
</body>
</html>