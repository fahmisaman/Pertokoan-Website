<?php
	include "conn.php";
	$op = $_GET['op'];

	if ($op=="load_kategori") {
		if (empty($_GET['id'])) {
		$SELECT = mysql_query("SELECT * FROM lapak ORDER BY RAND() limit 9");
		
		$CEK = mysql_num_rows($SELECT);
		if($CEK > 0){
				// $select_top = mysql_query("SELECT * from lapak where id_jenis='$id' LIMIT 0,6");
				while ($data_top = mysql_fetch_array($SELECT)) {
					$fotoku = mysql_fetch_array(mysql_query("SELECT * FROM foto where id_lapak='".$data_top['id_lapak']."' ORDER BY id_foto ASC"));
					echo "
						<div class='col-sm-4'>
							<div class='product-image-wrapper'>
								<div class='single-products'>
									<div class='productinfo text-center'>
										<a href='Detail-Lapak-".$data_top['id_lapak']."'><img class='cover' src='".$fotoku['url_foto']."' alt='' width='300' height='300'/></a>
										<a href='Detail-Lapak-".$data_top['id_lapak']."'><h2>".number_format($data_top['harga'])."</h2></a>
										<p>".$data_top['nama_lapak']."</p>
										<a href='Detail-Lapak-".$data_top['id_lapak']."' class='btn btn-default add-to-cart'><i class='fa fa-external-link'></i>Detail</a>
									</div>";
								// echo"<div class='product-overlay'>
								// 		<div class='overlay-content'>
								// 			<h2>".number_format($data_top['harga'])."</h2>
								// 			<p>".$data_top['nama_lapak']."</p>
								// 			<a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
								// 		</div>
								// 	</div>";
							echo"</div>
								
							</div>
						</div>
					";
				}
			}
		}else{
			$id = $_GET['id'];
			$nm_jenis = mysql_fetch_array(mysql_query("SELECT * FROM master_jenis where id_jenis='$id'"));
			echo "
				<div class='features_items'><!--features_items-->
					<h2 class='title text-center'>".$nm_jenis['jenis']."</h2>";
						$jumlah = 9;

		if(isset($_GET['page'])){
		    $noPage = $_GET['page']; 
		}else{
		     $noPage = 1;
		}
		 $offset = ($noPage - 1) * $jumlah;
		$SELECT = mysql_query("SELECT a.* FROM lapak as a WHERE id_jenis='$id' ORDER BY a.id_lapak ASC limit $offset, $jumlah");
		// $SELECT = mysql_query("SELECT a.* FROM lapak a WHERE id_jenis='$id' ORDER BY a.id_lapak ASC, a.tgl_terima ASC limit $offset, $jumlah");
		$CEK = mysql_num_rows($SELECT);
		if($CEK > 0){
						// $select_top = mysql_query("SELECT * from lapak where id_jenis='$id' LIMIT 0,6");
						while ($data_top = mysql_fetch_array($SELECT)) {
							$fotoku = mysql_fetch_array(mysql_query("SELECT * FROM foto where id_lapak='".$data_top['id_lapak']."' ORDER BY id_foto ASC"));
							echo "
								<div class='col-sm-4'>
									<div class='product-image-wrapper'>
										<div class='single-products'>
											<div class='productinfo text-center'>
												<a href='Detail-Lapak-".$data_top['id_lapak']."'><img class='cover' src='".$fotoku['url_foto']."' alt='' width='300' height='300'/></a>
												<a href='Detail-Lapak-".$data_top['id_lapak']."'><h2>".number_format($data_top['harga'])."</h2></a>
												<p>".$data_top['nama_lapak']."</p>
												<a href='Detail-Lapak-".$data_top['id_lapak']."' class='btn btn-default add-to-cart'><i class='fa fa-external-link'></i>Detail</a>
											</div>";
										// echo"<div class='product-overlay'>
										// 		<div class='overlay-content'>
										// 			<h2>".number_format($data_top['harga'])."</h2>
										// 			<p>".$data_top['nama_lapak']."</p>
										// 			<a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
										// 		</div>
										// 	</div>";
									echo"</div>
										
									</div>
								</div>
							";
						}
		}

		$jumdat = mysql_num_rows(mysql_query("SELECT *FROM lapak where id_jenis='$id'"));
		$jumlah_hal = ceil($jumdat/$jumlah);
	   	$showPage = 0;
	   	$prev = $noPage-1;
		$next = $noPage+1;
		echo "<br/>";
		echo "<p class='row'>";
		echo "<div class='col-md-12 btn-group'><center>";
		   if ($noPage > 1){
		      echo  "<a class='btn btn-warning' href='javascript:lihat_kategori(\"".$id."\",$prev)'>&lt;</a>";
		   } 
		   for($page = 1; $page <= $jumlah_hal; $page++){
		      if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumlah_hal)){
		        
		        if (($showPage == 1) && ($page != 2))  echo "<span class='btn btn-warning'>...</span>";

		         if (($showPage != ($jumlah_hal - 1)) && ($page == $jumlah_hal))  echo "<span class='btn btn-warning'>...</span>";

		        if ($page == $noPage) echo " <span class='btn btn-default btn-disabled'>".$page."</span> ";

		        else echo "<a class='btn btn-warning' href='javascript:lihat_kategori(\"".$id."\",$page)'>".$page."</a>";

		         $showPage = $page;
		      }
		    }

		  if ($noPage < $jumlah_hal) echo "<a class='btn btn-warning' href='javascript:lihat_kategori(\"".$id."\",$next)'>&gt;</a>";
		echo "</center></div>";

			echo"</div><br /><p />";
		}
	}elseif ($op=="tambah_keranjang") {
		$id_lapak = $_GET['id_lapak'];
		$id_pembeli = $_GET['id_pembeli'];
		$tgl_pakai = $_GET['tgl_pakai'];
		$jml = $_GET['jml'];

		$cek_keranjang = mysql_num_rows(mysql_query("SELECT * FROM keranjang where id_lapak='$id_lapak' and tgl_pakai='$tgl_pakai' and id_pembeli='$id_pembeli' and tampil_keranjang='Y'"));
		if ($cek_keranjang == 0) {
			$input = mysql_query("INSERT into keranjang (id_pembeli,id_lapak,tgl_pakai,jml) values ('$id_pembeli','$id_lapak','$tgl_pakai','$jml')");
		}else{
			// input jadi update
			$input = mysql_query("UPDATE keranjang set jml =jml + $jml where id_lapak='$id_lapak' and id_pembeli='$id_pembeli' and tampil_keranjang='Y' ");
		}

		if ($input) {
			echo "sukses";
		}else{
			echo mysql_error();
		}
	} else if ($op == "isi_keranjang"){
		$id_pembeli = $_GET["id_pembeli"];
		echo $jum = mysql_num_rows(mysql_query("select * from keranjang where id_pembeli = '$id_pembeli' and tampil_keranjang = 'Y'"));
	}
?>