<?php
    if (!MagiAccounts_Contact::loggedIn()) {
        MagiConnect_Message::set('info', 'Login required');
        wp_redirect(site_url('/login', MagiConnect_Core::protocall()));
        exit;
    }
    $wp_session  = WP_Session::get_instance();
    $contact     = MC_Base_Dealers_Contacts::contactDetails($wp_session['contact_id']);
    $wp_session['account_id']       = MagiConnect_Core::obfuscate('encrypt',$contact->account->id);
    $wp_session['account_sap_id']   = MagiConnect_Core::obfuscate('encrypt',$contact->account->account_id_sap_c);

    echo "<pre>";
    print_r($wp_session);
    echo "</pre>";

    the_post();
    require_once("inc/header.php");
?>

<div class="grid-container">
    <div class="menu-icon">
        <i class="fal fa-bars"></i>
    </div>
    <?php require_once("inc/dashboard-header.php"); ?>
    <?php require_once("inc/dashboard-menu.php"); ?>
    <?php //the_content(); ?>
    <footer class="dashboard-footer">
    </footer>
</div>

 <?php require_once("inc/footer.php"); ?>
