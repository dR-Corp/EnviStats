<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include(COMPONENTS.'head.php') ?>
<!-- /.head -->

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="Assets/dist/img/log2.png" alt="AdminLTELogo" width="150">
			<h1 class="h1 text-success">EnviStats</h1>	
        </div>

        <!-- Navbar -->
        <?php include(COMPONENTS.'navbar.php') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include(COMPONENTS.'sidebar.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php include(COMPONENTS.'content-header.php') ?>
            <!-- /.content-header -->

            <!-- Main content -->
            <?php include($page) ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
		<!-- Footer -->
		<?php include(COMPONENTS.'footer.php') ?>
		<!-- /. footer -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

	<!-- Scripts -->
    <?php include(COMPONENTS.'script.php') ?>
	<!-- /. scripts -->

</body>
</html>