<?php

$open       = $cases->totals->Open + $cases->totals->Assigned;
$closed     = $cases->totals->Closed;

$html .= "<div class=\"page-header\">";
    $html .= "<div class=\"page-title\">";
        $html .= "<h3 class=\"title\">My Product support case</h3>";
        $html .= "<p class=\"intro\">Some intro text needs to go here.</p>";
    $html .= "</div>";
$html .= "</div>";

$html .= "<div class=\"page-grid\">";
    $html .= "<div class=\"card table cases-grid\">";
        $html .= "<header class=\"card-header\">";
            $html .= "<h4 class=\"h5\">My Cases</h4>";
        $html .= "</header>";
        $html .= "<div class=\"case-filter\">";

        $html .= "</div>";
        $html .= "<div class=\"table-rows\" id=\"caseRows\" data-total=\"{$cases->total}\" data-perpage=\"20\">";
        // Loaded by ajax
        $html .= MagiConnect_Core::working();
        $html .= "</div>";
        $html .= "<div id=\"caseControls\" class=\"table-footer pagination\"></div>";
        $html .= "<div class=\"the-case\">";
            $html .= "<div id=\"showCase\" class=\"caseWrapper\">";
            // Loaded by ajax
            $html .= "</div>";
            $html .= MagiConnect_Core::working();
        $html .= "</div>";
    $html .= "</div>";

    $html .= "<div class=\"card cases-overview\">";
        $html .= "<header class=\"card-header\">";
            $html .= "<h4 class=\"h5\">Support Cases Overview <small><a href=\"".site_url('/cases')."\">View all cases</a></small></h4>";
        $html .= "</header>";
        $html .= "<div class=\"stat case-total\">";
            $html .= "<span class=\"amount\">$cases->total</span>";
            $html .= "<span class=\"amount-title\">Total cases</span>";
        $html .= "</div>";
        $html .= "<div class=\"stat case-open\">";
            $html .= "<span class=\"amount\">$open <small>of $cases->total</small></span>";
            $html .= "<span class=\"amount-title\">Open cases</span>";
        $html .= "</div>";
        $html .= "<div class=\"stat case-closed\">";
            $html .= "<span class=\"amount\">$closed <small>of $cases->total</small></span>";
            $html .= "<span class=\"amount-title\">Closed cases</span>";
        $html .= "</div>";
        $html .= "<div class=\"chartjs\">";
            $html .= "<canvas id=\"myChart\" width=\"100px\" height=\"100px\"></canvas>";
        $html .= "</div>";
    $html .= "</div>";

    $html .= "<div class=\"card contents cases-form\">";
        $html .= "<header class=\"card-header\">";
            $html .= "<h4 class=\"h5\">Create a case</h4>";
        $html .= "</header>";
        $html .= "<div class=\"card-content\">";
            $html .= "<p>Select a printer and describe your issue or ask a question regarding your printer. Attachment an images or documents to support your case.</p>";
            $html .= "<form method=\"post\" id=\"createCaseForm\" data-action=\"modal-create-case\" enctype=\"multipart/form-data\">";
                $html .= "<fieldset>";
                    $html .= MagiConnect_Formfields::formField('', 'action', 'hidden', 'create-case', '');
                    $html .= MagiConnect_Formfields::formField('', 'contact_id', 'hidden', $wp_session['contact_id'], ''); 
                    $html .= MagiConnect_Formfields::formField('', 'status', 'hidden', 'Open', ''); 
                    $html .= MagiConnect_Formfields::formField('', 'origin', 'hidden', 'Web', ''); 
                    $html .= MagiConnect_Formfields::formField('', 'serial_id', 'hidden', '', '');
                    // $html .= "<p>Enter a printer serial number to create a support case.</p>";
                    // $html .= "<p>Please describe your issue or ask a question regarding your printer. You can also attachment an image or document to support your case.</p>";
                    $html .= "<div class=\"twoCol\">";
                        $html .= MagiConnect_Formfields::formField('Printer serial', 'serial', 'text', '', '');
                        $problems = MagiConnect_SugarCRM::sugar_dropdown_transient('case-root', 'Cases/enum/customersstatedissue_c');
                        $html .= MagiConnect_Formfields::dropDown('Problem', 'issue', '', '', $problems);
                    $html .= "</div>";
                    $html .= MagiConnect_Formfields::formField('Description', 'issue_description', 'textarea', '', '');
                    $html .= MagiConnect_Formfields::dragdropUpload();
                    $html .= "<div class=\"form-buttons\">";
                        $html .= MagiConnect_Formfields::formField('', 'create', 'submit', 'Create case', '');
                    $html .= "</div>";
                $html .= "</fieldset>";
            $html .= "</form>";
        $html .= "</div>";
    $html .= "</div>";
$html .= "</div>";
