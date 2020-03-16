<?php

$wp_session = WP_Session::get_instance();

$html .= "<div class=\"window login working-cont\">";
$html .= "<div class=\"message\"></div>";
$html .= "<div class=\"brand\">";
$html .= "<div class=\"logo\">";
$html .= "<a href=\"".site_url('/')."\">";
$html .= "<img class=\"mc-logo\" src=\"".get_template_directory_uri().'/assets/graphics/magicard.svg'."\" alt=\"Magicard | ".get_bloginfo('name')."\" />";
$html .= "</a>";
$html .= "</div>";
$html .= "<h3>Dealer portal</h3>";
$html .= "</div>";
$html .= "<div class=\"formWrapper\">";
$html .= "<form method=\"post\" id=\"verifyEmail\" data-action=\"verify-email\">";
$html .= "<fieldset>";
$html .= "<legend>Account verified</legend>";
$html .= "<p>Thank you for verifying your account. You may now sign into your account.</p>";
$html .= "<div class=\"form-buttons\">";
$html .= "<a href=\"".site_url('/login')."\" class=\"blueBtn\">Sign in</a>";
$html .= "</div>";
$html .= "</fieldset>";
$html .= "</form>";
$html .= "</div>";
$html .= "</div>"

?>