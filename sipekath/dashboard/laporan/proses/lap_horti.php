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
			 if (empty($_GET['komoditas']) && empty($_GET['tahun'])) {
			      	# code...
			    $qb = mysql_query("SELECT * from pengelola_komoditas as a, hortikultura as b, master_komoditas as c, tm_poktan as d, tm_gapoktan as e, desa as f, kecamatan as g where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-002' and a.id_poktan=d.id_tmp and d.id_tmg=e.id_tmg and e.id_desa=f.id_desa and f.id_kec=g.id_kec");
			    $all_s = mysql_fetch_assoc(mysql_query("SELECT SUM(a.produktivitas) as sps,SUM(a.produksi) as spi,SUM(b.luas_lahan) as sll from pengelola_komoditas as a, hortikultura as b, master_komoditas as c where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-002'"));
		      }elseif (empty($_GET['tahun'])) {
		      	$qb = mysql_query("SELECT * from pengelola_komoditas as a, hortikultura as b, master_komoditas as c, tm_poktan as d, tm_gapoktan as e, desa as f, kecamatan as g where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-002' and a.id_poktan=d.id_tmp and d.id_tmg=e.id_tmg and e.id_desa=f.id_desa and f.id_kec=g.id_kec and a.id_mk='".$_GET['komoditas']."'");
		      	$all_s = mysql_fetch_assoc(mysql_query("SELECT SUM(a.produktivitas) as sps,SUM(a.produksi) as spi,SUM(b.luas_lahan) as sll from pengelola_komoditas as a, hortikultura as b, master_komoditas as c where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-002' and a.id_mk='".$_GET['komoditas']."'"));
		      }elseif (empty($_GET['komoditas'])) {
		      	$qb = mysql_query("SELECT * from pengelola_komoditas as a, hortikultura as b, master_komoditas as c, tm_poktan as d, tm_gapoktan as e, desa as f, kecamatan as g where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-002' and a.id_poktan=d.id_tmp and d.id_tmg=e.id_tmg and e.id_desa=f.id_desa and f.id_kec=g.id_kec and b.tahun='".$_GET['tahun']."'");
		      	$all_s = mysql_fetch_assoc(mysql_query("SELECT SUM(a.produktivitas) as sps,SUM(a.produksi) as spi,SUM(b.luas_lahan) as sll from pengelola_komoditas as a, hortikultura as b, master_komoditas as c where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-002' and b.tahun='".$_GET['tahun']."'"));
		      }else{
		      	$qb = mysql_query("SELECT * from pengelola_komoditas as a, hortikultura as b, master_komoditas as c, tm_poktan as d, tm_gapoktan as e, desa as f, kecamatan as g where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-002' and a.id_poktan=d.id_tmp and d.id_tmg=e.id_tmg and e.id_desa=f.id_desa and f.id_kec=g.id_kec and a.id_mk='".$_GET['komoditas']."' and b.tahun='".$_GET['tahun']."'");
		      	$all_s = mysql_fetch_assoc(mysql_query("SELECT SUM(a.produktivitas) as sps,SUM(a.produksi) as spi,SUM(b.luas_lahan) as sll from pengelola_komoditas as a, hortikultura as b, master_komoditas as c where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-002' and a.id_mk='".$_GET['komoditas']."' and b.tahun='".$_GET['tahun']."'"));
		      }
		echo"<a href='karyawan\cetak\ekspor_horti.php' class='btn btn-info' target='_blank'>Cetak</a> <br /><p>&nbsp;</p>";	      
		echo"<table id='hbrg' class='table table-bordered table-hover '>
			      <thead>
			        <tr >
			          <th>No</th>
			          <th>Poktan</th>
			          <th>Komoditas</th>
			          <th>Produktivitas</th>
			          <th>Produksi</th>
			          <th>Luas Lahan</th>
			          <th>Tahun</th>
			          <th>Lokasi</th>
			        </tr>
			      </thead>
			      <tbody>";
			      $i=1;
			     
			      while ($data = mysql_fetch_array($qb)) {
			      	
				echo"<tr>
				          <td>$i</td>
				          <td>".$data['tmp']."</td>
				          <td>".$data['komoditas']."</td>
				          <td>".$data['produktivitas']."</td>
				          <td>".$data['produksi']."</td>
				          <td>".$data['luas_lahan']."</td>
				          <td>".$data['tahun']."</td>
				          <td>".$data['desa'].", ".$data['kec']."</td>   
				     </tr>";
				     $i++;
				      }
				 // echo"
				 // <tr>
				 // 		<td colspan='3' align='right'><b>Total</b></td>
				 // 		<td>".$all_s['sps']."</td>
				 // 		<td>".$all_s['spi']."</td>
				 // 		<td>".$all_s['sll']."</td>
				 // 		<td></td>
				 // 		<td></td>
				 // 	  </tr>";    
				 echo"</tbody>
		    	</table>";
	}
?>