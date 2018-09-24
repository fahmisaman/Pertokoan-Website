<?php
	setHeader("Data Kecamatan","fa fa-check");
?>

<div class="row">
	<div class="col-md-5"> 

		<div class="well bs-component" id="edit">
		  <form class="form-horizontal" method="POST" name="form_input" action="javascript:input_form()">
		    <fieldset>
		   		<div class="alert" style="background-color:white;color:black;">
				  <label style="font-size:20px;"><i class="icon fa fa-info-circle"></i> Form Kecamatan</label><br />
				</div>
			  
		      <div class="form-group" hidden="">
		        <label class="col-lg-4 control-label" for="inputDefault">Kode Kecamatan</label>
		        <div class="col-lg-8">
		          <input class="form-control"  id="id_kec"  type="text" name="id_kec" >
		        </div>
		      </div> 
		      <div class="form-group">
		        <label class="col-lg-4 control-label" for="inputDefault">Kecamatan</label>
		        <div class="col-lg-8">
		          <!-- <input class="form-control" id="kec" type="text" name="kec"> -->
		          <textarea class="form-control" rows="3" id="kec" name="kec"></textarea>
		        </div>
		      </div>
		      <div class="form-group">
		        <div class="col-lg-8 col-lg-offset-4">
		          <a onclick="javascript:refresh()" class="btn btn-default">Batal</a>
		          <input type="submit" class="btn btn-primary" id="btn-daftar" value="Tambah" />
		        </div>
		      </div>
		    </fieldset>
		  </form>
		</div>

	</div>
	<!-- ini yang baru -->
	<div class="col-md-7">

		<div class="box box-default">
			<div class="box-header with-border">
			  <i class="fa fa-table"></i>
			  <h3 class="box-title">Tampil Data</h3>
			</div>
			<div class="box-body">
			  <div class="callout" style='background-color:#c8d3d9;color:blue;'>
			    <!-- <span style='font-size:20px;'>kecaputen</span> -->
			  </div>
			  	<div id="lihat-kec"></div>
			</div>
		</div>

	</div>
</div>

<div class="row"></div>

<script type="text/javascript">
	$(document).ready(function(){
		// alert("ok");
		refresh();
	});

	 function input_form(){
	    $.ajax({
	      url:"<?php echo $proses; ?>",
	      data:"op=input_form&"+$('form[name="form_input"]').serialize(),
	      success:function(msg){
	        // alert(msg);
	        swal({
				  title: "Berhasil!",
				  text: "Data "+msg,
				  type: "success",
				  confirmButtonColor: "#3C8DBC",
				  timer: 4000
				});
	        refresh();
	      }
	    })
	  }

	  function refresh(){
	  	$('form[name="form_input"]')[0].reset();
	  	lihat_kec();
	  }

	  function lihat_kec(){
	  	$("#lihat-kec").load("<?php echo $proses; ?>","op=lihat-kec");
	  }

	  function hapus(id,kec){
	  	// var con = confirm("Anda Yakin Menghapus Kecamatan "+kec+"?");
	  	// if (con) {
	  	swal({
		  title: "Anda Yakin Menghapus Kecamatan "+kec+" ?",
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
		  		swal({
				  title: "Berhasil!",
				  text: "Data "+data,
				  type: "success",
				  confirmButtonColor: "#3C8DBC",
				  timer: 4000
				});
		  			refresh();
		  		}
	  		})
		});
	  	// }else{
	  	// 	exit();
	  	// }
	  }

	  function edit(id){
	  	$.ajax({
		  		url:"<?php echo $proses; ?>",
		  		data:"op=load_kec_edit&id="+id,
		  		dataType:"json",
		  		success:function(data){
		    			$("#kec").val(data.kec);
		    			$("#id_kec").val(data.id_kec);
		  		}
		  	})
	  }
</script>