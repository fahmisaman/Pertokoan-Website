<?php
	setHeader("Isi Laporan","fa fa-check");
	$id_kategori = $_GET['id_kategori'];
	$data_kat = mysql_fetch_assoc(mysql_query("SELECT * from kategori where id_kategori='$id_kategori'"));
	if ($data_kat['id_pegawai']!=$_SESSION['id_pengguna']) {
		echo "Anda tidak memiliki akses ke kategori ini";
	}else{

?>


<div class="box box-default">
	<div class="box-header with-border">
	  <i class="fa fa-table"></i>
	  <h3 class="box-title">Laporan Harian <?php echo "<b>".$data_kat['tahun']."/".$data_kat['bulan']."</b>"; ?></h3><!-- <a href='Data-Artikel' class="pull-right">Lihat Data</a> -->
	</div>
	<div class="box-body">
		<form class="form-horizontal" method="POST" name="form_input" action="javascript:input_form()">
			<div class="form-group">
		        <div class="col-lg-12">
		        <label class="control-label" for="inputDefault">Tanggal Kegiatan</label>
		          <input class="form-control"  id="tgl" value="<?php echo date('dd/mm/yyyy'); ?>"  type="date" name="tgl" required>
		          <input class="form-control"  id="id_kategori" type="hidden" name="id_kategori" value="<?php echo $id_kategori; ?>">
		          <input class="form-control"  id="id_laporan" type="hidden" name="id_laporan">
		        </div>
		    </div>
	        <div class="form-group">
		        <div class="col-lg-12">
		        <label class="control-label" for="inputDefault">Nama Kegiatan</label>
		          <textarea rows="4" id="kegiatan" class="form-control" name="kegiatan"></textarea>
		        </div>
		    </div>
		    <div class="form-group">
		        <div class="col-lg-12">
		        <label class="control-label" for="inputDefault">Waktu Kegiatan</label>
		          <input class="form-control"  id="waktu"  type="number" name="waktu" min="1" required>
		        </div>
		    </div>
		    <div class="form-group">
		        <div class="col-lg-12">
		          <input type="submit" class="btn btn-info" id="btn-daftar" value="Tambah" />
		          <a onclick="javascript:refresh()" class="btn btn-default">Batal</a>
		        </div>
		    </div>
	    </form>
	</div>
</div>

<div class="box box-default">
	<div class="box-header with-border">
	  <i class="fa fa-table"></i>
	  <h3 class="box-title">Isi Laporan Harian <?php echo "<b>".nm_bulan($data_kat['bulan'])." ".$data_kat['tahun']."</b>"; ?></h3><!-- <a href='Data-Artikel' class="pull-right">Lihat Data</a> -->
	</div>
	<div class="box-body">
		<div id="load_tb_isi"></div>
	</div>
</div>

<script type="text/javascript">
	var id_kategori = "<?php echo $_GET['id_kategori']; ?>";
	$(document).ready(function(){
		// alert("ok");
		refresh();
	});

	function refresh(){
		$('form[name="form_input"]')[0].reset();
		$("#load_tb_isi").load("<?php echo $proses; ?>","op=load_tb_isi&id_kategori="+id_kategori);
	}

	 function input_form(){
	    $.ajax({
	      url:"<?php echo $proses; ?>",
	      data:"op=input_form&"+$('form[name="form_input"]').serialize(),
	      success:function(msg){
	        // alert(msg);
	        if (msg=='Diinput') {
	      		swal({
				  title: "Berhasil!",
				  text: "Data Berhasil "+msg,
				  type: "success",
				  confirmButtonColor: "#3C8DBC",
				  timer: 4000
				});

	        }else if(msg=='Diperbaharui'){
	        	swal({
				  title: "Berhasil!",
				  text: "Data Berhasil "+msg,
				  type: "success",
				  confirmButtonColor: "#3C8DBC",
				  timer: 4000
				});
				location.reload();
	        }else {
	        	swal({
				  title: "Gagal!",
				  text: msg,
				  type: "error",
				  confirmButtonColor: "#3C8DBC",
				  timer: 4000
				});
	        }
				refresh();
	      }
	    })
	  }

	function hapus(id,keg){
	  	swal({
		  title: "Anda Yakin Menghapus Kegiatan "+keg+" ?",
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
		  		data:"op=load_lap_edit&id="+id,
		  		dataType:"json",
		  		success:function(data){
		    			$("#waktu").val(data.waktu);
		    			$("#kegiatan").val(data.nm_keg);
		    			$("#tgl").val(data.tgl_keg);
		    			$("#id_laporan").val(id);
		  		}
		  	})
	}
</script>

<?php } ?>