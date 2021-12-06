function cek(){
	$tmp = '';
	if($('#pendaftar_nama').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Boleh Kosong');
		$('#pendaftar_nama').closest(".form-group").addClass("has-error");
		$tmp = '#pendaftar_nama';
		$($tmp).focus();
	} else {
		$('#pendaftar_nama').closest(".form-group").removeClass("has-error");
	}
	if($('#pendaftar_no_telp').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Boleh Kosong');
		$('#pendaftar_no_telp').closest(".form-group").addClass("has-error");
		if($tmp == ''){
			$tmp = '#pendaftar_no_telp';
		}
		$($tmp).focus();
	} else {
		$('#pendaftar_no_telp').closest(".form-group").removeClass("has-error");
	}
	if($('#pendaftar_email').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Benar');
		$('#pendaftar_email').closest(".form-group").addClass("has-error");
		if($tmp == ''){
			$tmp = '#pendaftar_email';
		}
		$($tmp).focus();
	} else {
		$('#pendaftar_email').closest(".form-group").removeClass("has-error");
	}
	if($('#pendaftar_email_konfirm').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Benar');
		$('#pendaftar_email_konfirm').closest(".form-group").addClass("has-error");
		if($tmp == ''){
			$tmp = '#pendaftar_email_konfirm';
		}
		$($tmp).focus();
	} else {
		$('#pendaftar_email_konfirm').closest(".form-group").removeClass("has-error");
	}
	if($('#pendaftar_kelas').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Benar');
		$('#pendaftar_kelas').closest(".form-group").addClass("has-error");
		if($tmp == ''){
			$tmp = '#pendaftar_kelas';
		}
		$($tmp).focus();
	} else {
		$('#pendaftar_kelas').closest(".form-group").removeClass("has-error");
	}
	if($('#pendaftar_jadwal').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Benar');
		$('#pendaftar_jadwal').closest(".form-group").addClass("has-error");
		if($tmp == ''){
			$tmp = '#pendaftar_jadwal';
		}
		$($tmp).focus();
	} else {
		$('#pendaftar_jadwal').closest(".form-group").removeClass("has-error");
	}
	if($('#pendaftar_alamat').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Benar');
		$('#pendaftar_alamat').closest(".form-group").addClass("has-error");
		if($tmp == ''){
			$tmp = '#pendaftar_alamat';
		}
		$($tmp).focus();
	} else {
		$('#pendaftar_alamat').closest(".form-group").removeClass("has-error");
	}
	if($('#pendaftar_ket_lain').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Benar');
		$('#pendaftar_ket_lain').closest(".form-group").addClass("has-error");
		if($tmp == ''){
			$tmp = '#pendaftar_ket_lain';
		}
		$($tmp).focus();
	} else {
		$('#pendaftar_ket_lain').closest(".form-group").removeClass("has-error");
	}
	if($("#pendaftar_email").val() != '' && $("#pendaftar_email_konfirm").val() != ''){		
		if($('#pendaftar_email_konfirm').val() != $("#pendaftar_email").val()){
			$("#errormessage").show();
			$("#errormessage").html('Email Konfirmasi Tidak Sesuai');
			$('#pendaftar_email_konfirm').closest(".form-group").addClass("has-error");
			if($tmp == ''){
				$tmp = '#pendaftar_email_konfirm';
			}
			$($tmp).focus();
		} else {
			$('#pendaftar_email_konfirm').closest(".form-group").removeClass("has-error");
		}
	}
	
	if($tmp == ''){
		save();
	}
}