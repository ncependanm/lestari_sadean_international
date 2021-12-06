function cek(){
	$tmp = '';
	if($('#testimoni_nama').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Boleh Kosong');
		$('#testimoni_nama').closest(".form-group").addClass("has-error");
		$tmp = '#testimoni_nama';
		$($tmp).focus();
	} else {
		$('#testimoni_nama').closest(".form-group").removeClass("has-error");
	}
	if($('#testimoni_email').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Boleh Kosong');
		$('#testimoni_email').closest(".form-group").addClass("has-error");
		if($tmp == ''){
			$tmp = '#testimoni_email';
		}
		$($tmp).focus();
	} else {
		$('#testimoni_email').closest(".form-group").removeClass("has-error");
	}
	if($('#testimoni_pekerjaan').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Boleh Kosong');
		$('#testimoni_pekerjaan').closest(".form-group").addClass("has-error");
		if($tmp == ''){
			$tmp = '#testimoni_pekerjaan';
		}
		$($tmp).focus();
	} else {
		$('#testimoni_pekerjaan').closest(".form-group").removeClass("has-error");
	}
	if($('#testimoni_testimoni').val() == ''){
		$("#errormessage").show();
		$("#errormessage").html('Inputan Tidak Benar');
		$('#testimoni_testimoni').closest(".form-group").addClass("has-error");
		if($tmp == ''){
			$tmp = '#testimoni_testimoni';
		}
		$($tmp).focus();
	} else {
		$('#testimoni_testimoni').closest(".form-group").removeClass("has-error");
	}

	if($tmp == ''){
		save();
	}
}