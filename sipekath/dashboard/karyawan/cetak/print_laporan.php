<!DOCTYPE html>
<html>
<head>
    <style type="text/css" media="print">
        @page {
            size:auto;
            margin:0;
        }
    </style>
	<?php
		include "../../../fungsi/generate.php"; 
		$id_kategori = $_GET['id_kategori']; 
		$data_kat = mysql_fetch_assoc(mysql_query("SELECT * from kategori as a, pegawai as b, instansi as c, atasan as d where a.id_kategori='$id_kategori' and a.id_pegawai=b.id_pegawai and b.id_instansi=c.id_instansi and b.id_pegawai=d.bawahan"));
	?>
	<title>Print Laporan Bulan <?php echo nm_bulan($data_kat['bulan']); ?></title>
</head>
<body style="font-family: serif; " onload='window.print();'>
	  <table style='width:100%;' >
                    <tr>
                        <td><?php echo "<center><img src='../../../img/kemenkes.png' width='90px' ></center>"; ?></td>
                        <td align='center'>
                            <b><FONT style='font-size:15px;'>LAPORAN PENCAPAIAN KINERJA TENAGA KONTRAK</FONT><br/>
                            <FONT style='font-size:15px;'><?php echo $data_kat['instansi']; ?></FONT><br />
                            <FONT style='font-size:15px;'>BULAN : <?php echo strtoupper(nm_bulan($data_kat['bulan']))." ".$data_kat['tahun']; ?></FONT></b>
                        </td>
                        <td><?php echo "<center><img src='../../../img/logo.png' width='90px' ></center>"; ?></td>
                    </tr>
                </table><hr /><br />

        <table style='font-size:12px;'>
        	<tr>
        		<td>Nama</td>
        		<td>:</td>
        		<td><?php echo $data_kat['nama']; ?></td>
        	</tr>
        	<tr>
        		<td>Jabatan</td>
        		<td>:</td>
        		<td><?php echo $data_kat['jabatan']; ?></td>
        	</tr>
        	<tr>
        		<td>Unit Kerja</td>
        		<td>:</td>
        		<td><?php echo $data_kat['unit']; ?></td>
        	</tr>
        </table><br />
	<?php

		echo"<table id='tb_isilaporan' border='1' width='100%' style='border-collapse:collapse;font-size:12px;'>
	      <thead>
	        <tr height='45px'>
	          <th><center>Tanggal</center></th>
	          <th><center>Uraian Kerja</center></th>
	          <th><center>Waktu <br />(Menit)</center></th>
	          <th><center>Capaian</center></th>
	        </tr>
	      </thead>
	      <tbody>";
	      $i=1;
	      $cek_jml_tgl = mysql_num_rows(mysql_query("SELECT DISTINCT(tgl_keg) from laporan where id_kategori='".$_GET['id_kategori']."'"));
	      $tot_kes = mysql_fetch_assoc(mysql_query("SELECT SUM(persentase) as tot_persentase, SUM(waktu) as tot_waktu from laporan where id_kategori='".$_GET['id_kategori']."'"));
	      $select = mysql_query("SELECT DISTINCT(tgl_keg) from laporan where id_kategori='".$_GET['id_kategori']."' order by tgl_keg");
	      while ($data = mysql_fetch_array($select)) {
	      	$query_keg = mysql_query("SELECT * from laporan where id_kategori='".$_GET['id_kategori']."' and tgl_keg='".$data['tgl_keg']."'");
	      	$jml_rospan = mysql_num_rows($query_keg);
	      	$query_tot_hari = mysql_query("SELECT SUM(a.waktu) as h_waktu, SUM(a.persentase) as h_persentase from laporan as a where a.id_kategori='".$_GET['id_kategori']."' and a.tgl_keg='".$data['tgl_keg']."'");
	      	$dataperhari = mysql_fetch_assoc($query_tot_hari);
		echo"<tr height='30px'>
		          <td width='18%' rowspan='$jml_rospan' style='padding-left:10px;'><center>".namahari($data['tgl_keg'])."<br />".set_tanggal($data['tgl_keg'])."</center></td>";
		          	while ($data_keg = mysql_fetch_assoc($query_keg)) {
			          echo"<td style='padding-left:10px;'>".$data_keg['nm_keg']."</td>
			          <td align='middle'>".$data_keg['waktu']."</td>
			          <td align='middle'>".round($data_keg['persentase'],1)." %</td></tr>";
		          	}
		     echo"</tr>";
		echo"<tr height='30px'>
	    		<td align='middle' colspan='2'><b>Jumlah</b></td>
	    		<td align='middle'><b>".round($dataperhari['h_waktu'],1)."</b></td>
	    		<td align='middle'><b>".round($dataperhari['h_persentase'],1)." %</b></td>
		     </tr>";
		     $i++;
		      }
		echo "<tr height='30px'>
				<td valign='middle' colspan='2' rowspan='2'><center><b>Total Keseluruhan</b></center></td>
				<td align='middle'><b>".$tot_kes['tot_waktu']."</b></td>
				<td align='middle'><b>".round($tot_kes['tot_persentase'],1)."</b></td>
			</tr>";
		echo "<tr height='40px'>
			<td colspan='2' align='middle'><b>".round($tot_kes['tot_persentase']/$cek_jml_tgl,1)." %</b></td>
		</tr>";
		 echo"       
		 </tbody>
    	</table>";
    	$data_pimpinan = mysql_fetch_assoc(mysql_query("SELECT * from pegawai where id_pegawai='".$data_kat['atasan']."'"));

    	if (empty($_GET["margin"])) {
    		$data_margin = 0;
    	}else{
    		$data_margin = $_GET["margin"];
    	}
    	$mtd = $data_margin."px";


    	if (empty($data_kat['nip'])) {
    		$nip_pelaksana = "";
    	}else{
    		$nip_pelaksana = "NIP.".$data_kat['nip'];
    	}
    echo "<BR /><table width='100%' style='font-size:12px;margin-top: $mtd'>";
    ?>

        <tr>
          <td width="50%" align='center'>
            MENGETAHUI<br />
            ATASAN LANGSUNG<br />
            &nbsp;<p>&nbsp;</p>
            <U><?php echo $data_pimpinan['nama']; ?></U><br />NIP. <?php echo $data_pimpinan['nip']; ?>
          </td>
          <td width="50%" align='center'>
           PELAKSANA<br />
            <br />
            &nbsp;<p>&nbsp;</p>
            <U><?php echo $data_kat['nama']; ?></U><br /><?php echo $nip_pelaksana; ?>
            
          </td>
        </tr>
      </table>
</body>
</html>