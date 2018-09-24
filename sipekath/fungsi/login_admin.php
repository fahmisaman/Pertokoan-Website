<?php

	include 'conn.php';
	include 'security.php';

	$username = antiInjections($_POST['user']);
	$password = antiInjections($_POST['pass']);
	// $password = md5($passwordku);

	$sql_login = mysql_query("SELECT * FROM admin WHERE username = '".$username."' AND password = '".$password."'");
	//$sql_login = mysql_query("SELECT * FROM login WHERE username = '".$username."' AND password = '".$password."' or no_hp= '".$username."' AND password = '".$password."' or email= '".$username."' AND password = '".$password."' ");

	$data_login = mysql_fetch_array($sql_login);

	$login = mysql_num_rows($sql_login);
	// echo $sql_login."dan".$login;


	if (($login == 1)) {
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['level'] = "admin";
			
			$_SESSION['nama'] = "Admin";
			$_SESSION['id_user'] = $data_login['id_admin'];
			$_SESSION['id_pengguna'] = $data_login['id_admin'];
			$_SESSION['id_login'] = $data_login['id_admin'];

			echo "berhasil";
	}else{
		echo "gagal";
	}

?>