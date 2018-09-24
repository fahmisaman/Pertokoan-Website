<?php
	setHeader("Laporan Tanaman Pangan","fa fa-file");
?>

<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Pencarian</h3>

      <div class=" pull-right">
        <!-- <a type="button" class="btn btn-info" href="javascript:void(0);" id="login" data-toggle="modal" data-target="#mycity">Barang</a>
        <a type="button" class="btn btn-warning" href="javascript:void(0);" id="cek_" data-toggle="modal" data-target="#cek_brg">Pelayanan</a> -->
        <!-- <input type="submit" class="btn btn-primary" value="Kirim"> -->
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="display: block;">

      <form class="form-horizontal" method="POST" name="form_input" action="">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-lg-12">
                <label class="control-label" for="inputDefault">Komoditas</label>
                 <select class="form-control" id="komoditas" name="komoditas">
                  <option value="">-- Pilih Komoditas --</option>
                  <?php
                    $query = mysql_query("SELECT * FROM master_komoditas where id_jk='jenis-001'");
                    while ($data = mysql_fetch_array($query)) {
                      echo "<option value='".$data['id_mk']."'>".$data['komoditas']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-12">
                <label class="control-label" for="inputDefault">Kecamatan</label>
                 <select class="form-control" id="kecamatan" name="kecamatan">
                  <option value="">-- Pilih Kecamatan --</option>
                  <?php
                    $query = mysql_query("SELECT * FROM kecamatan");
                    while ($data = mysql_fetch_array($query)) {
                      echo "<option value='".$data['id_kec']."'>".$data['kec']."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="inputDefault">Tahun</label>
                   <select class="form-control" id="tahun" name="tahun">
                    <option value="">-- Pilih Tahun --</option>
                    <?php
                      $query = mysql_query("SELECT DISTINCT(tahun) from pengelola_komoditas as a, tanaman_pangan as b where a.id_kl=b.id_kl");
                      while ($data = mysql_fetch_array($query)) {
                        echo "<option value='".$data['tahun']."'>".$data['tahun']."</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="inputDefault">Bulan</label>
                   <select class="form-control" id="bulan" name="bulan">
                    <option value="">-- Pilih Bulan --</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                  </select>
                </div>
              </div>
          </div>
          
        </div>

        <div class="form-group">
  	        <div class="col-lg-12"><input type="button" class="btn btn-primary" id="btn-daftar" onclick="javascript:cari();" value="Cari" /></div>
  	    </div>

      </form>

    </div>
</div>

<div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>

      <div class=" pull-right">
        <!-- <a type="button" class="btn btn-info" href="javascript:void(0);" id="login" data-toggle="modal" data-target="#mycity">Barang</a>
        <a type="button" class="btn btn-warning" href="javascript:void(0);" id="cek_" data-toggle="modal" data-target="#cek_brg">Pelayanan</a> -->
        <!-- <input type="submit" class="btn btn-primary" value="Kirim"> -->
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="display: block;">
      
    	<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tab_1" data-toggle="tab">Hasil Pencarian</a></li>
			 
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tab_1">
			  	<div style="background: white; max-height: 400px; overflow: auto; padding: 10px; white-space: nowrap;">
				    <b></b>
				    <div id="cari"></div>
			    </div>
			  </div>
			 
			  </div>
			  <!-- /.tab-pane -->
			</div>
			<!-- /.tab-content -->
		</div>

    </div>
    <!-- /.box-body -->
  </div>



<script type="text/javascript">
	$(document).ready(function(){
		// alert("ok");
		cari();
	});


	function cari(){
    // alert("ok");
  var komoditas = $("#komoditas").val();
  var kecamatan = $("#kecamatan").val();
  var bulan = $("#bulan").val();
	var tahun = $("#tahun").val();
		// alert(tgl2);
	  	$("#cari").load("<?php echo $proses; ?>","op=cari&komoditas="+komoditas+"&kecamatan="+kecamatan+"&bulan="+bulan+"&tahun="+tahun);
	}

	// $('#datepicker').datepicker({
 //      autoclose: true,
 //      format: 'yyyy-mm-dd'
 //    });
	
 //  $('#tgl2').datepicker({
 //      autoclose: true,
 //      format: 'yyyy-mm-dd'
 //    }); 
</script>
</div>
