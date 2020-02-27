var $mc = jQuery.noConflict(); // remove conficts with $ for any plugin js

// ------ Pagination controllers ------
function request_printers(pn, byclass, byserial) {
        
    var rowsHTML        = $mc('#printerRows'),
        pgControls      = $mc('#printerControls'),
        total           = rowsHTML.data('total'),
        rpp             = rowsHTML.data('perpage'),
        last            = Math.ceil(total/rpp),
        action          = 'printer-rows';

    $mc('#printerRows .working').addClass('show');
    paginationAjax(last, rpp, pn, action, byclass, byserial, rowsHTML);
    pgControls.html(paginationControls(last, pn));
}

function request_cases(pn) {
    
    var rowsHTML        = $mc('#caseRows'),
        pgControls      = $mc('#caseControls'),
        total           = rowsHTML.data('total'),
        rpp             = rowsHTML.data('perpage'),
        last            = Math.ceil(total/rpp),
        action          = 'case-rows';

    $mc('#caseRows .working').addClass('show');
    paginationAjax(last, rpp, pn, action, rowsHTML);
    pgControls.html(paginationControls(last, pn));
}

function paginationAjax(last, rpp, pn, action, byClass, bySerial, rowsHTML) {

    if (last < 1) {
        last = 1;
    }
    
    $mc.ajax({
        type 		: 'POST',
        dataType 	: 'json',
        url			: ajaxurl,
        data		: 'action=' + action
                    + '&rpp=' + rpp
                    + '&last=' + last
                    + '&pn=' + pn
                    + '&byclass=' + byClass
                    + '&byserial=' + bySerial,
        success 	: function(data) {  
            console.log(data);
            
            rowsHTML.html(data.html);
        }
    });  
}

function paginationControls(last,  pn) {

    var pgCtrls = "";

    pgCtrls += '<div class="controls">';
    if (last != 1) {
        if (pn > 1) {
            pgCtrls += '<span class="left"><a href="" class="printer-pgn" data-page="'+(pn-1)+'"><i class="fal fa-chevron-left"></i></a></span>';
        } else {
            pgCtrls += '<span class="left"></span>';
        }
        pgCtrls += '<span class="pages">Page '+pn+' of '+last+'</span>';
        if (pn != last) {
            pgCtrls += '<span class="right"><a href="" class="printer-pgn" data-page="'+(pn+1)+'"><i class="fal fa-chevron-right"></i></i></a></span>';
        } else {
            pgCtrls += '<span class="right"></span>';
        }
    } else {
        pgCtrls += '<span class="left"></span><span class="pages">Page '+pn+' of '+last+'</span><span class="right"></span>';
    }
    pgCtrls += '</div>';
    return pgCtrls;
}
// ------ Pagination controllers ------


