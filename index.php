<?php
    the_post();
    require_once("inc/header.php");

    $wp_session  = WP_Session::get_instance();
    $wp_session['contact_id'] = 'OHdRcXpzL08yUFNhREh6YVIzUTk1T3NlcFp6dktNSDQ5a3UwbmlncE1rMGF4dkdsVHppbytHZDJBa0VrYlQwWQ==';
    $wp_session['account_id'] = 'L1JPVGl4a0laK1Erc0UxUTFrOE1lS05pa214MEtZWCtRZ0xmMW1hQnpZQT0=';
    $wp_session['account_sap_id'] = 'b0JOcDBPSVE1emdFbWl4YU5FZzk5Zz09';

    $data = MagiAccounts_Case::accountCases($wp_session['contact_id'], true);

    echo "<h1>API Tests</h1>";
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    require_once("inc/footer.php"); 
?>
