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
$html .= "<form method=\"post\" id=\"verifyEmail\" data-action=\"verifyEmail\">";
$html .= "<fieldset>";
$html .= "<legend>Verify email</legend>";
$html .= "<p>Enter your account email and we will email you a verification email. Ckeck your junk folder if you have already tried to verify or send a new request.</p>";
$html .= MagiConnect_Formfields::formField('', 'url', 'hidden', 'verify', '');
$html .= MagiConnect_Formfields::formField('Email', 'Email', 'email', '', '');
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