var $mc = jQuery.noConflict(); // remove conficts with $ for any plugin js

$mc(function() {
	'use strict';

  	$mc("#contactRegisterForm").validate({
		rules : {
			reg_email			: {
				required 		: true,
				minlength 		: 5,
				email 			: true,
				remote 			: {
					url 		: ajaxurl,
					type 		: "POST",
					cache		: false,
					dataType	: "json",
					data		: {
						action 	: "regEmailCheck",
						reg_email : function() { 
							return $mc("#reg_email").val(); 
						},
					},
					dataFilter	: function(response) {
						return emailCheck(response);
					},
				}
			},
			account_id			: {
				remote			: {
					url 		: ajaxurl,
					type 		: "POST",
					cache		: false,
					dataType	: "json",
					data		: {
						action 	: "accountCheck",
					},
					dataFilter	: function(response) {
						return accountCheck(response);
					},
				}
			},
			phone_work 			: {
				required 		: true,
			},
		},
		messages				: {
			reg_email 			: {
				required 		: "Please provide a vaild email address.",
				email 			: "Please provide a vaild email address.",
				remote			: "This email cannot be used."
			},
		},
	});

	function emailCheck(response) {
		var data = jQuery.parseJSON(response);
		if (data.success) {
			return true;
		}
		return false;
	}

	function accountCheck(response) {
		var data = jQuery.parseJSON(response);
		console.log(data);
		
	}


});
