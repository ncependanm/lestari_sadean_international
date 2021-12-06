<?php if($this->session->userdata('user_id') != ''){
    redirect('profile');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Pendaftaran</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?=base_url();?>asset/global/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url();?>asset/global/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>asset/global/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url();?>asset/global/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url();?>asset/css/loading.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
		<link href="<?=base_url();?>asset/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url();?>asset/css/plugins.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?=base_url();?>asset/css/daftar.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
        <script src="<?=base_url();?>asset/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/var.js" type="text/javascript"></script>
		<script src="<?=base_url();?>asset/pages/js/form-validation-daftar.js" type="text/javascript"></script>

    <body class="">
	
	<script>
	function save()
	{
		showLoading();
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled',true); //set button disable 
		var url;

			url = "<?php echo site_url('daftar/save')?>";
			$("#msgSKS").text("Pendaftaran Berhasil Dilakukan !!");
			$("#msgERR").text("Pendaftaran Gagal Dilakukan !!");

		// ajax adding data to database
		$.ajax({
			url : url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data)
			{
				if(data.status){
					$("#alerSKS").show();
					$('#btnSave').text('save'); //change button text
					$('#btnSave').attr('disabled',false); //set button enable 
					window.location.href = '<?=base_url()?>backend/beranda';	
				}else{
					$("#alerERR").show();
					$('#btnSave').text('save'); //change button text
					$('#btnSave').attr('disabled',false); //set button enable 	
					$("#msgERR").text(data.msg);
					$('[name="reg_akun_nisn"]').val("");
					$('[name="reg_akun_nama"]').val("");
					$('[name="reg_akun_password"]').val("");
					$('[name="reg_akun_nisn"]').focus();
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				$("#alerERR").show();
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable 
			}
		});
		hideLoading();
	};
	</script>
	
		<div class="preload-spinner" id="loading" style="display: none">
		<div class="sk-folding-cube">
			<div class="sk-cube1 sk-cube"></div>
			<div class="sk-cube2 sk-cube"></div>
			<div class="sk-cube4 sk-cube"></div>
			<div class="sk-cube3 sk-cube"></div>
		</div>
		</div>
        <div class="container">
            <div class="row" style="margin-bottom:5px !important;">
                <div class="col-md-6 coming-soon-header">
                    <a class="brand" href="index.html" style="border-radius: 5px">
                        <img src="<?=base_url();?>assets/images/logoP2DB.jpeg" alt="logo" />
					</a>
                </div>
                <div class="col-md-6 coming-soon-countdown">
					<h3 style="color: #FFF !important" id="judulCountdown"></h3>
                    <div id="defaultCountdown"> </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 coming-soon-content">
                    <h1>Daftarkan Diri Anda!</h1>
                    <p> Bagi para lulusan SMP yang ingin melanjutkan ketingkat selanjutnya, kami telah membuka pendaftaran online melalui website kami, segera daftarkan diri anda di sekolah favorit ini. </p>
                    <br>
					
            <div class="row">
                <div class="coming-soon-footer"> 2016 &copy; Encep Endan M</div>
            </div>
                </div>
                <div class="col-md-6 coming-soon-content" id="tempatDaftar">
                   
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <span class="caption-subject bold uppercase"><?=$judulForm;?></span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-title">
								
                                    <!-- BEGIN FORM-->
                                    <form id="form" class="form-horizontal" autocomplete="off">
									    <input type="text" name="id" hidden /> 
                                        <div class="form-body">
											<div id="alerSKS" class="custom-alerts alert alert-success fade in" style="display:none">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
												<p id="msgSKS"></p>
											</div>
											<div id="alerERR" class="custom-alerts alert alert-warning fade in" style="display:none">
												<button type="button" class="close" data-dismiss="alert" >x</button>
												<p id="msgERR"></p>
											</div>
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> Inputan masih belum sesuai. Mohon periksa kembali ! </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Sukses ! </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4">NISN
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="reg_akun_nisn" data-required="1" class="form-control" maxlength="11"/> 
													<span class="help-block"> NISN akan menjadi username untuk login</span>
												</div>
                                            </div>
                                            <div class="form-group" style="display: none">
                                                <label class="control-label col-md-4">Jalur Pendaftaran
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
													<input type="text" name="reg_akun_jalur_daftar" data-required="1" class="form-control" maxlength="11"/>
												</div>
                                            </div>
											<div class="form-group">
                                                <label class="control-label col-md-4">Nama Lengkap
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="text" name="reg_akun_nama" data-required="1" class="form-control" maxlength="50" /> 
												</div>
                                            </div>
											<div class="form-group">
                                                <label class="control-label col-md-4">Password
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <input type="password" name="reg_akun_password" data-required="1" class="form-control" /> 
												</div>
                                            </div>
                                        </div>
                                        <div class="form-actions" style="margin-bottom:15px">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
													<button type="submit" id="btnSave" class="btn btn-primary">Daftar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
								</div>
                                <div class="portlet-body">
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-9">
													<label class="control-label">Jika sudah mendaftar, silahkan klik <a href="<?=base_url();?>backend/login">disini</a> untuk login</label>
                                                </div>
                                            </div>
                                        </div>
								</div>
							</div>
                </div>
            </div>
            <!--/end row-->
        </div>
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
		<script>
		$(document).ready(function() {	
			var today = new Date();
			var tglAwal = new Date();
			var tglAkhir = new Date();
			var thn_ajaran_reg_awal = "";
			var tgl_awal = "";
			var bln_awal = "";
			var thn_awal = "";
			var thn_ajaran_reg_akhir = "";
			var tgl_akhir = "";
			var bln_akhir = "";
			var thn_akhir = "";
			var tglAwalReg = new Date();
			var tglAkhirReg = new Date();
			var thn_ajaran_reg_awalReg = "";
			var tgl_awalReg = "";
			var bln_awalReg = "";
			var thn_awalReg = "";
			var thn_ajaran_reg_akhirReg = "";
			var tgl_akhirReg = "";
			var bln_akhirReg = "";
			var thn_akhirReg = "";
			<?php foreach ($tbl_thn_ajaran as $k) { ?>
				thn_ajaran_reg_awal = "<?=$k->thn_ajaran_reg_awal;?>";
				tgl_awal = thn_ajaran_reg_awal.substring(0, 2);
				bln_awal = thn_ajaran_reg_awal.substring(3, 5);
				thn_awal = thn_ajaran_reg_awal.substring(6, 10);
				thn_ajaran_reg_akhir = "<?=$k->thn_ajaran_reg_akhir;?>";
				tgl_akhir = thn_ajaran_reg_akhir.substring(0, 2);
				bln_akhir = thn_ajaran_reg_akhir.substring(3, 5);
				thn_akhir = thn_ajaran_reg_akhir.substring(6, 10);
				
				thn_ajaran_reg_awalReg = "<?=$k->thn_ajaran_reg_awal_reguler;?>";
				tgl_awalReg = thn_ajaran_reg_awalReg.substring(0, 2);
				bln_awalReg = thn_ajaran_reg_awalReg.substring(3, 5);
				thn_awalReg = thn_ajaran_reg_awalReg.substring(6, 10);
				thn_ajaran_reg_akhirReg = "<?=$k->thn_ajaran_reg_akhir_reguler;?>";
				tgl_akhirReg = thn_ajaran_reg_akhirReg.substring(0, 2);
				bln_akhirReg = thn_ajaran_reg_akhirReg.substring(3, 5);
				thn_akhirReg = thn_ajaran_reg_akhirReg.substring(6, 10);
			<?php } ?>
			tglAwal.setFullYear(thn_awal,parseInt(bln_awal)-1,tgl_awal);
			tglAkhir.setFullYear(thn_akhir,parseInt(bln_akhir)-1,tgl_akhir);
			
			tglAwalReg.setFullYear(thn_awalReg,parseInt(bln_awalReg)-1,tgl_awalReg);
			tglAkhirReg.setFullYear(thn_akhirReg,parseInt(bln_akhirReg)-1,tgl_akhirReg);

			var tahun = thn_akhir+"-"+bln_akhir+"-"+tgl_akhir+"T17:00:00";
			var tahunAwal = thn_awal+"-"+bln_awal+"-"+tgl_awal+"T17:00:00";
			var tahunReg = thn_akhirReg+"-"+bln_akhirReg+"-"+tgl_akhirReg+"T17:00:00";
			var tahunRegAwal = thn_awalReg+"-"+bln_awalReg+"-"+tgl_awalReg+"T17:00:00";
            var austDay = new Date();
            var austDayReg = new Date();
			
			if(today >= tglAwal && today < tglAwalReg){
				if(today <= tglAkhir){
					austDay = new Date(tahun);		
					$('#defaultCountdown').show();	
					$('#tempatDaftar').show();
					$("#judulCountdown").text("Pendaftaran Siswa Baru Jalur Prestasi Hanya Tinggal");
					$('#defaultCountdown').countdown({until: austDay});
					$('[name="reg_akun_jalur_daftar"]').val("P");
				} else {
					austDay = new Date(tahun);
					$("#judulCountdown").text("Pendaftaran Siswa Baru Jalur Prestasi Sudah Ditutup, Pada Tanggal <?=$k->thn_ajaran_reg_awal_reguler;?> Akan Dibuka Pendaftaran Siswa Baru Jalur Reguler.");
					$('#defaultCountdown').hide();	
					$('#defaultCountdown').countdown({until: austDay});	
					$('#tempatDaftar').hide();
				}
			} else {
				if(today < tglAkhir){
					austDay = new Date(tahunAwal);
					$('#defaultCountdown').show();
					$("#judulCountdown").text("Pendaftaran Siswa Baru Jalur Prestasi Akan dibuka, Pada Tanggal <?=$k->thn_ajaran_reg_awal;?>.");
					$('#defaultCountdown').countdown({until: austDay});	
					$('#tempatDaftar').hide();
				}
			}
						
			if(today >= tglAwalReg){
				if(today <= tglAkhirReg){
					austDayReg = new Date(tahunReg);		
					$('#defaultCountdown').show();	
					$('#tempatDaftar').show();
					$("#judulCountdown").text("Pendaftaran Siswa Baru Jalur Reguler Hanya Tinggal");
					$('#defaultCountdown').countdown({until: austDayReg});		
					$('[name="reg_akun_jalur_daftar"]').val("R");
				} else {
					austDayReg = new Date(tahunReg);
					$("#judulCountdown").text("Pendaftaran Siswa Baru Jalur Reguler Sudah Ditutup");
					$('#defaultCountdown').hide();	
					$('#defaultCountdown').countdown({until: austDayReg});	
					$('#tempatDaftar').hide();
				}
			} else{
				if(today > tglAkhir){
					austDay = new Date(tahunRegAwal);
					$('#defaultCountdown').show();
					$("#judulCountdown").text("Pendaftaran Siswa Baru Jalur Reguler Akan dibuka, Pada Tanggal <?=$k->thn_ajaran_reg_awal_reguler;?>.");
					$('#defaultCountdown').countdown({until: austDay});	
					$('#tempatDaftar').hide();					
				}
			}
		});
		</script>
        <script src="<?=base_url();?>asset/global/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>asset/js/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/js/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=base_url();?>asset/global/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/countdown/jquery.countdown.js" type="text/javascript"></script>
        <script src="<?=base_url();?>asset/global/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?=base_url();?>asset/js/app.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?=base_url();?>asset/pages/js/daftar.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>