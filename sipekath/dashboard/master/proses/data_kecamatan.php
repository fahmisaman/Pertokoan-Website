<?php 
	include "../../../fungsi/conn.php";
	include "../../../fungsi/generate.php";
	$op = $_GET['op'];

	if ($op=="input_form") {
		// print_r($_GET);
		$kec = $_GET['kec'];
		
		if (empty($_GET['id_kec'])) {
			$id_kec = kode("id_kec","kecamatan","kec-",4,3);
		}else{
			$id_kec = $_GET['id_kec'];
		}		
		

		$cek = mysql_num_rows(mysql_query("SELECT * from kecamatan where id_kec='$id_kec' "));
		if ($cek==1) {
			$update = mysql_query("UPDATE kecamatan set kec='$kec' where id_kec='$id_kec'");
			
			if ($update) {
				echo "Berhasil Diperbarui";
			}else{
				echo mysql_error();
			}
		}else{
			$input = mysql_query("INSERT into kecamatan (id_kec,kec) values ('$id_kec','$kec')");
			
			if ($input) {
				echo "Berhasil Ditambahkan";
			}else{
				echo mysql_error();
			}
		}
	}elseif ($op=="lihat-kec") {
		?>
		
			<script type="text/javascript">
				$(function () {
				  $('#tb_kec').DataTable({
				    
				  });
				});
			</script>

		<?php
		echo"<table id='tb_kec' class='table table-bordered table-hover '>
	      <thead>
	        <tr >
	          <th>Kecamatan</th>
	          <th style='width:32%;'>Aksi</th>
	        </tr>
	      </thead>
	      <tbody>";
	      $i=1;
	      $select = mysql_query("SELECT * from kecamatan");
	      while ($data = mysql_fetch_array($select)) {
	      
		echo"<tr>
		          <td>".$data['kec']."</td>
		          <td>
		          	<a style='cursor:pointer;' href='javascript:void(0);' onclick='edit(\"".$data['id_kec']."\");'><span style='color:blue;' class='fa  fa-pencil-square-o'> Edit</a> &nbsp;
		          	<a href='javascript:void(0);' onclick='hapus(\"".$data['id_kec']."\",\"".$data['kec']."\");'><span class='fa fa-trash' style='color:red;'> Hapus</span></a>
		          </td>
		     </tr>";
		     $i++;
		      }
		 echo"       
		 </tbody>
    	</table>";
	}elseif ($op=="hapus") {
		$id = $_GET['id'];
		$hapus = mysql_query("DELETE from kecamatan WHERE id_kec='$id'");
		if ($hapus) {
			echo "Berhasil Hapus";
		}else{
			echo mysql_error();
		}
	}elseif ($op="load_kec_edit") {
		$id = $_GET['id'];
		$query_data = mysql_fetch_array(mysql_query("SELECT * FROM kecamatan WHERE id_kec = '".$id."'"));
		
		$array = array(
			"kec" => $query_data['kec'],
			"id_kec" => $query_data['id_kec']
			);
		
		echo json_encode($array);
	}
?>