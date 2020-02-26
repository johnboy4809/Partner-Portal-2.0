var $mc = jQuery.noConflict(); // remove conficts with $ for any plugin js

request_cases(1);
$mc('#caseControls').on('click', 'a', function(e) {
    e.preventDefault();
    request_cases($mc(this).data('page'));
});

$mc('#caseRows') .on('click', '.case-row', function(e) {
    e.preventDefault();
    $mc('.case-row').removeClass('active');
    $mc('.the-case .working').addClass('show');
    $mc(this).addClass('active');
    $mc.ajax({
        type 		: 'POST',
        dataType 	: 'json',
        url			: ajaxurl,
        data		: 'action=loadCase'
                    + '&id=' + $mc(this).data('id'),
        success 	: function(data) {  
            $mc('.the-case .working').removeClass('show');
            $mc('#showCase').html(data.html);
        }
    });
});

function loadCase(ID) {
    $mc('.the-case .working').addClass('show');
    $mc.ajax({
        type 		: 'POST',
        dataType 	: 'json',
        url			: ajaxurl,
        data		: 'action=loadCase'
                    + '&id=' + ID,
        success 	: function(data) {  
            $mc('.the-case .working').removeClass('show');
            $mc('#showCase').html(data.html);
        }
    });
}
if ($mc.urlParam('case-id')) {
    loadCase($mc.urlParam('case-id'))
}


$mc(function() {
    'use strict';

    getData();

});   

// Ajax loaded content
$mc(document).ajaxComplete(function() {

});    