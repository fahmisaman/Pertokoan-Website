<?php
	setHeader("Kategori","fa fa-check");
?>

<div class="row">
	<div class="col-md-4"> 

		<div class="well bs-component" id="edit">
		  <form class="form-horizontal" method="POST" name="form_input" action="javascript:input_form()">
		    <fieldset>
		   		<div class="alert" style="background-color:white;color:balck;">
				  <label style="font-size:20px;"><i class="icon fa fa-info-circle"></i> Form Kategori</label><br />
				</div>
		          <input  id="id_kategori"  type="hidden" name="id_kategori" >
		        
		     <!--  <div class="form-group">
		        <div class="col-lg-12">
		        <label class="control-label" for="inputDefault">Tahun</label>
		           <select class="form-control" id="tahun" name="tahun" required value="<?php echo date("Y"); ?>">
		            <option value="">-- Pilih Tahun --</option>
		            <?php
		                $thn_skr = date('Y');
		                for ($x = $thn_skr; $x >= 2017; $x--) {
		                    echo"<option value='$x'>$x</option>";
		                }
		            ?>
		          </select>
	        	</div>
		      </div> -->
		       <div class="form-group">
		        <div class="col-lg-12">
		        <label class="control-label" for="inputDefault">Tahun</label>
		           <input type="text" readonly="" class="form-control" id="tahun" name="tahun" required value="<?php echo date("Y"); ?>" >
	        	</div>
		      </div>
		      <div class="form-group">
		        <div class="col-lg-12">
		        <label class="control-label" for="inputDefault">Bulan</label>
		           <select class="form-control" id="bulan" name="bulan" required>
		            <option value="">-- Pilih Bulan --</option>
		            <option value="1"> Januari </option>
		            <option value="2"> Februari </option>
		            <option value="3"> Maret </option>
		            <option value="4"> April </option>
		            <option value="5"> Mei </option>
		            <option value="6"> Juni </option>
		            <option value="7"> Juli </option>
		            <option value="8"> AGustus </option>
		            <option value="9"> September </option>
		            <option value="10"> Oktober </option>
		            <option value="11"> November </option>
		            <option value="12"> Desember </option>
		          
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
	<div class="col-md-8">

		<div class="box box-default">
			<div class="box-header with-border">
			  <i class="fa fa-table"></i>
			  <h3 class="box-title">Tampil Data Kategori</h3>
			</div>
			<div class="box-body">
			  <div class="callout" style='background-color:#c8d3d9;color:blue;'>
			    <!-- <span style='font-size:20px;'>kecaputen</span> -->
			  </div>
			  	<div id="lihat-jab"></div>
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
	  	lihat_jab();
	  }

	  function lihat_jab(){
	  	$("#lihat-jab").load("<?php echo $proses; ?>","op=lihat-jab");
	  }

	  function hapus(id,jab){
	  	var con = confirm("Anda Yakin Menghapus jab "+jab+"?");
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
		  		data:"op=load_jab_edit&id="+id,
		  		dataType:"json",
		  		success:function(data){
		    			$("#jab").val(data.jab);
		    			$("#id_kategori").val(data.id_kategori);
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
