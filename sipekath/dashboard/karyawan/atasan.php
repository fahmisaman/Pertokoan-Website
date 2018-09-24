<?php
	setHeader("Atasan Langsung","fa fa-level-up");
?>

<div class="row">
	<div class="col-md-5"> 

		<div class="well bs-component" id="edit">
		  <form class="form-horizontal" method="POST" name="form_input" action="javascript:input_form()">
		    <fieldset>
		   		<div class="alert" style="background-color:white;color:black;">
				  <label style="font-size:20px;"><i class="icon fa fa-info-circle"></i> Form Atasan Langsung</label><br />
				</div>
			  <div class="form-group">
			        <label class="col-lg-4 control-label" for="inputDefault">Pilih Instansi Atasan</label>
			        <div class="col-lg-8">
			           <select class="form-control" id="kec" name="kec" required onchange="javascript:ganti_atasan(this.value);">
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
		      <div hidden class="form-group">
		        <label class="col-lg-4 control-label" for="inputDefault">Kode atasan</label>
		        <div class="col-lg-8">
		          <input class="form-control"  id="id_atasan"  type="text" name="id_atasan" >
		        </div>
		      </div> 
		       <div class="form-group">
			        <label class="col-lg-4 control-label" for="inputDefault">Atasan</label>
			        <div class="col-lg-8">
			           <select class="form-control" id="atasan" name="atasan" required>
			            <option value="">-- Pilih Terlebih Dahulu Instansi --</option>

			          </select>
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
			  <h3 class="box-title">Tampil Data atasan</h3>
			</div>
			<div class="box-body">
			  <div class="callout" style='background-color:#c8d3d9;color:blue;'>
			    <!-- <span style='font-size:20px;'>atasan</span> -->
			  </div>
			  	<div id="lihat-atasan"></div>
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
	  	lihat_atasan();
	  }

	  function ganti_atasan(id){
	  	$("#atasan").load("<?php echo $proses; ?>", "op=ganti_atasan&id="+id);
	  }

	  function lihat_atasan(){
	  	$("#lihat-atasan").load("<?php echo $proses; ?>","op=lihat-atasan");
	  }

	  function hapus(id,atasan){
	  	swal({
		  title: "Anda Yakin Menghapus atasan "+atasan+" ?",
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
		  			refresh();
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

	  function edit(id){
	  	$.ajax({
		  		url:"<?php echo $proses; ?>",
		  		data:"op=load_atasan_edit&id="+id,
		  		dataType:"json",
		  		success:function(data){
		  				$("#kec").attr("readonly","readonly");
		    			$("#atasan").val(data.atasan);
		    			$("#id_atasan").val(data.id_atasan);
		    			$("#kec").val(data.id_kec);
		  		}
		  	})
	  }
</script>