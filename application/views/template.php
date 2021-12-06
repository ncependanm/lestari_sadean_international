<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$judulHalaman?></title>

    <!-- Bootstrap -->
    <link href="<?=base_url()?>assets/front/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/front/css/responsive-slider.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/animate.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/font-awesome.min.css">
	<link href="<?=base_url()?>assets/front/css/style.css" rel="stylesheet">	
	<link rel="stylesheet" href="<?=base_url()?>assets/front/css/magnific-popup.css"> 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header>
				
		<div id="main-nav" style="position: fixed; top: 0; width: 100%; background-color: rgba(255,255,255,0.9); z-index: 100">
			<nav class="navbar">
				<div class="container">
					<div class="navbar-header">
						<a href="<?=base_url()?>" class="navbar-brand" >
						<h4><b>Lestari Sadean International</b></h4></a>
						<button type="button" class="navbar-toggle collapsed" width="30%" data-toggle="collapse" data-target="#ftheme">
							<span class="sr-only">Toggle</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="navbar-collapse collapse" id="ftheme">
						<ul class="nav navbar-nav navbar-right">
								<li role="presentation" <?php if($menu == 'home'){ echo 'class="active"';}?>><a href="<?=base_url()?>">Home</a></li>
								<li role="presentation" <?php if($menu == 'product'){ echo 'class="active"';}?>><a href="<?=base_url()?>product">Our Products</a></li>
								<li role="presentation" <?php if($menu == 'news'){ echo 'class="active"';}?>><a href="<?=base_url()?>news">News</a></li>
						</ul>
					</div>

				</div>
			</nav>
				
		</div>
	</header>
		<?=$contents?>

		
		
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="widget">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31697.993982346332!2d108.5298805!3d-6.7394203!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78e8b2dee20e07%3A0xc920168aecf838de!2sVillage+Hall+%2F+Village+Office+of+Aryojeding!5e0!3m2!1sen!2sid!4v1503373040648" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="widget">
						<h5 class="widgetheading">Contact Us</h5>
						<address>
						<strong>Lestari Sadean International</strong><br>
							Aryojeding 03/11 Rejotangan, Tulungagung, East Java, Indonesia. 66293</br>
							Phone/Fax 	: +62 355 396390</br>
							Mobile Number	: +62 811306717</br>
							Email		: dimyane@gmail.com</br>
						</address>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<hr>
			</div>
		</div>
		
		<div id="sub-footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="copyright">
							<p>
								<span>&copy; Lestari Sadean International
							</p>
                            <!-- 
                                All links in the footer should remain intact. 
                                Licenseing information is available at: http://bootstraptaste.com/license/
                                You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Arsha
                            -->
						</div>
					</div>
					<div class="col-lg-6">
						<ul class="social-network">
							<li><a href="<?=$urlFB?>" data-placement="top" title="Facebook"><i class="fa fa-facebook fa-1x"></i></a></li>
							<li><a href="<?=$urlIG?>" data-placement="top" title="Twitter"><i class="fa fa-instagram fa-1x"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--end footer-->
	
	<!--end footer-->
	
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?=base_url()?>assets/front/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=base_url()?>assets/front/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/front/js/responsive-slider.js"></script>
	<script src="<?=base_url()?>assets/front/js/wow.min.js"></script>
	<script src="<?=base_url()?>assets/front/js/jquery.magnific-popup.js"></script>
	<script src="<?=base_url()?>assets/front/js/functions.js"></script>
	<script>
	wow = new WOW(
	 {
	
		}	) 
		.init();
	</script>
  </body>
</html>