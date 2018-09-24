<?php
	setHeader("Laporan Pasien","fa fa-file");
?>

<div class="well bs-component" id="edit">
	<form class="form-horizontal" method="POST" name="form_input" action="">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
		              <div class="col-lg-12">
		                <input type="number" required class="form-control" name="tahun" value="<?php echo date('Y'); ?>">
		                <!-- <select class="form-control" id="tahun" name="tahun">
				            <option value="">-- Pilih Tahun --</option>
				            <option value="2015">2015</option>
				            <option value="2016">2016</option>
				            <option value="2017">2017</option>
			            </select> -->	
		              </div>
		        </div>
			</div>
			<div class="col-md-6">
		        <div class="form-group">
		              <div class="col-lg-12">
		                 <select class="form-control" id="bulan" name="bulan" onchange="javascript:filter(this.value);">
				            <option value="">-- Pilih Bulan --</option>
				            <option value="1">Januari</option>
				            <option value="2">Februari</option>
				            <option value="3">Maret</option>
				            <option value="4">April</option>
				            <option value="5">Mei</option>
				            <option value="6">Juni</option>
				            <option value="7">Juli</option>
				            <option value="8">Agustus</option>
				            <option value="9">September</option>
				            <option value="10">Oktober</option>
				            <option value="11">November</option>
				            <option value="12">Desember</option>
				          </select>	
		              </div>
		        </div>			
			</div>
			<div class="col-md-6">
		        <div class="form-group">
		              <div class="col-lg-12">
		                 <select class="form-control" id="s7" name="s7" >
		                  <option value="">-- Pilih Keterangan --</option>
		                  <option value="G"> Periksa </option>
		                  <option value="L"> Dileewati </option>
		                </select>
		              </div>
		        </div>			
			</div>
			<div class="col-md-6">
		        <div class="form-group">
		              <div class="col-lg-12">
		                 <select class="form-control" id="dokter" name="dokter" required>
		                  <option value="">-- Pilih dokter --</option>
		                  <?php
		                  	$select = mysql_query("SELECT * from dokter");
		                  	while ($data_dokter=mysql_fetch_assoc($select)) {
		                  		echo "<option value='".$data_dokter['id_dokter']."'>".$data_dokter['nm_dokter']."</option>";
		                  	}
		                  ?>
		                </select>
		              </div>
		        </div>			
			</div>
			<div class="col-md-12">
				<button class="btn btn-block btn-flat btn-info" id="klik" name="klik">Lihat</button>
			</div>
		</div>
        
	</form>
          <?php
          	if (isset($_POST["klik"])) {
          		$s7 = $_POST["s7"];
          		$tahun = $_POST['tahun'];
          		$bulan = $_POST['bulan'];
          		$dokter = $_POST['dokter'];
          		if (empty($bulan) && empty($s7)) {
          			$select = mysql_query("SELECT proses,nama_pasien,alamat, id_dokter, no_hp,CONCAT(YEAR(tgl_antrian)) AS tahun_bulan FROM pasien where CONCAT(YEAR(tgl_antrian))='$tahun' and id_dokter='$dokter'");
          		}elseif (empty($s7)) {
          			$select = mysql_query("SELECT proses,nama_pasien,alamat,no_hp,id_dokter,CONCAT(YEAR(tgl_antrian),'/',MONTH(tgl_antrian)) AS tahun_bulan FROM pasien where CONCAT(YEAR(tgl_antrian),'/',MONTH(tgl_antrian)) ='$tahun/$bulan' and id_dokter='".$dokter."'");
          			
          		}else{
          			
	          		$select = mysql_query("SELECT proses,nama_pasien,alamat,no_hp,id_dokter,CONCAT(YEAR(tgl_antrian),'/',MONTH(tgl_antrian)) AS tahun_bulan FROM pasien where CONCAT(YEAR(tgl_antrian),'/',MONTH(tgl_antrian)) ='$tahun/$bulan' and proses='$s7' and id_dokter='".$dokter."'");
          		}
          	}else{
          		$tahun_ini = date("Y");
          		$select = mysql_query("SELECT proses,nama_pasien,alamat, no_hp,id_dokter,CONCAT(YEAR(tgl_antrian)) AS tahun_bulan FROM pasien where CONCAT(YEAR(tgl_antrian))='$tahun_ini'");
          	}
          	echo"<br /><table id='tb_inves' class='table table-bordered table-hover '>
		        <thead >
		          <tr align='center'>
		            <th width='50%'>Pasien</th>
		            <th width='50%'>Dokter</th>
		          </tr>
		        </thead>
		        <tbody>";
		        $i=1;
		        
		        while($data = mysql_fetch_array($select)) {
		        	$cek_dokter = mysql_fetch_assoc(mysql_query("SELECT * from dokter as a, jenis_dokter as b where a.id_jenis=b.id_jenis and a.id_dokter='".$data['id_dokter']."'"));
		        	$tgl = $data['tahun_bulan'];
		        	if ($data['proses'] == "G") {
		        		$ket = "<label class='label label-success'>Periksa</label>";
		        	}elseif ($data['proses'] == "M") {
		        		$ket = "<label class='label label-info'>Menunggu</label>";
		        	}elseif ($data['proses'] == "L") {
		        		$ket = "<label class='label label-warning'>Lewat</label>";
		        	}
		    echo"<tr>
		    			<td><b class='fa fa-user'> ".$data['nama_pasien']."</b><br /><i class='fa fa-map-pin'></i> ".$data['alamat']."<br /><i class='fa fa-phone'></i> ".$data['no_hp']."</td>
		    			<td><i class='fa fa-user-md'></i> ".$cek_dokter['nm_dokter']."<br /><i class='fa fa-heartbeat'></i> ".$cek_dokter['jenis']."<br /><i class='fa fa-search'></i> Filter : $tgl, $ket</td>";
		         echo"</tr>";
		         $i++;
		          }
		     echo"       
		     </tbody>
		      </table>";

          ?>
</div>
	

<script type="text/javascript">
	
 	$(function () {
	  $('#tb_inves').DataTable({
	    
	  });
	});

	$('#datepicker').datepicker({
	  format: "yyyy-mm-dd",
      autoclose: true
    });
</script>
</div>
