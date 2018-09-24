<?php 
	include "../../../fungsi/conn.php";
	include "../../../fungsi/generate.php";
	$op = $_GET['op'];
	session_start();
	if ($op=="input_form") {
		// print_r($_GET);

		$tahun = $_GET['tahun'];
		$bulan = $_GET['bulan'];
		$id_pegawai = $_SESSION['id_pengguna'];
	 	$id_kategori = $_GET['id_kategori'];

			$cek_ada = mysql_num_rows(mysql_query("SELECT * from kategori where bulan='$bulan' and tahun='$tahun' and id_pegawai='$id_pegawai'"));
			if ($cek_ada==1) {
				echo "Sudah Ada Kategori yang sama";
			}else{
				$input = mysql_query("INSERT into kategori (bulan,tahun,id_pegawai) values ('$bulan','$tahun','$id_pegawai')");
				if ($input) {
					echo "Berhasil Ditambahkan";
				}else{
					echo mysql_error();
				}
			}

	}elseif ($op=="lihat-jab") {
		
?>
	<script type="text/javascript">
        $(function () {
          $('#tb_jab').DataTable({
            
          });
        });
      </script>
<?php
		echo"<table id='tb_jab' class='table table-bordered table-hover '>
	      <thead>
	        <tr >
	          <th>Kategori</th>
	          <th style='width:20%;'>Aksi</th>
	        </tr>
	      </thead>
	      <tbody>";
	      $i=1;
	      $select = mysql_query("SELECT * from kategori where id_pegawai='".$_SESSION['id_pengguna']."'");
	      while ($data = mysql_fetch_array($select)) {
	      		$cek_data = mysql_num_rows(mysql_query("SELECT * from laporan where id_kategori='".$data['id_kategori']."'"));
		echo"<tr>
		          <td>".nm_bulan($data['bulan']).", ".$data['tahun']."</td>
		          <td>
		          	<a title='Input' href='Isi-Laporan".$data['id_kategori']."' ><span class='fa fa-book' style='color:blue;'> </span></a> &nbsp;
		          	<a title='Hapus' href='javascript:void(0);' onclick='hapus(\"".$data['id_kategori']."\");'><span class='fa fa-trash' style='color:red;'> </span></a> &nbsp;";
		          	if ($cek_data >= 1) {
		          		# code...
			          	echo"<a title='Print' target='_blank' href='karyawan/cetak/print_laporan.php?id_kategori=".$data['id_kategori']."' ><span class='fa fa-print' style='color:green;'> </span></a> ";
		          	}
		          echo"</td>
		     </tr>";
		     $i++;
		      }
		 echo"       
		 </tbody>
    	</table>";
	}elseif ($op=="hapus") {
		$id = $_GET['id'];
		$hapus = mysql_query("DELETE from kategori WHERE id_kategori='$id'");
		if ($hapus) {
			echo "Berhasil Hapus";
		}else{
			echo mysql_error();
		}
	}elseif ($op="load_jab_edit") {
		$id = $_GET['id'];
		$query_data = mysql_fetch_array(mysql_query("SELECT * FROM kategori WHERE id_kategori = '".$id."'"));
	
		$array = array(
			"jab" => $query_data['jab'],
			"id_jab" => $query_data['id_jab']
			);
		
		echo json_encode($array);
	}
?>