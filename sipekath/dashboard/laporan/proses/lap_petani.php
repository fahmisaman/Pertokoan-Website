<?php 
	include "../../../fungsi/conn.php";
	include "../../../fungsi/generate.php";
	$op = $_GET['op'];
	session_start();

	if ($op=="cari") {
		?>
		
			<script type="text/javascript">
				// $(function () {
				//   $('#hbrg').DataTable({
				    
				//   });
				// });
			</script>

		<?php
		echo"<table id='hbrg' class='table table-bordered table-hover '>
			      <thead>
			        <tr >
			          <th>No</th>
			          <th>Gapoktan</th>
			          <th>Poktan</th>
			          <th>Nama Petani</th>
			        </tr>
			      </thead>
			      <tbody>";
			      $i=1;
			      // if (empty($_GET['gapoktan']) && empty($_GET['poktan'])) {
			      	# code...
				    $qb = mysql_query("SELECT * from desa as a, kecamatan as b, petani as c where a.id_kec=b.id_kec and a.id_desa=c.id_desa");
				    
			      // }
			      while ($data = mysql_fetch_array($qb)) {
			      	$d_gap = mysql_fetch_assoc(mysql_query("SELECT * FROM gapoktan as a, tm_gapoktan as b where a.id_tmg=b.id_tmg and a.id_petani='".$data['id_petani']."'"));
			      	$d_pok = mysql_fetch_assoc(mysql_query("SELECT * FROM poktan as a, tm_poktan as b where a.id_tmp=b.id_tmp and a.id_petani='".$data['id_petani']."'"));
				echo"<tr>
				          <td>$i</td>
				          <td>".$d_gap['tmg']."</td>
				          <td>".$d_pok['tmp']."</td>
				          <td>".$data['nama_petani']."</td>
				     </tr>";
				     $i++;
				      }
				 echo"
				   
				 </tbody>
		    	</table>";
	}elseif ($op=="ganti_poktan") {
		$id = $_GET['id'];
		$query = mysql_query("SELECT * FROM tm_poktan where id_tmg='$id'");
		  echo "<option value=''>-- Pilih Poktan --</option>";
          while ($data = mysql_fetch_array($query)) {
            echo "<option value='".$data['id_tmp']."'>".$data['tmp']."</option>";
        }
	}
?>