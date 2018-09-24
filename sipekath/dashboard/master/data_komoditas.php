<?php
	setHeader("Data Capaian","fa fa-check");
?>

<div class="row">
	<div class="col-md-5"> 

		<div class="well bs-component" id="edit">
		   <form class="form-horizontal" method="POST" name="form_upload" id="form_upload" action="<?php echo $proses."?op=upload_tp"; ?>" enctype="multipart/form-data">
		    <fieldset>
		   		<div class="alert" style="background-color:white;color:black;">
				  <label style="font-size:20px;"><i class="icon fa fa-info-circle"></i> Form Capaian</label><br />
				</div>
		          <input  id="id_mk"  type="hidden" name="id_mk" >
		       <div class="form-group">
			        <div class="col-lg-12">
			        <label class=" control-label" for="inputDefault">Instansi</label>
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
		      <div class="form-group">
		        <div class="col-lg-12">
		        <label class=" control-label" for="inputDefault">Capaian per Hari (Menit)</label>
		          <!-- <input class="form-control" id="komoditas" type="text" name="komoditas"> -->
		          <input class="form-control" id="capaian"  type="number" name="capaian" min="1">
		        </div>
		      </div>
		      <div class="form-group">
		        <div class="col-lg-12">
		          <a onclick="javascript:refresh()" class="btn btn-default">Batal</a>
		          <input type="submit" class="btn btn-primary" id="btn-upload" value="Tambah" />
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
			  <h3 class="box-title">Tampil Data Capaian</h3>
			</div>
			<div class="box-body">
			  <!-- <div class="callout" style='background-color:gray;color:white;'>
			    <span style='font-size:20px;'>Komoditas</span>
			  </div> -->
			  	<div id="lihat-komoditas"></div>
			</div>
		</div>

	</div>
</div>

<div class="row"></div>

<script type="text/javascript">
	$(document).ready(function(){
		// alert("ok");
		refresh();
		$("#form_upload").ajaxForm({
	  		beforeSubmit:function(){
				$("#btn-upload").attr("disabled","disabled");
				$("#btn-upload").attr("value","Loading ..");
			},
			success:function(msg){
				alert(msg);
				// if(msg == "sukses"){
	   //            	swal({
				// 	  title: "Berhasil!",
				// 	  text: "Berhasil Upload Pasphoto",
				// 	  type: "success",
				// 	  confirmButtonColor: "#3C8DBC",
				// 	  timer: 7000
				// 	});
	   //          }else{
	   //            	swal({
				// 	  title: "Gagal!",
				// 	  text: msg,
				// 	  type: "error",
				// 	  confirmButtonColor: "#3C8DBC",
				// 	  timer: 4000
				// 	});
	   //          }
				refresh();
			}
		});
	});


	  function refresh(){
	  	$("#btn-upload").removeAttr("disabled");
		$("#btn-upload").attr("value","Tambah");
	  	$('form[name="form_upload"]')[0].reset();
	  	lihat_komoditas();
	  }

	  function lihat_komoditas(){
	  	$("#lihat-komoditas").load("<?php echo $proses; ?>","op=lihat-komoditas");
	  }

	  function hapus(id,komoditas){
	  	var con = confirm("Anda Yakin Menghapus komoditas "+komoditas+"?");
	  	if (con) {
	  		$.ajax({
	  			url:"<?php echo $proses; ?>",
		  		data:"op=hapus&id="+id,
		  		success:function(data){
		  			alert(data);
		  			refresh();
		  		}
	  		})
	  	}else{
	  		exit();
	  	}
	  }

	  function edit(id){
	  	$.ajax({
		  		url:"<?php echo $proses; ?>",
		  		data:"op=load_komoditas_edit&id="+id,
		  		dataType:"json",
		  		success:function(data){
		    			$("#jenis").val(data.id_jk);
		    			$("#komoditas").val(data.komoditas);
		    			$("#id_mk").val(data.id_mk);
		  		}
		  	})
	  }
</script>

<!-- <div class="widget">
	<div class="title_widget"><h3>Timeline</h3></div>
	<div class="widget-content"><div class="tb_widget_timeline clearfix">

		<article>
			<span class="date">2016-12-17</span>
			<span class="time">13:24:28</span>
				<div class="timeline_content">
					<i class="fa fa-clock-o"></i>
					<h3><a href="/artikel-geevv-mesin-pencari-tawarkan-konsep-donasi.html">Geevv  Mesin Pencari  Tawarkan Konsep Donasi</a></h3>
				</div>
		</article>
		<article>
			<span class="date">2016-12-17</span>
			<span class="time">13:24:28</span>
				<div class="timeline_content">
					<i class="fa fa-clock-o"></i>
					<h3><a href="/artikel-geevv-mesin-pencari-tawarkan-konsep-donasi.html">Geevv  Mesin Pencari  Tawarkan Konsep Donasi</a></h3>
				</div>
		</article>
		<article>
			<span class="date">2016-12-17</span>
			<span class="time">13:24:28</span>
				<div class="timeline_content">
					<i class="fa fa-clock-o"></i>
					<h3><a href="/artikel-geevv-mesin-pencari-tawarkan-konsep-donasi.html">Geevv  Mesin Pencari  Tawarkan Konsep Donasi</a></h3>
				</div>
		</article>


	</div>
	</div>
</div> -->
