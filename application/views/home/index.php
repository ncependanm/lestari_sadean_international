<div class="slider">
	<div class="container" style="margin-top: 100px">
		<div class="row">
			<div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
				<div class="slides" data-group="slides">
					<ul>
					<?php 
			foreach($dataSlide as $s){ ?>
						<li>
							<div class="slide-body" data-group="slide">
								<img src="<?=base_url()?><?=$s->slide_img?>" alt="">
								<div class="caption header" data-animate="slideAppearUpToDown" data-delay="500" data-length="300">
									<button class="btn btn-primary"><h2> <?=$s->slide_title?></h2></button>
									<div class="caption-sub" data-animate="slideAppearDownToUp" data-delay="1200" data-length="300"><button class="btn btn-primary"><h4><span><?=$s->slide_ket?></span></h4></button></div>
								</div>
							</div>
						</li>
			<?php } ?>
					</ul>
				</div>		   
				<a class="slider-control left" href="#" data-jump="prev"><i class="fa fa-angle-left fa-2x"></i></a>
				<a class="slider-control right" href="#" data-jump="next"><i class="fa fa-angle-right fa-2x"></i></a>		
			</div>
		</div>
	</div>
	</div>
	
		<div class="container">
			<div class="about">			
					<div class="row">
						<div class="recent">
							<button class="btn-primarys"><h3>Company Profile</h3></button>
							<hr>
						</div>
					</div>				
				<div class="row">			
					<div class="row-slider">
						
						<div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.2s">
							<div class="col-lg-6 mar-bot30">
								<div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true">
									<div class="slides" data-group="slides">
										<ul> 	    		
											<div class="slide-bodys" data-group="slide">
												<?php foreach($dataSlideDua as $dd){ ?>
													<li><img alt="" class="img-responsive" src="<?=base_url()?><?=$dd->slide_dua_img_src?>" width="100%" height="450"/></li>
												<?php } ?>
											</div>
										</ul>
											
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.6s">
								<div class="thumnails">												
									<p>We are international trading company based in Indonesia.</br>
Our Main business is Provide Indonesia Products To any part of the world, such as Food, beverages, and agriculture products. 
</br></br>
Lestari Sadean Head Office Located in North Java, and our Export activities carried out through various ports in Indonesia, like Tanjung Perak, Tanjung Priok, Tanjung Emas, Belawan, etc. 
</br></br>
Currently, we have a Partner warehouse in Selangor, malaysia, as a strategic partner to reach countries in southeast asia.
</p>
									
								</div>
							</div>
						</div>					
					</div>	
				</div>					
			</div>			
		</div>
		
	
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="contents">
					<h2>Our Vision </h2>
					<p style="font-size: 20px; text-transform: none !important;">Becoming a global company known for its integrity and professionalism, </br>in providing the needs of Indonesian products in various parts of the world.
</p>
				</div>
			</div>
		</div>
	</div>
	
	
	