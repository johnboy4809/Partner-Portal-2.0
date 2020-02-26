<?php

$wp_session  = WP_Session::get_instance();
$wp_session['contact_id'] = 'OHdRcXpzL08yUFNhREh6YVIzUTk1T3NlcFp6dktNSDQ5a3UwbmlncE1rMGF4dkdsVHppbytHZDJBa0VrYlQwWQ==';
$wp_session['account_id'] = 'L1JPVGl4a0laK1Erc0UxUTFrOE1lS05pa214MEtZWCtRZ0xmMW1hQnpZQT0=';
$wp_session['account_sap_id'] = 'b0JOcDBPSVE1emdFbWl4YU5FZzk5Zz09';

    if (!MagiAccounts_Login::loggedIn()) {
        MagiConnect_Message::set('info', 'Login required');
        wp_redirect(site_url('/login', MagiConnect_Core::protocall()));
        exit;
    }

    $wp_session     = WP_Session::get_instance();
    $user           = MagiAccounts_User::contactDetails($wp_session['contact_id']);

    the_post();
    require_once("inc/header.php");
?>

<div class="grid-container">
    <div class="menu-icon">
        <i class="fal fa-bars"></i>
    </div>
    <?php require_once("inc/dashboard-header.php"); ?>
    <?php require_once("inc/dashboard-menu.php"); ?>
    <?php the_content(); ?>
    <footer class="dashboard-footer">
    </footer>
</div>

 <?php require_once("inc/footer.php"); ?>


