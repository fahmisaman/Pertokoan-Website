<?php
	setHeader("Data Poktan","fa fa-check");
?>

<div class="row">
	<div class="col-md-5"> 

		<div class="well bs-component" id="edit">
		  <form class="form-horizontal" method="POST" name="form_input" action="javascript:input_form()">
		    <fieldset>
		   		<div class="alert" style="background-color:white;color:black;">
				  <label style="font-size:20px;"><i class="icon fa fa-info-circle"></i> Form Poktan</label><br />
				</div>
		          <input  id="id_tmg"  type="hidden" name="id_tmg" >
		        
		      <div class="form-group">
		        <div class="col-lg-12">
		        <label class=" control-label" for="inputDefault">Poktan</label>
		          <!-- <input class="form-control" id="tmg" type="text" name="tmg"> -->
		          <input class="form-control" rows="2"  id="tmg"  type="text" name="tmg" >
		        </div>
		      </div>
		      <div class="form-group">
			        <div class="col-lg-12">
			          <label class="control-label" for="inputDefault">Kecamatan</label>
			           <select class="form-control" id="kecamatan" name="kecamatan" required onchange="javascript:ganti_desa(this.value);">
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
			    <div class="form-group">
			        <div class="col-lg-12">
			          <label class="control-label" for="inputDefault">Desa</label>
			           <select class="form-control" id="desa" name="desa" required>
			            <option value="">-- Pilih Kecamatan Terlebih Dahulu --</option>
			          </select>
		        	</div>
			    </div>
		      <div class="form-group">
		        <div class="col-lg-12">
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
			  <h3 class="box-title">Tampil Data poktan</h3>
			</div>
			<div class="box-body">
			  <div class="callout" style='background-color:#c8d3d9;color:blue;'>
			    <!-- <span style='font-size:20px;'>kecaputen</span> -->
			  </div>
			  	<div id="lihat-tmg"></div>
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

	  function ganti_desa(id_kec){
	  	$("#desa").load("<?php echo $proses; ?>","op=load_desa&id_kec="+id_kec);
	  }
	  
	  function refresh(){
	  	$('form[name="form_input"]')[0].reset();
	  	lihat_tmg();
	  }

	  function lihat_tmg(){
	  	$("#lihat-tmg").load("<?php echo $proses; ?>","op=lihat-tmg");
	  }

	  function hapus(id,tmg){
	  	var con = confirm("Anda Yakin Menghapus tmg "+tmg+"?");
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
		  		data:"op=load_tmg_edit&id="+id,
		  		dataType:"json",
		  		success:function(data){
		    			$("#tmg").val(data.tmg);
		    			$("#id_tmg").val(data.id_tmg);
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
