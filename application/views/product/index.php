<script>
	var tmpId = '';
</script>
<div class="container" style="margin-top: 100px">
		<div class="row">
			<div class="recent">
				<button class="btn-primarys"><h3>Our Products</h3></button>
				<hr>
			</div>
		</div>
	</div>
	<section class="portfolio">
	
			<nav class="navbar">
				<div class="container">
					<div class="navbar-header">
						<button type="button" style="width: 100%; float: left !important;" class="navbar-toggle collapsed" width="30%" data-toggle="collapse" data-target="#menu">
							Pilih Kategori
						</button>
					</div>
					<div class="navbar-collapse collapse" id="menu" style="padding-left: 0px !important">
						<ul class="nav navbar-nav navbar-left" style="margin-left: 0px !important;">
						<?php 
						$noTmp = 0;
						foreach($dataKategori as $k){?>
							<script>
								tmpId = tmpId + <?=$k->kategori_id?> +'|';
							</script>
							<?php 
							$noTmp++;
							if($noTmp == 1){ ?>
								<li role="presentation" style="margin-bottom: 5px; margin-right: 5px;">
									<button class="btn btn-warning" style="width: 100%"  id="btn<?=$k->kategori_id?>" onclick="tabKlik('<?=$k->kategori_id?>')"><?=$k->kategori_nama?></button>
								</li>								
							<?php } else { ?>
								<li role="presentation" style="margin-bottom: 5px; margin-right: 5px;">
									<button class="btn btn-info" style="width: 100%" id="btn<?=$k->kategori_id?>" onclick="tabKlik('<?=$k->kategori_id?>')"><?=$k->kategori_nama?></button>
								</li>								
							<?php } ?>
						<?php } ?>
						</ul>
					</div>

				</div>
			</nav>
	
		<div class="container">
			</div>
			<?php	
			$noTmp = 0;
			foreach($dataKategori as $k){ 
				$noTmp++;
				if($noTmp == 1){?>
					<div class="container" id="tab<?=$k->kategori_id?>">
				<?php } else { ?>
					<div class="container" id="tab<?=$k->kategori_id?>" style="display: none">
				<?php } ?>
					
				<?php 
				$sqlP = "SELECT * FROM tbl_galery WHERE galery_kategori = ".$k->kategori_id."";
				$dataP = $this->db->query($sqlP)->result();
				$no=0;
				$tmp = '';
				foreach($dataP as $p){ 
				$no++;
				$tmp = '';
					if($no==1){?>
					<div class="row">
						<div class="popup-gallery">
					<?php } ?>
						<div class="col-md-3">
							<a href="<?=base_url()?><?=$p->galery_img_src?>" title="<?=$p->galery_ket?>">
								<img src="<?=base_url()?><?=$p->galery_img_src?>" class="img-responsive"alt="" />
							</a></br>
						</div>				
				<?php if($no==4){
					$no=0; $tmp='ada';?>
						</div>
						</div>
				<?php } 
				} if($tmp == ''){ ?>
					</div>
					</div>
						<br/>
				<?php } ?>
					</div>
				</div>
			<?php
			}
			?>	
	</section>
	<script>
	function tabKlik(idTab){
		var dt = tmpId.split("|");
		for(var i=0; i < dt.length; i++){
			if (idTab == dt[i]){
				$("#tab"+idTab).show();
				$("#btn"+idTab).removeClass();
				$("#btn"+idTab).addClass('btn btn-warning');				
			} else {
				$("#tab"+dt[i]).hide();
				$("#btn"+dt[i]).removeClass();
				$("#btn"+dt[i]).addClass('btn btn-info');					
			}
		}
		
	}
	</script>
	