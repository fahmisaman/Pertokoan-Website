<?php
	setHeader("Data Instansi","fa fa-check");
?>

<div class="row">
	<div class="col-md-5"> 

		<div class="well bs-component" id="edit">
		  <form class="form-horizontal" method="POST" name="form_input" action="javascript:input_form()">
		    <fieldset>
		   		<div class="alert" style="background-color:white;color:black;">
				  <label style="font-size:20px;"><i class="icon fa fa-info-circle"></i> Form Instansi</label><br />
				</div>
		          <input  id="id_instansi"  type="hidden" name="id_instansi" >
		        
		      <div class="form-group">
		        <label class="col-lg-4 control-label" for="inputDefault">Instansi</label>
		        <div class="col-lg-8">
		          <!-- <input class="form-control" id="instansi" type="text" name="instansi"> -->
		          <input class="form-control" rows="2"  id="instansi"  type="text" name="instansi" >
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
			  <h3 class="box-title">Tampil Data instansi</h3>
			</div>
			<div class="box-body">
			  <div class="callout" style='background-color:#c8d3d9;color:blue;'>
			    <!-- <span style='font-size:20px;'>kecaputen</span> -->
			  </div>
			  	<div id="lihat-instansi"></div>
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
	        alert(msg);
	        refresh();
	      }
	    })
	  }

	  function refresh(){
	  	$('form[name="form_input"]')[0].reset();
	  	lihat_instansi();
	  }

	  function lihat_instansi(){
	  	$("#lihat-instansi").load("<?php echo $proses; ?>","op=lihat-instansi");
	  }

	  function hapus(id,instansi){
	  	var con = confirm("Anda Yakin Menghapus instansi "+instansi+"?");
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
		  		data:"op=load_instansi_edit&id="+id,
		  		dataType:"json",
		  		success:function(data){
		    			$("#instansi").val(data.instansi);
		    			$("#id_instansi").val(data.id_instansi);
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
