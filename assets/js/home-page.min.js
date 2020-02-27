var $mc = jQuery.noConflict(); // remove conficts with $ for any plugin js

request_printers(1, 0, 0);
$mc('#printerControls').on('click', 'a', function(e) {
    e.preventDefault();
    var byclass = $mc('#selectClass').val();
    var byserial = $mc('#serialSearch').val();
    request_printers($mc(this).data('page'), byclass, byserial);
});

request_cases(1);
$mc('#caseControls').on('click', 'a', function(e) {
    e.preventDefault();
    request_cases($mc(this).data('page'));
});

$mc('#selectClass').on('change', function() {
    var byclass = $mc(this).val();
    var byserial = $mc('#serialSearch').val();
    request_printers(1, byclass, byserial);
});

$mc('#serialSearch').on("keyup input", function(){
    var byserial = $mc(this).val();
    var byclass = $mc('#selectClass').val();
    if(byserial.length) {
        request_printers(1, byclass, byserial);
    }
});

$mc('#caseRows') .on('click', '.case-row', function(e) {
    var id = $mc(this).data('id');
    $mc(location).attr("href", '/cases?case-id=' + id);
});


$mc("#serialCheck").validate({
    submitHandler		: function(form) {
        var working = $mc(form).siblings(".found-printer").find(".working");
        working.addClass("show");
        $mc.ajax({
            type 		: $mc(form).attr('method'),
            dataType 	: 'json',
            url			: ajaxurl,
            data		: $mc(form).serialize() + '&action=' + $mc(form).data('action'),
            success 	: function(data)
            {
                working.removeClass('show');
                $mc(form).find('.message').replaceWith('<div class="message"></div>');
                if (data.message) {
                    $mc(form).find('.message').replaceWith(data.message);
                }	
                if (data.html) {
                    $mc('#printerInfo').html(data.html);
                }
                return;
            },
            error 		: function(data) {
                working.removeClass('show');
                console.log("ajax error, json: " + data);
            }
        });	
    }
});


$mc(function() {
    'use strict';

    getData();
    getPrinters();

});    


// Ajax loaded content
$mc(document).ajaxComplete(function() {

});    

