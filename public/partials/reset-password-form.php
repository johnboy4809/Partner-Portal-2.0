<?php

$wp_session = WP_Session::get_instance();

$html .= "<div class=\"window login working-cont\">";
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
$html .= "<h3>Dealer portal</h3>";
$html .= "</div>";
$html .= "<div class=\"formWrapper\">";
$html .= "<form method=\"post\" id=\"resetPW\" data-action=\"reset-pw\">";
$html .= "<fieldset>";
$html .= "<legend>Change password</legend>";
$html .= "<p>Please enter your new password. Minimum 8 charactors containing at least one number, one lowercase and one uppercase letter</p>";
$html .= MagiConnect_Formfields::formField('', 'token', 'hidden', $token, '');
$html .= MagiConnect_Formfields::formField('', 'contact_id', 'hidden', $verified, '');
$html .= MagiConnect_Formfields::formField('New password', 'set_password', 'password', '', '');
$html .= MagiConnect_Formfields::formField('Confirm', 'confirm', 'password', '', '');
$html .= "<div class=\"form-buttons\">";
$html .= MagiConnect_Formfields::formField('', 'signin', 'submit', 'Send Reset', '');
$html .= "</div>";
$html .= "<p><a href=\"".site_url('/login')."\" id=\"lost-password\">Back to login</a></p>";
$html .= "</fieldset>";
$html .= "</form>";
$html .= "</div>";
$html .= MagiConnect_Core::working();
$html .= "</div>"

?>