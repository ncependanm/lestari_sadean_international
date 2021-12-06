<?php
if($this->session->userdata('user_id')=='')
{
    redirect('backend/login');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$judulHalaman;?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?=base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url();?>assets/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- Ion Slider -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/ionslider/ion.rangeSlider.css">
    <!-- ion slider Nice -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/ionslider/ion.rangeSlider.skinNice.css">
    <!-- bootstrap slider -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/bootstrap-slider/slider.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/sweetalert/sweetalert.css">
    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>assets/sweetalert/sweetalert.min.js"></script>
    <script src="<?=base_url();?>assets/pages/js/var.js"></script>
	<script src="<?=base_url();?>js/ckeditor/ckeditor.js"></script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue">
    <div class="wrapper">
      <header class="main-header">
        <a href="<?=base_url()?>backend/dashboard" class="logo">
          <span class="logo-mini"><b>L S</b> I </span>
          <span class="logo-lg"><b>Admin</b> L S I</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
			<li class="tasks-menu">
            <a href="<?=base_url()?>" class="dropdown-toggle" target="_blank">
              <i class="fa fa-globe"> View Frontend</i>
            </a>
            </li>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?=base_url();?>assets/images/no-image.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?=$this->session->userdata('user_nama')?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="<?=base_url();?>assets/images/no-image.png" class="img-circle" alt="User Image">
                    <p>
                      <?=$this->session->userdata('user_nama')?>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="<?=base_url();?>backend/login/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=base_url();?>assets/images/no-image.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?=$this->session->userdata('user_nama')?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
			<?php 
			include "menu/menu.php";
			?>
        </section>
      </aside>
	  
	  <div class="content-wrapper" style="min-height: 921px;">
		<?=$contents?>
      </div>
	  
      <footer class="main-footer">
        <strong>Copyright &copy; Lestari Sandean International .</strong> All rights reserved.
        </div>
		</footer>

    </div>
    <script src="<?=base_url()?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="<?=base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/raphael/raphael-min.js"></script>
    <script src="<?=base_url();?>assets/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?=base_url();?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?=base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?=base_url();?>assets/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="<?=base_url();?>assets/plugins/moment/moment.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?=base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?=base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?=base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- Select2 -->
    <script src="<?=base_url();?>assets/plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="<?=base_url();?>assets/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?=base_url();?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?=base_url();?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- bootstrap color picker -->
    <script src="<?=base_url();?>assets/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?=base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="<?=base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- FastClick -->
    <script src="<?=base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url();?>assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?=base_url();?>assets/dist/js/demo.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?=base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
    <!-- FLOT CHARTS -->
    <script src="<?=base_url();?>assets/plugins/flot/jquery.flot.min.js"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="<?=base_url();?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
	
	<script src="<?=base_url();?>assets/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        
    <script src="<?=base_url();?>assets/plugins/flot/jquery.flot.pie.min.js"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="<?=base_url();?>assets/plugins/flot/jquery.flot.categories.min.js"></script>
    <!-- Ion Slider -->
    <script src="<?=base_url();?>assets/plugins/ionslider/ion.rangeSlider.min.js"></script>
    <!-- Bootstrap slider -->
    <script src="<?=base_url();?>assets/plugins/bootstrap-slider/bootstrap-slider.js"></script>
	
    <script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script>
	$('#datepicker').datepicker({
      autoclose: true,
	  format: 'dd-mm-yyyy',
    });
	$('#datepicker2').datepicker({
      autoclose: true,
	  format: 'dd-mm-yyyy',
    });
	</script>
  </body>
</html>
