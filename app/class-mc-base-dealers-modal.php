<?php

if (!defined('WPINC')) { die; }

class MC_Base_Dealers_Modals
{

    public static function test() 
    {
        $result['post'] = MagiConnect_FormFields::POST();
        $result['files'] = $_FILES;
        echo json_encode($result);
        die();
    }

    public static function logout() 
    {
        $result = array('success' => false);

        MagiAccounts_Contact::logout();

        $url = site_url('/login', MagiConnect_Core::protocall());
        $html = "<div class=\"modal\">";
            $html .= "<div class=\"window logout-modal\" id=\"loggedout\">";
                $html .= "<h3 class=\"window-heading\">Securely logged out</h3>";
                $html .= "<p class=\"window-text\">You have been securely signed out. Click the button to sign back in.</p>";
                $html .= "<p><a href=\"{$url}\" class=\"blueBtn\">Sign In</button></p>";
            $html .= "</div>";
        $html .= "</div>";

        $result['html'] = $html;
        echo json_encode($result);
        die();
    }

    public static function checkSerialform() 
    {
        $result     = array('success' => false);

        $html = "<div class=\"modal\">";
            $html .= "<div class=\"window serial-check-modal\">";
                $html .= "<i class=\"window-close fal fa-times\"></i>";
                $html .= "<div class=\"message\"></div>";
                $html .= "<div class=\"modal-content\">";
                    $html .= "<form method=\"post\" id=\"modalSerialCheck\" data-action=\"check-serial\">";    
                        $html .= "<fieldset>";
                            $html .= "<legend>Manage new printer</legend>";
                            $html .= "<p class=\"form-intro\">Please enter the serial number of your printer. Added printer can be managed and recieve support.</p>";
                            $html .= MagiConnect_Formfields::formField('Printer serial', 'serial', 'text', '', '');
                            $html .= "<div class=\"form-buttons\">";
                                $html .= MagiConnect_Formfields::formField('', 'check', 'submit', 'Check serial', '');
                            $html .= "</div>";
                        $html .= "</fieldset>";
                    $html .= "</form>";
                    $html .= "<div class=\"found-printer\" id=\"modalPrinterInfo\">";
                        $html .= MagiConnect_Core::working();
                    $html .= "</div>";
                $html .= "</div>";
            $html .= "</div>";
        $html .= "</div>";

        $result['html'] = $html;
        echo json_encode($result);
        die();
    }

    public static function createCaseForm() 
    {
        $result     = array();
        $clean	    = MagiConnect_FormFields::POST();

        $html = "<div class=\"modal\">";
        $html .= "<div class=\"window create-case-modal\">";
        $html .= "<i class=\"window-close fal fa-times\"></i>";
        $html .= "<div class=\"message\"></div>";
        $html .= "<form method=\"post\" id=\"createCaseForm\" data-action=\"modal-create-case\" enctype=\"multipart/form-data\">";
        $html .= "<fieldset>";
        $html .= MagiConnect_Formfields::formField('', 'action', 'hidden', 'create-case', '');
        $html .= MagiConnect_Formfields::formField('', 'contact_id', 'hidden', $clean->contact_id, ''); 
        $html .= MagiConnect_Formfields::formField('', 'status', 'hidden', 'Open', ''); 
        $html .= MagiConnect_Formfields::formField('', 'origin', 'hidden', 'Web', ''); 
        $html .= "<legend>Create support case</legend>";
        if (!$clean->serial_id) {
            $html .= "<p class=\"window-text\">Enter a printer serial number to create a support case.</p>";
            $html .= MagiConnect_Formfields::formField('Printer serial', 'serial', 'text', '', '');
        }
        $html .= MagiConnect_Formfields::formField('', 'serial_id', 'hidden', $clean->serial_id, '');
        $html .= "<p>Please describe your issue or ask a question regarding your printer. You can also attachment an image or document to support your case.</p>";
        $problems = MagiConnect_SugarCRM::sugar_dropdown_transient('case-root', 'Cases/enum/customersstatedissue_c');
        $html .= MagiConnect_Formfields::dropDown('Problem', 'issue', '', '', $problems);
        $html .= MagiConnect_Formfields::formField('Description', 'issue_description', 'textarea', '', '');
        $html .= MagiConnect_Formfields::dragdropUpload();
        $html .= "<div class=\"form-buttons\">";
        $html .= MagiConnect_Formfields::formField('', 'create', 'submit', 'Create case', '');
        $html .= "</div>";
        $html .= "</fieldset>";
        $html .= "</form>";
        $html .= "<div class=\"found-printer-info\" id=\"\"></div>";
        $html .= MagiConnect_Core::working();
        $html .= "</div>";
        $html .= "</div>";

        $result['html'] = $html;
        echo json_encode($result);
        die();
    }




}



