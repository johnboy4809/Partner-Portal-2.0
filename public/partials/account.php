<?php

$contact = $user->contact;
$account = $user->account;

$html .= "<div class=\"page-header\">";
    $html .= "<div class=\"page-title\">";
        $html .= "<h3 class=\"title\">Account Information</h3>";
        $html .= "<p class=\"intro\">Some intro text needs to go here.</p>";
    $html .= "</div>";
$html .= "</div>";

$html .= "<div class=\"page-grid\">";
    $html .= "<div class=\"card contents contact\">";
        $html .= "<header class=\"card-header\">";
            $html .= "<h4 class=\"h5\">My Cases</h4>";
        $html .= "</header>";
        $html .= "<div class=\"card-content\">";
            $html .= "<div class=\"message\"></div>";
            $html .= "<p>Select a printer and describe your issue or ask a question regarding your printer. Attachment an images or documents to support your case.</p>";
            $html .= "<form method=\"post\" id=\"updateContactForm\" data-action=\"updateContact\" enctype=\"multipart/form-data\">";
                $html .= "<fieldset>";
                    $html .= MagiConnect_Formfields::inlineField('Username', 'username', 'email', $contact->portaluser_c, 'minlength="5" required');
                    $html .= MagiConnect_Formfields::inlineField('', 'id', 'hidden', $contact->id, '');
                $html .= "</fieldset>";    
                $html .= "<fieldset>";
                    $html .= MagiConnect_Formfields::inlineField('First Name', 'first_name', 'text', $contact->first_name, 'minlength="2" required size="25"');
                    $html .= MagiConnect_Formfields::inlineField('Last Name', 'last_name', 'text', $contact->last_name, 'minlength="2" required size="25"');
                    $html .= MagiConnect_Formfields::inlineField('Job Role / title', 'title', 'text', $contact->title, 'minlength="2" required size="25"');
                $html .= "</fieldset>";
                $html .= "<fieldset>";
                    $html .= MagiConnect_Formfields::inlineField('Work Phone', 'phone_work', 'text', $contact->phone_work, 'minlength="2" required size="25"');
                    $html .= MagiConnect_Formfields::inlineField('Mobile Phone', 'phone_mobile', 'text', $contact->phone_mobile, 'minlength="2" required size="25"');
                $html .= "</fieldset>";
                $html .= "<fieldset>";
                $html .= "<div class=\"formElement\">";
                    $html .= "<h4 class=\"h5\">Contact Permission</h4>";
                    $html .= '<p>We\'d like to keep you updated on new printers, drivers, software as well as the latest deals on consumables from Magicard. We do not pass on your personal detals to third parties for marketing purposes.</p>';
                    $html .= "<input type=\"checkbox\" class=\"permission\" name=\"contact_permission_c\" value=\"$contact->contact_permission_c\"/> <strong>Yes please,</strong> I would like to hear about new products and offers.";
                    $html .= "</div>";
                $html .= "</fieldset>";
                $html .= "<div class=\"form-buttons\">";
                    $html .= MagiConnect_Formfields::formField('', 'update', 'submit', 'Update', '');
                $html .= "</div>";
            $html .= "</form>";
        $html .= "</div>";
    $html .= "</div>";

    $html .= "<div class=\"card contents account\">";
        $html .= "<header class=\"card-header\">";
            $html .= "<h4 class=\"h5\">Create a case</h4>";
        $html .= "</header>";
        $html .= "<div class=\"card-content\">";

        $html .= "</div>";
    $html .= "</div>";
$html .= "</div>";

