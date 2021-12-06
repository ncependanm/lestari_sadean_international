	
	<div class="container" style="margin-top: 100px">
		<div class="row">
			<div class="recent">
				<button class="btn-primarys"><h3>News</h3></button>
				<hr>
			</div>
		</div>
	</div>
	<div id="awal">
	<?php 
	$no = 0;
	$tmp = '';
	foreach($dataBlog as $b){ 
	$no++;
	if($no==1){
		echo '<div class="container"><div class="row">';
	}
	?>
		
				<div class="col-md-6">
					<div class="page-header">
						<div class="blog">
							<h3><?=$b->blog_judul?></h3>
							<h5><i><?=substr($b->blog_tgl, 0, 11)?>, Post : <?=$b->blog_postby?></i></h5>
							<p><?=substr($b->blog_isi, 0, 700)?></p>
							<div class="ficon">
								<a href="javascript:void(0)" title="Readmore" onclick="readmore(<?=$b->blog_id?>)">Readmore <i class="fa fa-long-arrow-right"></i></a>
							</div>
						</div>
					</div>				
				</div>
	<?php 
	if($no==2){
		$tmp='ada';
		$no = 0;
		echo '</div></div>';
	}
	}?>
	</div>
	<div class="container" id="readMore" style="display: none">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<div class="blog">
						<h3><?=$b->blog_judul?></h3>
						<h5><i><?=substr($b->blog_tgl, 0, 11)?>, Post : <?=$b->blog_postby?></i></h5>
						<p><?=$b->blog_isi?></p>
							<div class="ficon">
								<a href="javascript:void(0)" title="Readmore" onclick="back()"> <i class="fa fa-long-arrow-left"></i> Back</a>
							</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
	<script>
	function readmore(id)
{
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('news/readmore')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$("#awal").hide();
			$("#readMore").show();
			$('[name="judulBlog"]').html(data.blog_judul);
			$('[name="tglPostBlog"]').html(data.blog_tgl + ', Post By : ' + data.blog_postby);
            $('[name="isiBlog"]').html(data.blog_isi);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
};
	function back(){
			$("#awal").show();
			$("#readMore").hide();
	
	}
	</script>
	