// ------ Modal form functions ------
function checkSerial() {
    $mc("#modalSerialCheck").validate({
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
                        $mc('#modalPrinterInfo').html(data.html);
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
}

$mc(document).ajaxComplete(function() {
    checkSerial();
});
// ------ Modal form functions ------


$mc(function() {
    'use strict';

    var containerEl       = $mc('.grid-container'),
        menuIconEl        = $mc('.menu-icon'),
        sidenavEl         = $mc('.dashboard-menu'),
        sidenavCloseEl    = $mc('.close-icon'),
        sidenavColapseEl  = $mc('.collapse-btn'),
        userEl            = $mc('.user'),
        userMenuEl        = $mc('.user-menu'), 
        collapse          = $mc('.card-header'),
        collapseContent   = $mc('card-content'),
        caseFilter        = $mc('.case-filter'),
        orderBy           = $mc('#Order');

    function toggleClassName(el, className) {
        if (el.hasClass(className)) {
            el.removeClass(className);
            return;
        }
        el.addClass(className);
        return;
    }

    menuIconEl.on('click', function() {
        toggleClassName(sidenavEl, 'active');
        if (userMenuEl.hasClass('active')) {
            userMenuEl.removeClass('active');
        }
    });

    sidenavCloseEl.on('click', function() {
        toggleClassName(sidenavEl, 'active');
    });

    sidenavColapseEl.on('click', function() {
        toggleClassName($mc(this), 'collapse');
        toggleClassName(sidenavEl, 'collapse');
        toggleClassName(containerEl, 'collapse');
    });

    $mc('.has-sub > a').on('click', function(e) {
        e.preventDefault();
        $mc('.has-sub').removeClass('active');
        $mc(this).parents(".has-sub").addClass('active');
    })

    userEl.on('click', function() {
        toggleClassName(userMenuEl, 'active');
        if (sidenavEl.hasClass('active')) {
            sidenavEl.removeClass('active');
        }
    });

    collapse.on('click', function(e) {
        e.preventDefault();
        $mc(this).toggleClass('collapse').next(collapseContent).toggleClass('collapse');
    });

    orderBy.on('click', function(e) {
        e.preventDefault();
        toggleClassName(orderBy, 'ASC');
    });

    // $mc("#caseFilter :input").change(function() { 
    //     $mc(this).parents("form").submit();
    // });
    // $mc('.filter').change(function() {
    //     // $mc(this).parents("form").validate({
    //     //     submitHandler		: function(form) {
    //     //         $mc.ajax({
    //     //             type 		: $mc(form).attr('method'),
    //     //             dataType 	: 'json',
    //     //             url			: ajaxurl,
    //     //             data		: $mc(form).serialize() + '&action=' + $mc(form).data('action'),
    //     //         });    
    //     //     }
    //     // });
    //     // $form = $mc(this).parents("form");
    //     // $form.ajaxSubmit({
    //     //     type 		: $mc($form).attr('method'),
    //     //     dataType 	: 'json',
    //     //     url			: ajaxurl,
    //     //     data		: $mc($form).serialize() + '&action=' + $mc($form).data('action'),
    //     // });
    // });

    $mc('.printer-btn').click(function(e) {
        e.preventDefault();
        $mc.ajax({
            type 		: 'POST',
            dataType 	: 'json',
            url			: ajaxurl,
            data		: 'action=' + $mc(this).data('action') 
                        + '&class=' + $mc(this).data('class')
                        + '&serial=' + $mc(this).data('serial')
                        + '&pc=' + $mc(this).data('pc'),
            success 	: function(data) {  
                $mc('#printerInfo').html(data.html);
            }
        });
    });

    // function createCaseForm() 
    // {
    //     $mc("#createCaseForm").validate({
    //         rules                   : {
    //             serial              : {
    //                 remote          : {
    //                     url         : ajaxurl,
    //                     type        : "POST",
    //                     cache       : false,
    //                     dataType    : "json",
    //                     data        : {
    //                         serial  : function() { return $mc("#serial").val(); },
    //                         action  : "modal-check-serial",
    //                     },
    //                     dataFilter  : function(response) {
    //                         console.log(jQuery.parseJSON(response));
    //                         return validateSerialByAjax(response);
    //                     },
    //                 },
    //             },
    //         },
    //         messages                : {
    //             serial              : {
    //                 remote  	    : "Please provide a vaild serial number.",
    //             },
    //         },
    //         submitHandler		: function(form) {	
    //             if ($mc(form).hasClass('is-uploading')) return false;
    //             $mc(form).addClass('is-uploading').removeClass('is-error');
    //             if (isAdvancedUpload) {
    //                 var ajaxData = new FormData($mc(form).get(0));
    //                 if (droppedFiles) {
    //                     $mc.each(droppedFiles, function(i, file) {
    //                         ajaxData.append('files['+i+']', file );
    //                     });
    //                 }
    //                 $mc.ajax({
    //                     type 		: $mc(form).attr('method'),
    //                     dataType 	: 'json',
    //                     url			: ajaxurl,
    //                     data		: ajaxData,
    //                     cache	    : false,
    //                     contentType	: false,
    //                     processData	: false,
    //                     success 	: function(data) {
    //                         $mc(form).removeClass('is-uploading');
    //                         console.log(data);
    //                         $mc('.message').replaceWith('<div class="message"></div>');
    //                         if (data.message) {
    //                             $mc('.message').replaceWith(data.message);
    //                         }	
    //                         return;
    //                     },
    //                     error 		: function(data) {
    //                         $mc('.working').removeClass('show');
    //                         console.log("ajax error, json: " + data);
    //                     }
    //                 });
    //             } else {
    //             // ajax for legacy browsers
    //             }
    //         }
    //     });
    // }

    // function validateSerialByAjax(response) {
	// 	var data = jQuery.parseJSON(response),
	// 	result = false;
	// 	if (data.message) {
    //         $mc('.message').replaceWith(data.message);
    //     }
    //     if (data.html) {
    //         result = true;
    //         $mc('input[name^="serial_id"]').val(data.id);
    //         $mc('.found-printer-info').html(data.html);
	// 	}
	// 	return result;
	// }

    // function ajaxSubmit() {
    //     console.log($mc(form).serialize());
    //     $mc.ajax({
    //         type 		: $mc(form).attr('method'),
    //         dataType 	: 'json',
    //         url			: ajaxurl,
    //         data		: $mc(form).serialize() + '&action=' + $mc(form).data('action'),
    //         success 	: function(data)
    //         {
	// 			console.log(data);
    //         },
    //     });
    // }









});    

// Ajax loaded content
$mc(document).ajaxComplete(function() {
    // createCaseForm();
});