<?php 
	include "../../../fungsi/conn.php";
	include "../../../fungsi/generate.php";
	$op = $_GET['op'];
	// error_reporting(0); //ini b kse ilang error bagi yg belum tau
	session_start();

if ($op=="data_tampil_user") {
		?>
		
			<script type="text/javascript">
				$(function () {
				  $('#tb_stok1').DataTable({
				    
				  });
				});
			</script>

		<?php
		echo"<table id='tb_stok1' class='table table-bordered table-hover '>
			      <thead>
			        <tr >
			          <th>No</th>
			          <th>Nama</th>
			          <th>NIP</th>
			          <th>Instansi</th>
			          <th>Jabatan</th>
			        </tr>
			      </thead>
			      <tbody>";
			      $i=1;
			      // $cek_user = mysql_fetch_assoc(mysql_query("SELECT * from user where id_user='".$_SESSION['id_user']."'"));
			      $qb = mysql_query("SELECT * from pegawai as a, instansi as b where a.id_instansi=b.id_instansi ");
			      while ($data = mysql_fetch_array($qb)) {
				echo"<tr>
						  <td>$i</td>
				          <td>".$data['nama']."</td>
				          <td>".$data['nip']."</td>
				          <td>".$data['instansi']."</td>
				          <td>".$data['jabatan']."</td>";
				     echo"</tr>";
				     $i++;
				      }
				 echo"       
				 </tbody>
		    	</table>";
	}elseif ($op=="hapus") {
		$id = $_GET['id'];
		$hapus = mysql_query("DELETE from pegawai WHERE id_pegawai='$id'");
		if ($hapus) {
			echo "Berhasil Hapus";
		}else{
			echo mysql_error();
		}
	}elseif ($op=="input_form") {
		// print_r($_GET);
		$nama = $_GET['nama'];
		$jabatan = $_GET['jabatan'];
		$unit = $_GET['unit'];
		$nip= $_GET['nip'];
		$instansi = $_GET['instansi'];
		$username = $_GET['username'];
		$kon_pass = $_GET['kon_pass'];
			$in_user = mysql_query("INSERT into pegawai (id_instansi,nip,username,password,nama,jabatan,unit,status_pegawai) values ('$instansi','$nip','$username','$kon_pass','$nama','$jabatan','$unit','Y')");

				if ($in_user) {
					echo "Berhasil Simpan Pengguna";
				}else{
					echo mysql_error();
				}
		
	}elseif ($op=="load_desa") {
		$id = $_GET['id_kec'];
		$query = mysql_query("SELECT * FROM desa where id_kec='$id'");
		  echo "<option value=''>-- Pilih Desa --</option>";
          while ($data = mysql_fetch_array($query)) {
            echo "<option value='".$data['id_desa']."'>".$data['desa']."</option>";
        }
	}
?>