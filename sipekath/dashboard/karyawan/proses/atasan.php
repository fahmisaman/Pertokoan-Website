<?php 
	include "../../../fungsi/conn.php";
	include "../../../fungsi/generate.php";
	$op = $_GET['op'];
	session_start();
	if ($op=="input_form") {
		// print_r($_GET);
		$atasan = $_GET['atasan'];
		$id_pegawai = $_SESSION['id_pengguna'];
		

		$cek = mysql_num_rows(mysql_query("SELECT * from atasan where bawahan='$id_pegawai' "));
		if ($cek==1) {
			$update = mysql_query("UPDATE atasan set atasan='$atasan' where bawahan='$id_pegawai'");
			
			if ($update) {
				echo "Berhasil Diperbarui";
			}else{
				echo mysql_error();
			}
		}else{
			$input = mysql_query("INSERT into atasan (bawahan,atasan) values ('$id_pegawai','$atasan')");
			
			if ($input) {
				echo "Berhasil Ditambahkan";
			}else{
				echo mysql_error();
			}
		}
	}elseif ($op=="lihat-atasan") {
		?>
		
			<script type="text/javascript">
				$(function () {
				  $('#td_atasan').DataTable({
				    
				  });
				});
			</script>

		<?php
		echo"<table id='td_atasan' class='table table-bordered table-hover '>
	      <thead>
	        <tr >
	          <th>Nama Atasan</th>
	          <th>Unit Kerja</th>
	        </tr>
	      </thead>
	      <tbody>";
	      $i=1;
	      $select = mysql_query("SELECT * from pegawai as a, atasan as b where a.id_pegawai=b.bawahan and a.id_pegawai='".$_SESSION['id_pengguna']."'");
	      while ($data = mysql_fetch_array($select)) {
	      	$data_atasan = mysql_fetch_assoc(mysql_query("SELECT * from pegawai where id_pegawai='".$data['atasan']."'"));
		echo"<tr>
		          <td>".$data_atasan['nama']."<br />".$data_atasan['jabatan']."</td>
		          <td>".$data_atasan['unit']."</td>
		     </tr>";
		     $i++;
		      }
		 echo"       
		 </tbody>
    	</table>";
	}elseif ($op=="hapus") {
		$id = $_GET['id'];
		$hapus = mysql_query("DELETE from desa WHERE id_desa='$id'");
		if ($hapus) {
			echo "Berhasil Hapus";
		}else{
			echo mysql_error();
		}
	}elseif ($op=="load_desa_edit") {
		$id = $_GET['id'];
		$query_data = mysql_fetch_array(mysql_query("SELECT * FROM desa WHERE id_desa = '".$id."'"));
		
		$array = array(
			"desa" => $query_data['desa'],
			"id_kec" => $query_data['id_kec'],
			"id_desa" => $query_data['id_desa']
			);
		
		echo json_encode($array);
	}elseif ($op=="ganti_atasan") {
		$id = $_GET['id'];
		$query = mysql_query("SELECT * FROM pegawai where id_instansi='$id'");
		  // echo "<option value=''>-- Pilih Kecamatan--</option>";
          while ($data = mysql_fetch_array($query)) {
            echo "<option value='".$data['id_pegawai']."'>".$data['nama']."</option>";
          }
	}
?>