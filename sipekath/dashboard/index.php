<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Pengukuran Kinerja Pegawai Tenaga Honorer</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" type="text/css" href="../lib/sweet-alert.css">      
  <script src="../lib/sweet-alert.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <link rel="stylesheet" href="../css/datepicker3.css">
  <link rel="stylesheet" href="../css/bootstrap-timepicker.min.css">

  <link rel="shortcut icon" href="../img/man-1351317__340.png">


  <!-- jQuery 2.2.0 -->
<script src="../js/jquery-2.2.4.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="../js/demo.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-timepicker.min.js"></script>
<!-- Upload Form Untuk Jquery -->
<script src="../js/jquery.form.js"></script>
<!-- Slimscroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../js/app.min.js"></script>
<!-- Input Mask -->
<script src="../js/jquery.inputmask.js"></script>
<script src="../js/jquery.inputmask.date.extensions.js"></script>
<script src="../js/jquery.inputmask.extensions.js"></script>

  <!-- Bootstrap Datatable CSS  -->
  <link href="../css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
  <!-- <link href="../css/datatables.min.css" rel="stylesheet" type="text/css"> -->
<!-- Jquery Datatables JS -->
<!-- <script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/dataTables.bootstrap.min.js"></script> -->
  <script language="javascript">
  $(document).ready(function(){
   
  });

    var user="";
    var msg="- SIPEKATH  ";
    var speed=150;
    var left="";
    var right="";
    function scroll_title() {
        document.title=left+msg+right;
        msg=msg.substring(1,msg.length)+msg.charAt(0);
        setTimeout("scroll_title()",speed);
    }
    scroll_title();
</script>
</head>
<?
   include "../fungsi/conn.php";
   include "../fungsi/generate.php";
   session_start();
   if (!isset($_SESSION['id_pengguna'])) {
    // echo header("location:http://localhost/medical/");
    echo"<script language=javascript>
      alert('Maaf, Mohon Login Terlebih Dahulu');
      location.href='http://datacenter.poltekkesgorontalo.ac.id/sipekath/';
    </script>";
  }


?>
<body id="bodiku" class="hold-transition skin-black-light  fixed sidebar-mini" onload="initialize()">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SEKAT</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SI</b>Pekath</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top ">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php echo"<img src='../img/man-1351317__340.png' class='user-image' alt='User Image'>"; ?>
              <span class="hidden-xs"><?php echo $_SESSION['nama']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php echo'<img src="../img/man-1351317__340.png" class="img-circle" alt="User Image">'; ?>

                <p>
                  <?php echo $_SESSION['nama']; ?>
                  <small>

                  </small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <a href="javascript:void(0);">
                       <?php
                        if($_SESSION['level']=="karyawan"){
                          $cek_jab = mysql_fetch_assoc(mysql_query("SELECT * from user as a, jabatan as b where a.id_user='".$_SESSION['id_pengguna']."' and a.id_jab=b.id_jab"));
                          echo $cek_jab['jab'];
                        }

                      ?>
                    </a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <?php echo'<a href="Profil'.$_SESSION["id_pengguna"].'" class="btn btn-default btn-flat">Profil</a>'; ?>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat" href="LogOut"><i class="fa fa-sign-out fa-fw"></i> Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php echo'<img src="../img/man-1351317__340.png" class="img-circle" alt="User Image">'; ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nama']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form -->
     <!--  <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGASI UTAMA</li>
          
          <?php
            if($_SESSION['level']=="pegawai"){

                echo' <li><a href="Data-Atasan"><i class="fa  fa-level-up"></i> <span>Atasan Langsung</span></a></li>';
                echo' <li><a href="Data-Kategori"><i class="fa fa-briefcase"></i> <span>Data Kategori</span></a></li>';
                  $cek_bawahan = mysql_num_rows(mysql_query("SELECT * from atasan where atasan='".$_SESSION["id_pengguna"]."'"));
                  if ($cek_bawahan >= 1) {
                    echo' <li><a href="Staf"><i class="fa fa-users"></i> <span>Staff</span></a></li>';
                  }
             
          ?>
           
          <?php
            }elseif($_SESSION['level']=="admin"){
          ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-database"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Data-Jenis"><i class="fa fa-building"></i> Data Instansi</a></li>
                <li><a href="Data-Komoditas"><i class="fa fa-line-chart"></i> Data Capaian</a></li>
              </ul>
            </li>
            <li>
              <a href="Data-Karyawan">
                <i class="fa fa-user-plus"></i> <span>Data Karayawan</span>
            </a>
          </li>
          <?php
            }
          ?>
        
      </ul>
    </section>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
      
      <!-- /.row -->
      <?php 

        // for ($i=0; $i < 50 ; $i++) { 
        //   echo $i."<br />";
        // }
        if(isset($_GET['dir']) && isset($_GET['p'])){
              $dir = $_GET['dir'];
              $page = $_GET['p'];
              $proses = 'http://'.$_SERVER['SERVER_NAME'].'/sipekath/dashboard/'.$dir.'/proses/'.$page.'.php';
            }

            if(isset($_SESSION['username'])){
              include '../fungsi/page_header.php';

              if(!empty($_GET['dir'])){
                $pages_dir = $_GET['dir'];
              }else{
                $pages_dir = 'modul';
              }
                
                if(!empty($_GET['p'])){
                  $pages = scandir($pages_dir, 0);
                    unset($pages[0], $pages[1]);
             
                    $p = $_GET['p'];
                    if(in_array($p.'.php', $pages)){
                      include($pages_dir.'/'.$p.'.php');
                    } else {
                        echo "Page Not Found";
                    }
                } else {
                    include "selamat_datang.php";
                }
            }
       ?>

    </section>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Developer by <b><a target="_blank" href="#">Orenges IT</a></b>
    </div>
    <strong>Sistem Informasi Pengukuran Kinerja Tenaga Honorer (Kontrak)</strong>
    <br />
    <strong>Copyright &copy; 2018.</strong> All rights
    reserved. 
  </footer>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="../lib/datatables/jquery.dataTables.min.js"></script>
<script src="../lib/datatables/dataTables.bootstrap.min.js"></script>

</body>
</html>
