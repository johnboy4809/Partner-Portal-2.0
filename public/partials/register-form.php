<?php

$html .= "<div class=\"window login wide working-cont\">";
if ($wp_session['m']) {
    $html .= MagiConnect_Message::render();
} else {
    $html .= "<div class=\"message\"></div>";
}
$html .= "<div class=\"brand\">";
$html .= "<div class=\"logo\">";
$html .= "<a href=\"".site_url('/')."\">";
$html .= "<img class=\"mc-logo\" src=\"".get_template_directory_uri().'/assets/graphics/magicard.svg'."\" alt=\"Magicard | ".get_bloginfo('name')."\" />";
$html .= "</a>";
$html .= "</div>";
$html .= "<h3>Partner portal</h3>";
$html .= "</div>";
$html .= "<div class=\"formWrapper\">";
$html .= "<form method=\"post\" id=\"contactRegisterForm\" data-action=\"partnerContactRegister\">";
$html .= "<fieldset>";
$html .= "<legend>Register</legend>";
$html .= MagiConnect_Formfields::formField('', 'Dealer', 'hidden', 1, '');
$html .= "<div class=\"twoCol\">";
$html .= MagiConnect_Formfields::formField('Email', 'reg_email', 'email', '', 'minlength="5" required');
$html .= MagiConnect_Formfields::formField('Job Title', 'Title', 'text', '', 'maxlength="127" size="5" ');
$html .= "</div>";
$html .= "<div class=\"twoCol\">";
$html .= MagiConnect_Formfields::formField('First Name', 'FirstName', 'text', '', 'minlength="2" required size="25"');
$html .= MagiConnect_Formfields::formField('Last Name', 'LastName', 'text', '', 'minlength="2" required size="25"');
$html .= "</div>";
$html .= "<div class=\"twoCol\">";
$html .= MagiConnect_Formfields::formField('Work Phone', 'phone_work', 'text', '', 'required size="20"');
$html .= MagiConnect_Formfields::formField('Mobile Phone', 'phone_mobile', 'text', '', 'size="20"');
$html .= "</div>";
$html .= "<h4 class=\"h5\">Account Password</h4>";
$html .= "<p>Minimum 8 charactors containing at least one number, one lowercase and one uppercase letter</p>";
$html .= "<div class=\"twoCol\">";
$html .= MagiConnect_Formfields::formField('Password', 'set_password', 'password', '', 'required');
$html .= MagiConnect_Formfields::formField('Confirm', 'confirm', 'password', '', 'required');
$html .= "</div>";
$html .= "<h4 class=\"h5\">Company Account</h4>";
$html .= "<p>Please provide your companies account ID. This can be attainded from you Partner Portal Administrstor or by contacting Magicard <a href=\"mailto:support@magicard.com\">support@magicard.com.</a>";
$html .= "<div class=\"twoCol\">";
$html .= MagiConnect_Formfields::formField('Account ID', 'account_id', 'text', '', '');
$html .= "</div>";
$html .= "<div class=\"formElement\">";
$html .= "<h4 class=\"h5\">Contact Permission</h4>";
$html .= '<p>We\'d like to keep you updated on new printers, drivers, software as well as the latest deals on consumables from Magicard. We do not pass on your personal detals to third parties for marketing purposes.</p>';
$html .= "<input type=\"checkbox\" class=\"permission\" name=\"contact_permission_c\" value=\"0\"/> <strong>Yes please,</strong> I would like to hear about new products and offers.";
$html .= "</div>";
$html .= "<div class=\"formElement\">";
$html .= "<input type=\"checkbox\" name=\"agreed_to_pp_c\" id=\"agreed_to_pp_c\" required>";
$html .= " I have read and understood the <a href=\"https://magicard.com/legal/privacy/\" target=\"_blank\" rel=\"noopener\">privacy policy in full</a><span class=\"required\" aria-required=\"true\">&nbsp;*</span>";
$html .= "<div class=\"errorTxt_agreed_to_pp_c\"></div>";  
$html .= "</div>";
$html .= "<div class=\"form-buttons\">";
$html .= MagiConnect_Formfields::formField('', 'register', 'submit', 'Register', '');
$html .= "</div>";
$html .= "<a href=\"".site_url('/login')."\">Return to login in</a>";
$html .= "</fieldset>";
$html .= "</form>";
$html .= "</div>";
$html .= MagiConnect_Core::working();
$html .= "</div>"

?>