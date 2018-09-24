<?php 
	include "../../../fungsi/conn.php";
	include "../../../fungsi/generate.php";
	$op = $_GET['op'];

	if ($op=="input_form") {
		// print_r($_GET);

		$tmp = $_GET['tmp'];
		$jk = $_GET['jk'];
		if (empty($_GET['id_tmp'])) {
			 $id_tmp = kode("id_tmp","tm_poktan","tmp-",4,3);
		}else{
			 $id_tmp = $_GET['id_tmp'];
		}
		$gapoktan = $_GET['gapoktan'];

		$cek = mysql_num_rows(mysql_query("SELECT * from tm_poktan where id_tmp='$id_tmp' "));
		if ($cek==1) {
			$update = mysql_query("UPDATE tm_poktan set tmp='$tmp', id_tmg='$gapoktan', id_jk='$jk' where id_tmp='$id_tmp'");
			if ($update) {
				echo "Berhasil Diperbarui";
			}else{
				echo mysql_error();
			}
		}else{
			$input = mysql_query("INSERT into tm_poktan (id_tmp,tmp,id_tmg,id_jk) values ('$id_tmp','$tmp','$gapoktan','$jk')");
			if ($input) {
				echo "Berhasil Ditambahkan";
			}else{
				echo mysql_error();
			}
		}
	}elseif ($op=="lihat-tmp") {
		
?>
	<script type="text/javascript">
        $(function () {
          $('#tb_tmp').DataTable({
            
          });
        });
      </script>
<?php
		echo"<table id='tb_tmp' class='table table-bordered table-hover '>
	      <thead>
	        <tr >
	          <th>Poktan</th>
	          <th>GPoktan</th>
	          <th>Jenis</th>
	          <th style='width:20%;'>Aksi</th>
	        </tr>
	      </thead>
	      <tbody>";
	      $i=1;
	      $select = mysql_query("SELECT * from tm_poktan as a, tm_gapoktan as b, jenis_kelompok as c where a.id_tmg=b.id_tmg and a.id_jk=c.id_jk");
	      while ($data = mysql_fetch_array($select)) {
		echo"<tr>
		          <td>".$data['tmg']."</td>
		          <td>".$data['tmp']."</td>
		          <td>".$data['jenis']."</td>
		          <td>
		          	<a title='Edit' style='cursor:pointer;' href='javascript:void(0);' onclick='edit(\"".$data['id_tmp']."\");'><span style='color:blue;' class='fa  fa-pencil-square-o'> </a> &nbsp;
		          	<a title='Hapus' href='javascript:void(0);' onclick='hapus(\"".$data['id_tmp']."\",\"".$data['tmp']."\");'><span class='fa fa-trash' style='color:red;'> </span></a>
		          </td>
		     </tr>";
		     $i++;
		      }
		 echo"       
		 </tbody>
    	</table>";
	}elseif ($op=="hapus") {
		$id = $_GET['id'];
		$hapus = mysql_query("DELETE from tm_poktan WHERE id_tmp='$id'");
		if ($hapus) {
			echo "Berhasil Hapus";
		}else{
			echo mysql_error();
		}
	}elseif ($op="load_tmp_edit") {
		$id = $_GET['id'];
		$query_data = mysql_fetch_array(mysql_query("SELECT * FROM tm_poktan WHERE id_tmp = '".$id."'"));
	
		$array = array(
			"tmp" => $query_data['tmp'],
			"id_tmg" => $query_data['id_tmg'],
			"id_jk" => $query_data['id_jk'],
			"id_tmp" => $query_data['id_tmp']
			);
		
		echo json_encode($array);
	}
?>