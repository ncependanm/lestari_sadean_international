var Login=function(){
	var a=function(){
		$(".login-form").validate({
			errorElement:"span",errorClass:"help-block",focusInvalid:!0,
			rules:{
				user_username:{required:!0},
				user_password:{required:!0}
				},
			invalidHandler:function(a,b){
				$(".alert-danger",$(".login-form")).show()
			},
			highlight:function(a){
				$(a).closest(".form-group").addClass("has-error"),
				$("#alertNULL").show()
			},
			unhighlight:function(a){
				$(a).closest(".form-group").removeClass("has-error"),
				$("#alertNULL").hide()
			},
			success:function(a){
				a.closest(".form-group").removeClass("has-error"),
				a.remove(),
				$(".alert-danger",$(".login-form")).hide()
			},
			errorPlacement:function(a,b){
				a.insertAfter(b.closest(".input-icon"))
			},
			submitHandler:function(a){
				login()
			}
		}),
		$(".login-form input").keypress(function(a){
			if(13==a.which)return $(".login-form").validate().form()&&login(),!1})
	};
	return{
		init:function(){
			a()
		}
	}
}();
			
jQuery(document).ready(function(){
	Login.init()
});