var $mc = jQuery.noConflict(); // remove conficts with $ for any plugin js

$mc(function() {
    'use strict';

    // ------ Add / Remove / save consumable rows  ------
    $mc('#addRow').on('click', function(e) {
        e.preventDefault();
        var i = $mc(this).data('new');
        var listitems = '';

        $mc.each(classArray, function(key, value){
            listitems += '<option value='+key+'>'+value+'</option>';
        }); 
        
        var html = '<div id="row'+i+'" class="table-row consumable-row" role="row">';
        html += '<div class="img"></div>';
        html += '<select id="class[]" name="class[]" class="inputSelect">';
        html += listitems;
        html += '</select>';
        html += '<input class="value" type="url" name="link[]" value="" placeholder="Enter consumables url">';
        html += '<span class="delete"><a href="" class="redBtn remove" id="remove'+i+'" data-remove="'+i+'">Delete</a></span>';
        html += '</div>';

        $mc('#rows').append(html);

        i++;
        $mc(this).data('new', i);
    })

    $mc(document).on('click', '.remove', function(e) {
        e.preventDefault();
        var i = $mc(this).data('remove');
        $mc('#row'+i+'').remove();
    }); 

    $mc("#consumablesForm").submit(function(e) {
        e.preventDefault();
        $mc.ajax({
            type 		: $mc(this).attr('method'),
            dataType 	: 'json',
            url			: ajaxurl,
            data		: $mc(this).serialize()+'&action='+$mc(this).data('action'),
            success 	: function(data) {
                console.log(data);
            },
            error 		: function(data) {
                $mc('.working').removeClass('show');
                console.log("ajax error, json: " + data);
            }
        });
    }); 
    // ------ Add / Remove / save consumable rows  ------

});    

// Ajax loaded content
$mc(document).ajaxComplete(function() {

});    
