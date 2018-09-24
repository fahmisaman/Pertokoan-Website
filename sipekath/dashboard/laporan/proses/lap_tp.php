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
			          <th>Komoditas</th>
			          <th>Produktivitas</th>
			          <th>Produksi</th>
			          <th>Luas Tanam</th>
			          <th>Luas Panen</th>
			          <th>Tahun, Bulan</th>
			        </tr>
			      </thead>
			      <tbody>";
			      $i=1;
			      if (empty($_GET['komoditas']) && empty($_GET['kecamatan']) && empty($_GET['tahun']) && empty($_GET['bulan'])) {
			      	# code...
				    $qb = mysql_query("SELECT * from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec");
				    $all_s = mysql_fetch_assoc(mysql_query("SELECT SUM(a.produktivitas) as sps,SUM(a.produksi) as spi,SUM(b.luas_tanam) as slt,SUM(b.luas_panen) as slp from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec"));
			      }elseif (empty($_GET['komoditas']) && empty($_GET['tahun']) && empty($_GET['bulan'])) {
			      	$qb = mysql_query("SELECT * from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec and b.id_kec='".$_GET['kecamatan']."'");
			      	$all_s = mysql_fetch_assoc(mysql_query("SELECT SUM(a.produktivitas) as sps,SUM(a.produksi) as spi,SUM(b.luas_tanam) as slt,SUM(b.luas_panen) as slp from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec and b.id_kec='".$_GET['kecamatan']."'"));
			      }elseif (empty($_GET['kecamatan']) && empty($_GET['tahun']) && empty($_GET['bulan'])) {
			      	$qb = mysql_query("SELECT * from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec and a.id_mk='".$_GET['komoditas']."'");
			      	$all_s = mysql_fetch_assoc(mysql_query("SELECT SUM(a.produktivitas) as sps,SUM(a.produksi) as spi,SUM(b.luas_tanam) as slt,SUM(b.luas_panen) as slp from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec and a.id_mk='".$_GET['komoditas']."'"));
			      }elseif (empty($_GET['tahun']) && empty($_GET['bulan'])) {
			      	$qb = mysql_query("SELECT * from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec and a.id_mk='".$_GET['komoditas']."' and b.id_kec='".$_GET['kecamatan']."'");
			      	$all_s = mysql_fetch_assoc(mysql_query("SELECT SUM(a.produktivitas) as sps,SUM(a.produksi) as spi,SUM(b.luas_tanam) as slt,SUM(b.luas_panen) as slp from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec and a.id_mk='".$_GET['komoditas']."' and b.id_kec='".$_GET['kecamatan']."'"));
			      }elseif (empty($_GET['bulan'])) {
			      	$qb = mysql_query("SELECT * from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec and a.id_mk='".$_GET['komoditas']."' and b.id_kec='".$_GET['kecamatan']."' and b.tahun='".$_GET['tahun']."'");
			      	$all_s = mysql_fetch_assoc(mysql_query("SELECT SUM(a.produktivitas) as sps,SUM(a.produksi) as spi,SUM(b.luas_tanam) as slt,SUM(b.luas_panen) as slp from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec and a.id_mk='".$_GET['komoditas']."' and b.id_kec='".$_GET['kecamatan']."' and b.tahun='".$_GET['tahun']."'"));
			      }else{
			      	$qb = mysql_query("SELECT * from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec and a.id_mk='".$_GET['komoditas']."' and b.id_kec='".$_GET['kecamatan']."' and b.tahun='".$_GET['tahun']."' and b.bulan='".$_GET['bulan']."'");
			      	$all_s = mysql_fetch_assoc(mysql_query("SELECT SUM(a.produktivitas) as sps,SUM(a.produksi) as spi,SUM(b.luas_tanam) as slt,SUM(b.luas_panen) as slp from pengelola_komoditas as a, tanaman_pangan as b, master_komoditas as c, kecamatan as d where a.id_kl=b.id_kl and a.id_mk=c.id_mk and c.id_jk='jenis-001' and b.id_kec=d.id_kec and a.id_mk='".$_GET['komoditas']."' and b.id_kec='".$_GET['kecamatan']."' and b.tahun='".$_GET['tahun']."' and b.bulan='".$_GET['bulan']."'"));
			      }
			      while ($data = mysql_fetch_array($qb)) {
			      	
				echo"<tr>
				          <td>$i</td>
				          <td>".$data['komoditas']."<br/>".$data['kec']."</td>
				          <td>".$data['produktivitas']."</td>
				          <td>".$data['produksi']."</td>
				          <td>".$data['luas_tanam']."</td>
				          <td>".$data['luas_panen']."</td>
				          <td>".$data['tahun'].", ".nm_bulan($data['bulan'])."</td>   
				     </tr>";
				     $i++;
				      }
				 echo"
				 <tr>
				 		<td colspan='2' align='right'><b>Total</b></td>
				 		<td>".$all_s['sps']."</td>
				 		<td>".$all_s['spi']."</td>
				 		<td>".$all_s['slt']."</td>
				 		<td>".$all_s['slp']."</td>
				 		<td></td>
				 	  </tr>    
				 </tbody>
		    	</table>";
	}
?>