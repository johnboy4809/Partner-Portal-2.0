<?php

$html .= "<div class=\"main-grid\">";

$html .= "<div class=\"card table printers-table\">";
    $html .= "<header class=\"card-header filters\">";
        $html .= "<h4 class=\"h5\">{$user->account->name} printers <small><a href=\"".site_url('/printers')."\">View all printers</a></small></h4>";
        $html .= "<div class=\"datesfilters\">";
            $html .= "<input class=\"datepicker\" type=\"date\" id=\"bateFrom\" name=\"from\">";
            // $html .= "<input class=\"datepicker\" type=\"date\" id=\"bateto\" name=\"to\">";
        $html .= "</div>";
    $html .= "</header>";
    $html .= "<div class=\"table-headings printer-headings\" id=\"\">";
        $html .= "<div class=\"printer-class\">";
            $html .= "<span class=\"image\"></span>"; //class image
            // $html .= "<span class=\"serial\">Serial Number</span>";
            $html .= "<div class=\"serial colum-search\">";
                $html .= "<input id=\"serialSearch\" name=\"serial-search\" type=\"search\" placeholder=\"Searial Number - search\" value=\"\"/>";
                $html .= "<button class=\"button\" id=\"serialSearchBtn\"><i class=\"fal fa-search\"></i></button>";
            $html .= "</div>";
            // $html .= "<span class=\"class\">Product Class</span>";
            $html .= "<select id=\"selectClass\" class=\"class table-filter-select\">";
                $html .= "<option value=\"\">Product Class</option>";
                foreach ($printers->totals as $key => $val) {
                    $class = $classes->$key;
                    $html .= "<option value=\"{$key}\">{$class->name}</option>";
                }
            $html .= "</select>";
            // $html .= "<span class=\"desc\">Description</span>";
            $html .= "<span class=\"status\" >Status</span>";
        $html .= "</div>";
        $html .= "<div class=\"printer-warranty\">";
            $html .= "<span class=\"warranty\">Printer Warranty</span>";
        $html .= "</div>";
        $html .= "<div class=\"printer-upgrades\">";
            $html .= "<span class=\"keys\">Upgrades</span>";
            $html .= "<span class=\"reg\">Registrations</span>";
            $html .= "<span class=\"view\"></span>";
        $html .= "</div>";
    $html .= "</div>";

    $html .= "<div class=\"table-rows\" id=\"printerRows\" data-total=\"{$printers->total}\" data-perpage=\"10\">";
    // Loaded by ajax
    $html .= MagiConnect_Core::working();
    $html .= "</div>";
    $html .= "<div id=\"printerControls\" class=\"table-footer\"></div>";
$html .= "</div>";

$html .= "<div class=\"card contents serial-check\">";
    $html .= "<header class=\"card-header\">";
        $html .= "<h4 class=\"h5\">Manage new printer</h4>";
    $html .= "</header>";
    $html .= "<div class=\"card-content\">";
        $html .= "<form class=\"serial-check-form\" method=\"post\" id=\"serialCheck\" data-action=\"check-serial\">";
            $html .= "<div class=\"message\"></div>";
            $html .= "<fieldset>"; 
                $html .= "<p class=\"form-intro\">Please enter the serial number of your printer. Added printer can be managed and recieve support.</p>";
                $html .= MagiConnect_Formfields::formField('Printer serial', 'serial', 'text', '', '');
                $html .= "<div class=\"form-buttons\">";
                $html .= MagiConnect_Formfields::formField('', 'check', 'submit', 'Check serial', '');
                $html .= "</div>";
            $html .= "</fieldset>";
        $html .= "</form>";
        $html .= "<div class=\"found-printer\" id=\"printerInfo\">";
            $html .= MagiConnect_Core::working();
        $html .= "</div>";
    $html .= "</div>";
$html .= "</div>";

$html .= "<div class=\"card table list cases-table\">";
    $html .= "<header class=\"card-header\">";
        $html .= "<h4 class=\"h5\">Support Cases</h4>";
    $html .= "</header>";
    $html .= "<div class=\"table-rows\" id=\"caseRows\" data-total=\"{$cases->total}\" data-perpage=\"5\">";
    // Loaded by ajax
    $html .= MagiConnect_Core::working();
    $html .= "</div>";
    $html .= "<div id=\"caseControls\" class=\"table-footer\"></div>";
$html .= "</div>";

$html .= "<div class=\"card contents document-library\">";
$html .= "<header class=\"card-header\">";
$html .= "<h4 class=\"h5\">Document Library</h4>";
$html .= "</header>";
    $html .= "<div class=\"card-content\">";
    $html .= do_shortcode('[shareonedrive dir="9E8C785FF3D7BD96!106" account="9e8c785ff3d7bd96" mode="files" viewrole="administrator|author|contributor|editor|subscriber|guest" downloadrole="all"]');
    $html .= "</div>";
$html .= "</div>";

$html .= "<div class=\"card contents company-profile\">";
    $html .= "<header class=\"card-header\">";
        $html .= "<h4 class=\"h5\">{$user->account->name}</h4>";
    $html .= "</header>";
    $html .= "<div class=\"card-content\">";
        $html .= "<div class=\"account-logo\">";
            $html .= "<img src=\"{$user->account->logo}\" alt=\"{$user->account->name}\">";
        $html .= "</div>";
        $html .= "<div class=\"momentum\">";
            $html .= "<img src=\"http://wp_dealers.test/wp-content/themes/mc_base-child/assets/graphics/premier.png\">";
        $html .= "</div>";
        $html .= "<div class=\"account-info\">";
            $html .= "<div class=\"data-col\">";
                $html .= "<span class=\"data-label\">Company Name:</span>";
                $html .= "<span class=\"data-value\">{$user->account->name}</span>";
            $html .= "</div>";
            $html .= "<div class=\"data-col\">";
                $html .= "<span class=\"data-label\">Momentum:</span>";
                $html .= "<span class=\"data-value\">{$user->account->momentum_c}</span>";
            $html .= "</div>";
            $html .= "<div class=\"data-col\">";
                $html .= "<span class=\"data-label\">Website:</span>";
                $html .= "<span class=\"data-value\">{$user->account->website}</span>";
            $html .= "</div>";
            $html .= "<div class=\"data-col\">";
                $html .= "<a href=\"".site_url('/account')."\" class=\"blueBtn\">Edit Account</a>";
            $html .= "</div>";
        $html .= "</div>";
    $html .= "</div>";
$html .= "</div>";

$html .= "</div>";