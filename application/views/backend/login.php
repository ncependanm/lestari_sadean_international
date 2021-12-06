<?php
if($this->session->userdata('user_id')!='')
{
    redirect('backend/dashboard');
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
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?=base_url();?>dashboard">
			Lestari Sandean International</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg"><b>Administrator </b>System</p>
		<div id="alertNULL" class="custom-alerts alert alert-danger fade in" style="display: none">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <span> Username and password harus diisi. </span>
        </div>
		<div id="alerSKS" class="custom-alerts alert alert-success fade in" style="display: none">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			<p id="msgSKS"></p>
		</div>
		<div id="alerERR" class="custom-alerts alert alert-warning fade in" style="display: none">
			<button type="button" class="close" data-dismiss="alert" >x</button>
			<p id="msgERR"></p>
		</div>
        <form id="form" class="login-form" autocomplete="off">
          <div class="form-group has-feedback">
            <input type="text" name="user_username" class="form-control" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="user_password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12 text-center">
              <button type="submit" id="btnLogin" class="btn btn-primary btn-block btn-flat">Login</button>
            </div><!-- /.col -->
          </div>
        </form>
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?=base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?=base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
	
	<script src="<?=base_url();?>assets/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
	
    <script src="<?=base_url();?>assets/pages/js/form-validation-login.js" type="text/javascript"></script>
    
	<script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
	  
	$(document).ready(function() {
		$('[name="user_username"]').focus();	
	});
	
		function login()
		{
			$('#btnLogin').text('Login...'); //change button text
			$('#btnLogin').attr('disabled',true); //set button disable 
			var url;

				url = "<?php echo site_url('backend/login/auth')?>";

			// ajax adding data to database
			$.ajax({
				url : url,
				type: "POST",
				data: $('#form').serialize(),
				dataType: "JSON",
				success: function(data)
				{

					if(data.status) //if success close modal and reload ajax table
					{
						$("#alerERR").hide();
						$("#alerSKS").show();
						$("#msgSKS").text(data.msg);
						window.location.href = '<?=base_url()?>backend/dashboard';
					}else{
						$("#alerERR").show();
						$("#msgERR").text(data.msg);
					}

					$('#btnLogin').text('Login'); //change button text
					$('#btnLogin').attr('disabled',false); //set button enable 


				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$("#alerERR").show();
					$("#msgERR").text("Error");
					$('#btnLogin').text('Login'); //change button text
					$('#btnLogin').attr('disabled',false); //set button enable 

				}
			});
		};
	</script>
  </body>
</html>
