<?php
/**
 * Template Name: logout
*/
$wp_session = WP_Session::get_instance();

echo "<pre>";
print_r($wp_session);
echo "</pre>";

// Delete transients
delete_transient($wp_session['contact_id']."_contact");
// Delete session
foreach($wp_session as $key => $value) {
    unset($wp_session[$key]);
};
wp_session_unset();

$wp_session = WP_Session::get_instance();

echo "<pre>";
print_r($wp_session);
echo "</pre>";