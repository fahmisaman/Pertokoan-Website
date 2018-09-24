<?php 
setHeader("Beranda","fa fa-dashboard");

 	if($_SESSION['level'] == "admin"){
		echo "Selamat Datang Admin";	

    }else if($_SESSION['level'] == "pemohon"){
		echo "Selamat Datang Pemohon";	

    }else if($_SESSION['level'] == "izin"){
		
    	echo "Selamat Datang Dinas Perizinan";	
    }else if($_SESSION['level'] == "dtk"){
		
    	echo "Selamat Datang Dinas Tata Kota";	
    }

   // 
?>
<script>
	function belum(){
		alert("Masih Dalam Tahap Pengembangan !!!");
	}

</script>

