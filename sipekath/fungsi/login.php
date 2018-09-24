<?php

	include 'conn.php';
	include 'security.php';

	$username = antiInjections($_POST['username']);
	$password = antiInjections($_POST['password']);

	$sql_login = mysql_query("SELECT * FROM pegawai WHERE username = '".$username."' or nip='$username' AND password = '".$password."'");
	//$sql_login = mysql_query("SELECT * FROM login WHERE username = '".$username."' AND password = '".$password."' or no_hp= '".$username."' AND password = '".$password."' or email= '".$username."' AND password = '".$password."' ");

	$data_login = mysql_fetch_array($sql_login);
	$login = mysql_num_rows($sql_login);
	// echo $sql_login."dan".$login;
	// print_r($_POST);

	if (($login == 1)) {	
			session_start();
			if ($data_login['status_pegawai']=="Y") {
				$_SESSION['username'] = $data_login['username'];
				$_SESSION['nama'] = $data_login['nama'];
				$_SESSION['id_pengguna'] = $data_login['id_pegawai'];
				$_SESSION['id_login'] = $data_login['id_pegawai'];
				$_SESSION['level'] = "pegawai";

				if (isset($_POST['remember_me'])) {
					setcookie ("member_login",$_POST["username"],time() + (60 * 60), '/');
					setcookie ("member_password",$_POST["password"],time() + (60 * 60), '/');
				} else {
						setcookie ("member_login","");
						setcookie ("member_password","");
				}

				echo "berhasil";
			}else{
				echo "waiting";
			}
	}else{
		echo "gagal";
	}

?>