<?php
	setHeader("Pengguna","fa fa-user-plus");
?>
<form class="form-horizontal" method="POST" name="form_input" action="javascript:input_form()">
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Tambah Pengguna</h3>
      <!-- /.box-tools -->
      <div class=" pull-right">
        <!-- <a type="button" class="btn btn-warning" href="javascript:void(0);" id="cek_" data-toggle="modal" data-target="#cek_brg">Pelayanan</a> -->
        <input type="submit" class="btn btn-primary" id="smpn" value="Simpan">
	  </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="display: block;">
	      <div class="row">
	      	<div class="col-md-6">
			    <div  class="form-group">
			        <div class="col-lg-12">
			          <label class=" control-label" for="inputDefault">Nama Lengkap (Beserta Title)</label>
			          <input class="form-control"  id="nama" name="nama" type="text" required>
			        </div>
			    </div>
			    <div class="form-group">
			        <div class="col-lg-12">
			          <label class="control-label" for="inputDefault">Instansi</label>
			           <select class="form-control" id="instansi" name="instansi" required>
			            <option value="">-- Pilih Instansi --</option>
			            <?php
			              $query = mysql_query("SELECT * FROM instansi");
			              while ($data = mysql_fetch_array($query)) {
			                echo "<option value='".$data['id_instansi']."'>".$data['instansi']."</option>";
			              }
			            ?>
			          </select>
		        	</div>
			    </div>
			    <div  class="form-group">
			        <div class="col-lg-12">
			          <label class=" control-label" for="inputDefault">NIP</label>
			          <input class="form-control"  id="nip" name="nip"  type="text" required>
			        </div>
			      </div>
			    <div  class="form-group">
			        <div class="col-lg-12">
			          <label class=" control-label" for="inputDefault">Jabatan</label>
			          <input class="form-control"  id="jabatan" name="jabatan"  type="text" required>
			        </div>
			      </div>
	      	</div>
	      	<div class="col-md-6">
	      		<div  class="form-group">
			        <div class="col-lg-12">
			          <label class=" control-label" for="inputDefault">Username</label>
			          <input class="form-control"  id="username" name="username" type="text" required>
			        </div>
			      </div>
			    <div class="form-group">
			        <div class="col-lg-12">
			          <label class=" control-label" for="inputDefault">Password</label>
			          <input class="form-control"  id="pass" name="pass"  type="password" required onkeyup="javascript:sama();">
			        </div>
			      </div>
			    <div  class="form-group">
			        <div class="col-lg-12">
			          <label class=" control-label" for="inputDefault">Ulangi Password</label>
			          <input class="form-control"  id="kon_pass" name="kon_pass"  type="password" required onkeyup="javascript:sama();">
			          <label class="label label-danger" id="slh_pass">Password Salah</label>
			        </div>
			      </div>
			     <div  class="form-group">
			        <div class="col-lg-12">
			          <label class=" control-label" for="inputDefault">Unit Kerja</label>
			          <input class="form-control"  id="unit" name="unit"  type="text" required>
			        </div>
			      </div>
	      	</div>
	      </div>
    </div>
    <!-- /.box-body -->
  </div>
</form>

<div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Data Pengguna</h3>

      <div class=" pull-right">
        <!-- <a type="button" class="btn btn-info" href="javascript:void(0);" id="login" data-toggle="modal" data-target="#mycity">Barang</a> -->
        <!-- <input type="submit" class="btn btn-primary" value="Kirim"> -->
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="display: block;">
      
			  	<div style="background: white; max-height: 400px; overflow: auto; padding: 10px; white-space: nowrap;">
				    <div id="data_tampil_user"></div>
			    </div>
    
			<!-- /.tab-content -->
	</div>

    </div>
    <!-- /.box-body -->
  </div>

<!-- Modal -->

<!-- akhir Modal -->

<script type="text/javascript">
	$(document).ready(function(){
		// alert("ok");
		lihat_all();
	});



	function lihat_all(){
	  	$("#data_tampil_user").load("<?php echo $proses; ?>","op=data_tampil_user");
	  	$('form[name="form_input"]')[0].reset();
	  	$("#slh_pass").hide();
	}

	function sama(){
		var pass = $("#pass").val();
		var kon_pass = $("#kon_pass").val();
		if (pass == kon_pass) {
			$("#smpn").removeAttr("disabled");
			$("#slh_pass").hide();
		}else{
			$("#smpn").attr("disabled","disabled");
			$("#slh_pass").show();
		}
	}
	function hapus(id,sparepart){
	  	swal({
		  title: "Anda Yakin Menghapus sparepartupaten "+sparepart+" ?",
		  text: "Data Yang Telah di Hapus Tidak Dapat Ditampilkan lagi!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#3C8DBC",
		  confirmButtonText: "Ya, Hapus!",
		  closeOnConfirm: false
		},
		function(){
	  		$.ajax({
	  			url:"<?php echo $proses; ?>",
		  		data:"op=hapus&id="+id,
		  		success:function(data){
		  			// alert(data);
		  			lihat_all();
		  			swal({
					  title: "Berhasil!",
					  text: "Data "+data,
					  type: "success",
					  confirmButtonColor: "#3C8DBC",
					  timer: 4000
					});
		  		}
	  		})
		});
	  	
	  }

	  function input_form(){
	  	 $.ajax({
		      url:"<?php echo $proses; ?>",
		      data:"op=input_form&"+$('form[name="form_input"]').serialize(),
		      success:function(msg){
		        alert(msg);
		        lihat_all();
		   //      swal({
					//   title: "Berhasil!",
					//   text: "Data "+msg,
					//   type: "success",
					//   confirmButtonColor: "#3C8DBC",
					//   timer: 4000
					// });
		      }
		    })
	  }

	  function ganti_desa(id_kec){
	  	$("#desa").load("<?php echo $proses; ?>","op=load_desa&id_kec="+id_kec);
	  }
</script>
</div>
