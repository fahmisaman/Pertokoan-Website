<?php
	session_start();
	include '../../../config/conn.php';
	$op = $_GET['op'];
	if ($op=="cek_sandi") {
		$sandi_lama = md5($_GET['sandi_lama']);
		$username = $_GET['username'];
		// echo $sandi_lama;
		$select = mysql_query("select * from login where username='".$username."' and password='".$sandi_lama."' ");
		$cek = mysql_num_rows($select);
		if ($cek == 0) {
			echo "form-group has-error";
		}else{
			echo "form-group has-success";
		}
	}elseif ($op=="editpass") {
		$username = $_GET['username_ku'];
		$sandi_lama = md5($_GET['sandi_lama']);
		$sandi_baru = md5($_GET['sandi_baru']);
		$konfirm_sandi = md5($_GET['konfirm_sandi']);
		// print_r($_GET);
		$select = mysql_query("select * from login where username='".$username."' and password='".$sandi_lama."' ");
		$cek = mysql_num_rows($select);
		if ($cek == 0) {
			echo "Sandi Lama salah";
		}else{
			if ($sandi_baru == $konfirm_sandi) {
				$update = mysql_query("UPDATE login set password='".$konfirm_sandi."' where username='".$username."' ");
				if ($update) {
					echo "berhasil update";
				}else{
					echo "gagal";
				}
			}else{
				echo "Konfirmasi Sandi Salah";
			}
		}
	}else if($op == "autentikasi"){
		$pin = $_GET['pin_trans'];

		$autentikasi = mysql_num_rows(mysql_query("SELECT * FROM member WHERE id_member = '".$_SESSION['id_member']."' AND pin_transaksi = '".$pin."'"));

		if($autentikasi > 0){
			echo "yes";
		}else{
			echo "no";
		}
	}

?>