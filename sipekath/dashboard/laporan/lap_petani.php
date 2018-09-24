<?php
	setHeader("Laporan Petani","fa fa-file");
?>

<!-- <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Pencarian</h3>

      <div class=" pull-right">
      </div>
    </div>
    <div class="box-body" style="display: block;">

      <form class="form-horizontal" method="POST" name="form_input" action="">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="inputDefault">Gapoktan</label>
                   <select class="form-control" id="gapoktan" name="gapoktan" required="" onchange="javascript:ganti_poktan(this.value);">
                    <option value="">-- Pilih Gapoktan --</option>
                    <?php
                      $query = mysql_query("SELECT * from tm_gapoktan");
                      while ($data = mysql_fetch_array($query)) {
                        echo "<option value='".$data['id_tmg']."'>".$data['tmg']."</option>";
                      }
                    ?>
                  </select>
                </div>
            </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="inputDefault">Poktan</label>
                   <select class="form-control" id="poktan" name="poktan" >
                    <option value="">-- Pilih Gapoktan Terlebih Dahulu --</option>
                  
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
</div> -->

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
		// cari();
      $("#cari").load("<?php echo $proses; ?>","op=cari");
  });


 //  function cari(){
 //    // alert("ok");
 //  var gapoktan = $("#gapoktan").val();
 //  var poktan = $("#poktan").val();
 //    // alert(tgl2);
	  	// $("#cari").load("<?php echo $proses; ?>","op=cari&gapoktan="+gapoktan+"&poktan="+poktan);
  // }

 //  function ganti_poktan(id){
 //    $("#poktan").load("<?php echo $proses; ?>","op=ganti_poktan&id="+id);
 //  }
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
