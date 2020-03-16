<?php

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
$html .= "<h3>Partner portal</h3>";
$html .= "</div>";
$html .= "<div class=\"formWrapper\">";
$html .= "<form method=\"post\" id=\"loginForm\" data-action=\"login\">";
$html .= "<fieldset>";
$html .= "<legend>Login</legend>";
$html .= MagiConnect_Formfields::formField('', 'redirect', 'hidden', $wp_session['afterLogin'], '');
$html .= MagiConnect_Formfields::formField('Email', 'email', 'email', '', '');
$html .= MagiConnect_Formfields::formField('Password', 'password', 'password', '', '');
$html .= "<div class=\"form-buttons\">";
$html .= MagiConnect_Formfields::formField('', 'signin', 'submit', 'Sign In', '');
$html .= "<div class=\"or\"><h3>or</h3></div>";
$html .= "<a href=\"".site_url('/register')."\" class=\"lineBtn\">Register</a>";
$html .= "</div>";
$html .= "<p><a href=\"".site_url('/resetpw')."\" id=\"lost-password\">forgotten password?</a></p>";
$html .= "</fieldset>";
$html .= "</form>";
$html .= "</div>";
$html .= MagiConnect_Core::working();
$html .= "</div>"

?>