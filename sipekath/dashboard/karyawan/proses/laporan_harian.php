<?php
	include "../../../fungsi/conn.php";
	include "../../../fungsi/generate.php";
	session_start();
	if (!isset($_SESSION['id_pengguna'])) {
    // echo header("location:http://localhost/medical/");
	    echo"<script language=javascript>
	      alert('Maaf, Mohon Login Terlebih Dahulu');
	      location.href='http://datacenter.poltekkesgorontalo.ac.id/sipekath/';
	    </script>";
	}else{
		$op = $_GET['op'];
		if ($op=="input_form") {
			// print_r($_GET);
			$tgl = $_GET['tgl'];
			$kegiatan = $_GET['kegiatan'];
			$id_kategori = $_GET['id_kategori'];
			$waktu = $_GET['waktu'];
			$id_laporan = $_GET['id_laporan'];

			$cek_kategori = mysql_fetch_assoc(mysql_query("SELECT * from kategori where id_kategori='$id_kategori'"));
			if ($cek_kategori['bulan']==set_cek_kat($tgl)) {
				$cari_capaian = mysql_fetch_assoc(mysql_query("SELECT * from pegawai as a, capaian as b where a.id_instansi=b.id_instansi and a.id_pegawai='".$_SESSION['id_pengguna']."'"));
				$persentase = $waktu/$cari_capaian['capaian']*100;

				$cek = mysql_num_rows(mysql_query("SELECT * from laporan where id_laporan='$id_laporan' "));
				if ($cek==1) {
					$update = mysql_query("UPDATE laporan set nm_keg='$kegiatan', tgl_keg='$tgl', waktu='$waktu', persentase='$persentase' where id_laporan='$id_laporan'");
					
					if ($update) {
						echo "Diperbaharui";
					}else{
						echo mysql_error();
					}
				}else{
					$input = mysql_query("INSERT into laporan (id_kategori,nm_keg,tgl_keg,waktu,persentase) values ('$id_kategori','$kegiatan','$tgl','$waktu','$persentase')");
					
					if ($input) {
						echo "Diinput";
					}else{
						echo mysql_error();
					}
				}
			}else{
				echo "Pengisian Tidak Sesuai Bulan Kategori";
			}
			
		}elseif($op=="load_tb_isi") {
			?>
			
				<!-- <script type="text/javascript">
					$(function () {
					  $('#tb_isilaporan').DataTable({
					    
					  });
					});
				</script> -->

			<?php
			echo"<a title='Print' class='pull-right btn btn-warning btn-sm' target='_blank' href='karyawan/cetak/print_laporan.php?id_kategori=".$_GET['id_kategori']."' ><span class='fa fa-print' > </span> Cetak Laporan</a><br />&nbsp;"; 
			echo"<table id='tb_isilaporan' border='1' width='100%' >
		      <thead>
		        <tr height='45px'>
		          <th><center>Tanggal</center></th>
		          <th><center>Uraian Kerja</center></th>
		          <th><center>Waktu <br />(Menit)</center></th>
		          <th><center>Capaian</center></th>
		          <th><center>Aksi</center></th>
		        </tr>
		      </thead>
		      <tbody>";
		      $i=1;
		      $cek_jml_tgl = mysql_num_rows(mysql_query("SELECT DISTINCT(tgl_keg) from laporan where id_kategori='".$_GET['id_kategori']."'"));
		      $tot_kes = mysql_fetch_assoc(mysql_query("SELECT SUM(persentase) as tot_persentase, SUM(waktu) as tot_waktu from laporan where id_kategori='".$_GET['id_kategori']."'"));
		      $select = mysql_query("SELECT DISTINCT(tgl_keg) from laporan where id_kategori='".$_GET['id_kategori']."' order by tgl_keg");
		      while ($data = mysql_fetch_array($select)) {
		      	$query_keg = mysql_query("SELECT * from laporan where id_kategori='".$_GET['id_kategori']."' and tgl_keg='".$data['tgl_keg']."'");
		      	$query_tot_hari = mysql_query("SELECT SUM(a.waktu) as h_waktu, SUM(a.persentase) as h_persentase from laporan as a where a.id_kategori='".$_GET['id_kategori']."' and a.tgl_keg='".$data['tgl_keg']."'");
		      	$dataperhari = mysql_fetch_assoc($query_tot_hari);
		      	$jml_rospan = mysql_num_rows($query_keg);
			echo"<tr height='30px'>
			          <td rowspan='$jml_rospan' style='padding-left:10px;'><center>".namahari($data['tgl_keg']).",<br />".set_tanggal($data['tgl_keg'])."</center></td>";
			          	while ($data_keg = mysql_fetch_assoc($query_keg)) {
				          echo"<td style='padding-left:10px;'>".$data_keg['nm_keg']."</td>
				          <td align='middle'>".$data_keg['waktu']."</td>
				          <td align='middle'>".round($data_keg['persentase'],1)." %</td>
				          <td>
				          	&nbsp;&nbsp;<a style='cursor:pointer;' href='javascript:void(0);' onclick='edit(\"".$data_keg['id_laporan']."\");'><span style='color:blue;' class='fa  fa-pencil-square-o'> Edit</a> &nbsp;
				          	<a href='javascript:void(0);' onclick='hapus(\"".$data_keg['id_laporan']."\",\"".$data_keg['nm_keg']."\");'><span class='fa fa-trash' style='color:red;'> Hapus</span></a>
				          </td></tr>";
			          	}
			     echo"</tr>";
		    echo"<tr height='30px'>
		    		<td align='middle' colspan='2'><b>Jumlah</b></td>
		    		<td align='middle'><b>".round($dataperhari['h_waktu'],1)."</b></td>
		    		<td align='middle'><b>".round($dataperhari['h_persentase'],1)." %</b></td>
		    		<td></td>
			     </tr>";
			     $i++;
			      }
			echo "<tr height='40px'>
					<td valign='middle' colspan='2' rowspan='2'><center><b>Total Keseluruhan</b></center></td>
					<td align='middle'><b>".$tot_kes['tot_waktu']."</b></td>
					<td align='middle'><b>".round($tot_kes['tot_persentase'],1)."</b></td>
					<td></td>
				</tr>";
			echo "<tr height='40px'>
				<td colspan='2' align='middle'><b>";if(isset($tot_kes['tot_persentase'])){echo round($tot_kes['tot_persentase']/$cek_jml_tgl,1);}echo" %</b></td>
				<td></td>
			</tr>";
			 echo"       
			 </tbody>
	    	</table>";
		}elseif($op=="load_tb_isi_yang_lama") {
			?>
			
				<!-- <script type="text/javascript">
					$(function () {
					  $('#tb_isilaporan').DataTable({
					    
					  });
					});
				</script> -->

			<?php
			echo"<table id='tb_isilaporan' border='1' width='100%' >
		      <thead>
		        <tr height='45px'>
		          <th><center>Tanggal</center></th>
		          <th><center>Uraian Kerja</center></th>
		          <th><center>Waktu <br />(Menit)</center></th>
		          <th><center>Capaian</center></th>
		          <th><center>Aksi</center></th>
		        </tr>
		      </thead>
		      <tbody>";
		      $i=1;
		      $cek_jml_tgl = mysql_num_rows(mysql_query("SELECT DISTINCT(tgl_keg) from laporan where id_kategori='".$_GET['id_kategori']."'"));
		      $tot_kes = mysql_fetch_assoc(mysql_query("SELECT SUM(persentase) as tot_persentase, SUM(waktu) as tot_waktu from laporan where id_kategori='".$_GET['id_kategori']."'"));
		      $select = mysql_query("SELECT * from laporan where id_kategori='".$_GET['id_kategori']."' order by tgl_keg");
		      while ($data = mysql_fetch_array($select)) {
		      
			echo"<tr height='30px'>
			          <td style='padding-left:10px;'>".$data['tgl_keg']."</td>
			          <td style='padding-left:10px;'>".$data['nm_keg']."</td>
			          <td align='middle'>".$data['waktu']."</td>
			          <td align='middle'>".round($data['persentase'],1)." %</td>
			          <td>
			          	&nbsp;&nbsp;<a style='cursor:pointer;' href='javascript:void(0);' onclick='edit(\"".$data['id_laporan']."\");'><span style='color:blue;' class='fa  fa-pencil-square-o'> Edit</a> &nbsp;
			          	<a href='javascript:void(0);' onclick='hapus(\"".$data['id_laporan']."\",\"".$data['nm_keg']."\");'><span class='fa fa-trash' style='color:red;'> Hapus</span></a>
			          </td>
			     </tr>";
			     $i++;
			      }
			echo "<tr height='40px'>
					<td valign='middle' colspan='2' rowspan='2'><center><b>Total Keseluruhan</b></center></td>
					<td align='middle'><b>".$tot_kes['tot_waktu']."</b></td>
					<td align='middle'><b>".round($tot_kes['tot_persentase'],1)."</b></td>
					<td></td>
				</tr>";
			echo "<tr height='40px'>
				<td colspan='2' align='middle'><b>".round($tot_kes['tot_persentase']/$cek_jml_tgl,1)." %</b></td>
				<td></td>
			</tr>";
			 echo"       
			 </tbody>
	    	</table>";
		}elseif ($op=="hapus") {
			$id = $_GET['id'];
			$hapus = mysql_query("DELETE from laporan WHERE id_laporan='$id'");
			if ($hapus) {
				echo "Berhasil Hapus";
			}else{
				echo mysql_error();
			}
		}elseif ($op=="load_lap_edit") {
			$id = $_GET['id'];
			$query_data = mysql_fetch_array(mysql_query("SELECT * FROM laporan WHERE id_laporan = '".$id."'"));
			
			$array = array(
				"nm_keg" => $query_data['nm_keg'],
				"tgl_keg" => $query_data['tgl_keg'],
				"waktu" => $query_data['waktu'],
				"id_laporan" => $query_data['id_laporan']
				);
			
			echo json_encode($array);
		}
	}
	
?>