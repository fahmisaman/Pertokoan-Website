<?php 
	include "../../../fungsi/conn.php";
	include "../../../fungsi/generate.php";
	$op = $_GET['op'];

	if ($op=="input_form") {
		// print_r($_GET);

		$tmg = $_GET['tmg'];
		$kecamatan = $_GET['kecamatan'];
		$desa = $_GET['desa'];
		if (empty($_GET['id_tmg'])) {
			 $id_tmg = kode("id_tmg","tm_gapoktan","tmg-",4,3);
		}else{
			 $id_tmg = $_GET['id_tmg'];
		}


		$cek = mysql_num_rows(mysql_query("SELECT * from tm_gapoktan where id_tmg='$id_tmg' "));
		if ($cek==1) {
			$update = mysql_query("UPDATE tm_gapoktan set tmg='$tmg', id_kec='$kecamatan', id_desa='$desa' where id_tmg='$id_tmg'");
			if ($update) {
				echo "Berhasil Diperbarui";
			}else{
				echo mysql_error();
			}
		}else{
			$input = mysql_query("INSERT into tm_gapoktan (id_tmg,tmg,id_kec,id_desa) values ('$id_tmg','$tmg','$desa','$kecamatan')");
			if ($input) {
				echo "Berhasil Ditambahkan";
			}else{
				echo mysql_error();
			}
		}
	}elseif ($op=="lihat-tmg") {
		
?>
	<script type="text/javascript">
        $(function () {
          $('#tb_tmg').DataTable({
            
          });
        });
      </script>
<?php
		echo"<table id='tb_tmg' class='table table-bordered table-hover '>
	      <thead>
	        <tr >
	          <th>Poktan</th>
	          <th>Detail</th>
	          <th style='width:20%;'>Aksi</th>
	        </tr>
	      </thead>
	      <tbody>";
	      $i=1;
	      $select = mysql_query("SELECT * from tm_gapoktan as a, desa as b, kecamatan as c where a.id_desa=b.id_desa and b.id_kec=c.id_kec");
	      while ($data = mysql_fetch_array($select)) {
		echo"<tr>
		          <td>".$data['tmg']."</td>
		          <td>".$data['kec']."<br />".$data['desa']."</td>
		          <td>
		          	<a title='Edit' style='cursor:pointer;' href='javascript:void(0);' onclick='edit(\"".$data['id_tmg']."\");'><span style='color:blue;' class='fa  fa-pencil-square-o'> </a> &nbsp;
		          	<a title='Hapus' href='javascript:void(0);' onclick='hapus(\"".$data['id_tmg']."\",\"".$data['tmg']."\");'><span class='fa fa-trash' style='color:red;'> </span></a>
		          </td>
		     </tr>";
		     $i++;
		      }
		 echo"       
		 </tbody>
    	</table>";
	}elseif ($op=="hapus") {
		$id = $_GET['id'];
		$hapus = mysql_query("DELETE from tm_gapoktan WHERE id_tmg='$id'");
		if ($hapus) {
			echo "Berhasil Hapus";
		}else{
			echo mysql_error();
		}
	}elseif ($op=="load_tmg_edit") {
		$id = $_GET['id'];
		$query_data = mysql_fetch_array(mysql_query("SELECT * FROM tm_gapoktan WHERE id_tmg = '".$id."'"));
	
		$array = array(
			"tmg" => $query_data['tmg'],
			"id_tmg" => $query_data['id_tmg']
			);
		
		echo json_encode($array);
	}elseif ($op=="load_desa") {
		$id = $_GET['id_kec'];
		$query = mysql_query("SELECT * FROM desa where id_kec='$id'");
		  echo "<option value=''>-- Pilih Desa --</option>";
          while ($data = mysql_fetch_array($query)) {
            echo "<option value='".$data['id_desa']."'>".$data['desa']."</option>";
        }
	}
?>