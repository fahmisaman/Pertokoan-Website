<?php
	function setHeader($title,$icon){
		// echo '<div class="row">
  //               <div class="col-lg-12">
  //                   <h1 class="page-header"><span class="'.$icon.'"></span> '.ucfirst($title).'</h1>
  //               </div>
  //               <!-- /.col-lg-12 -->
  //           </div>';

        echo'<section class="content-header">
		      <h1>
		        <span class="'.$icon.'"></span> '.ucfirst($title).'
		      </h1>
		      <ol class="breadcrumb">
		        <li><a href="../beranda/"><i class="fa fa-dashboard"></i> Home</a></li>';
		        if (ucfirst($title)=="Beranda") {
		        	# code...
		        }else{
		        	echo'<li class="active">'.ucfirst($title).'</li>';
		        }
		      echo'</ol>
		    </section>
		    <hr style="background-color: #fefefe;height: 2px;border-radius: 2px;"></hr>
				 <section class="content">';
    }
?>