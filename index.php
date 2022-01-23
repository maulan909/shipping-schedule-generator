<!DOCTYPE html>
<html lang="en">
<?php 
require_once "config/koneksi.php";
require_once "config/fungsi.php";
if (isset($_GET['page'])) {
	$title = ucwords($_GET['page']);
}else{
	$title = "Dashboard";
}
 ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Plot Generator - <?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Detail Plot Generator <sup>3.0</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo isset($_GET['page'])? '' : 'active'; ?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item <?php echo (isset($_GET['page']) AND $_GET['page'] == 'plot')? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?page=plot">
                    <i class="fas fa-fw fa-upload"></i>
                    <span>Upload Plot</span></a>
            </li>
            <li class="nav-item <?php echo (isset($_GET['page']) AND $_GET['page'] == 'ship-plot')? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?page=ship-plot">
                    <i class="fas fa-fw fa-upload"></i>
                    <span>Upload Shipping Schedule</span></a>
            </li>
            <li class="nav-item <?php echo (isset($_GET['page']) AND $_GET['page'] == 'checker')? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?page=checker">
                    <i class="fas fa-fw fa-search"></i>
                    <?php if (cekCO() > 0): ?>
                        <span class="badge badge-danger badge-counter">!!!</span>
                    <?php endif ?>
                    <span>CO Checker</span></a>
            </li>
            <li class="nav-item  <?php echo (isset($_GET['page']) AND $_GET['page'] == 'kategori')? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?page=kategori">
                    <i class="fas fa-fw fa-upload"></i>
                    <?php if (count(cekItem()) > 0): ?>
                        <span class="badge badge-danger badge-counter">!!!</span>
                    <?php endif ?>
                    <span>Upload Master Kategori</span></a>
            </li>
            <li class="nav-item  <?php echo (isset($_GET['page']) AND $_GET['page'] == 'detail')? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?page=detail">
                    <i class="fas fa-fw fa-download"></i>
                    <span>Download Detail Shipping Schedule</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
                    <?php 
                    if (isset($_GET['page']) AND $_GET['page'] != "") {
                    	if ($_GET['page'] == "kategori") {
                    		include "kategori.php";
                    	}else if ($_GET['page'] == "plot") {
                    		include "plot.php";
                    	}else if ($_GET['page'] == "ship-plot") {
                    		include "ship_plot.php";
                        }else if($_GET['page'] == "checker"){
                            include 'checker.php';
                    	}else if ($_GET['page'] == 'detail') {
                    		include "detail.php";
                    	}

                    }


                     ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Hilmi Maulana 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php 

    $p = $_GET['page'];

    if ($p == "ship-plot") {
    	$p = "ship_plot";
    	$title = "Shipping Schedule";
    }

     ?>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Anda yakin ingin menghapus data <?= $title; ?> ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="action.php?page=<?= $p; ?>&a=delete">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>