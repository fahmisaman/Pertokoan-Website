<?php 
	include "../../../fungsi/conn.php";
	include "../../../fungsi/generate.php";
	$op = $_GET['op'];

	if ($op=="upload_tp") {
		// print_r($_GET);

	
		if (empty($_POST['id_capaian'])) {
			 $id_capaian = kode("id_capaian","capaian","komoditas-",10,3);
		}else{
			 $id_capaian = $_POST['id_capaian'];
		}
			 $instansi = $_POST['instansi'];
			 $capaian = $_POST['capaian'];

		$cek = mysql_num_rows(mysql_query("SELECT * from capaian where id_capaian='$id_capaian' "));
		if ($cek==1) {
			$update = mysql_query("UPDATE capaian set capaian='$capaian',id_instansi='$instansi' where id_capaian='$id_capaian'");
				if($update){
					echo "sukses";
				}else{
					echo "gagal input";
				}
		}else{
			$cek_instansi = mysql_num_rows(mysql_query("SELECT * from capaian where id_instansi='$instansi' "));
			if ($cek_instansi == 1) {
				echo "Sudah Ada Instansi Yang sama";
			}else{
				$update = mysql_query("INSERT into capaian (capaian,id_instansi) values ('$capaian','$instansi')");
					if($update){
						echo "sukses";
					}else{
						echo "gagal input";
					}
			}
		}
	}elseif ($op=="lihat-komoditas") {
		
?>
	<script type="text/javascript">
        $(function () {
          $('#tb_komoditas').DataTable({
            
          });
        });
      </script>
<?php
		echo"<table id='tb_komoditas' class='table table-bordered table-hover '>
	      <thead>
	        <tr>
	          <th>Instansi</th>
	          <th>Capaian (Menit)</th>
	          <th style='width:20%;'>Aksi</th>
	        </tr>
	      </thead>
	      <tbody>";
	      $i=1;
	      $select = mysql_query("SELECT * from capaian as a, instansi as b where a.id_instansi=b.id_instansi");
	      while ($data = mysql_fetch_array($select)) {
		echo"<tr>
		          <td>".$data['instansi']."</td>
		          <td>".$data['capaian']." Menit / Hari</td>
		          <td>
		          	<a title='Edit' style='cursor:pointer;' href='javascript:void(0);' onclick='edit(\"".$data['id_capaian']."\");'><span style='color:blue;' class='fa  fa-pencil-square-o'> </a> &nbsp;
		          	<a title='Hapus' href='javascript:void(0);' onclick='hapus(\"".$data['id_capaian']."\",\"".$data['instansi']."\");'><span class='fa fa-trash' style='color:red;'> </span></a>
		          </td>
		     </tr>";
		     $i++;
		      }
		 echo"       
		 </tbody>
    	</table>";
	}elseif ($op=="hapus") {
		$id = $_GET['id'];
		$hapus = mysql_query("DELETE from capaian WHERE id_capaian='$id'");
		if ($hapus) {
			echo "Berhasil Hapus";
		}else{
			echo mysql_error();
		}
	}elseif ($op="load_komoditas_edit") {
		$id = $_GET['id'];
		$query_data = mysql_fetch_array(mysql_query("SELECT * FROM capaian WHERE id_capaian = '".$id."'"));
	
		$array = array(
			"komoditas" => $query_data['komoditas'],
			"id_jk" => $query_data['id_jk'],
			"id_capaian" => $query_data['id_capaian']
			);
		
		echo json_encode($array);
	}
?>