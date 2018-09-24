<?php 
	include "../../../fungsi/conn.php";
	include "../../../fungsi/generate.php";
	$op = $_GET['op'];

	if ($op=="input_form") {
		// print_r($_GET);

		$instansi = $_GET['instansi'];
		if (empty($_GET['id_instansi'])) {
			 $id_instansi = kode("id_instansi","instansi","IN-",3,3);
		}else{
			 $id_instansi = $_GET['id_instansi'];
		}

		$cek = mysql_num_rows(mysql_query("SELECT * from instansi where id_instansi='$id_instansi' "));
		if ($cek==1) {
			$update = mysql_query("UPDATE instansi set instansi='$instansi' where id_instansi='$id_instansi'");
			if ($update) {
				echo "Berhasil Diperbarui";
			}else{
				echo mysql_error();
			}
		}else{
			$input = mysql_query("INSERT into instansi (id_instansi,instansi) values ('$id_instansi','$instansi')");
			if ($input) {
				echo "Berhasil Ditambahkan";
			}else{
				echo mysql_error();
			}
		}
	}elseif ($op=="lihat-instansi") {
		
?>
	<script type="text/javascript">
        $(function () {
          $('#tb_instansi').DataTable({
            
          });
        });
      </script>
<?php
		echo"<table id='tb_instansi' class='table table-bordered table-hover '>
	      <thead>
	        <tr >
	          <th>Instansi</th>
	          <th style='width:20%;'>Aksi</th>
	        </tr>
	      </thead>
	      <tbody>";
	      $i=1;
	      $select = mysql_query("SELECT * from instansi");
	      while ($data = mysql_fetch_array($select)) {
		echo"<tr>
		          <td>".$data['instansi']."</td>
		          <td>
		          	<a title='Edit' style='cursor:pointer;' href='javascript:void(0);' onclick='edit(\"".$data['id_instansi']."\");'><span style='color:blue;' class='fa  fa-pencil-square-o'> </a> &nbsp;
		          	<a title='Hapus' href='javascript:void(0);' onclick='hapus(\"".$data['id_instansi']."\",\"".$data['instansi']."\");'><span class='fa fa-trash' style='color:red;'> </span></a>
		          </td>
		     </tr>";
		     $i++;
		      }
		 echo"       
		 </tbody>
    	</table>";
	}elseif ($op=="hapus") {
		$id = $_GET['id'];
		$hapus = mysql_query("DELETE from instansi WHERE id_instansi='$id'");
		if ($hapus) {
			echo "Berhasil Hapus";
		}else{
			echo mysql_error();
		}
	}elseif ($op="load_instansi_edit") {
		$id = $_GET['id'];
		$query_data = mysql_fetch_array(mysql_query("SELECT * FROM instansi WHERE id_instansi = '".$id."'"));
	
		$array = array(
			"instansi" => $query_data['instansi'],
			"id_instansi" => $query_data['id_instansi']
			);
		
		echo json_encode($array);
	}
?>