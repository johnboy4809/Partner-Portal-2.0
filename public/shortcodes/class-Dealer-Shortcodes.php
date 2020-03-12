<?php

if (! defined('WPINC')) { die; }

class Dealer_Shortcodes 
{

    public static function Home() 
    {
        wp_enqueue_script('home-scripts', get_stylesheet_directory_uri().'/assets/js/home-page.min.js', array('mc-base-dealer-public'));

        $wp_session = WP_Session::get_instance();
        $user       = MagiAccounts_User::contactDetails($wp_session['contact_id']);
        $cases      = MagiAccounts_Case::accountCases($wp_session['contact_id']);
        $printers   = MagiAccounts_Products::accountPrinters($wp_session['account_sap_id']);
        $classes    = MagiAccounts_Products::product_class_array();
        $html       = "";
        $html .= "<main class=\"dashboard-content\" lang=\"en-UK\">";
        require_once(plugin_dir_path(dirname(__FILE__)).'partials/home-stats.php');
        require_once(plugin_dir_path(dirname(__FILE__)).'partials/home-grid.php');
        $html .= "</main>";
        return $html;
    }

    public static function Cases() 
    {
        wp_enqueue_script('home-scripts', get_stylesheet_directory_uri().'/assets/js/cases-page.min.js', array('mc-base-dealer-public'));
        
        $wp_session = WP_Session::get_instance();
        $cases      = MagiAccounts_Case::accountCases($wp_session['contact_id'], true);
        $html       = "";
        $html .= "<main class=\"dashboard-content page cases\" lang=\"en-UK\">";
        require_once(plugin_dir_path(dirname(__FILE__)).'partials/cases.php');
        $html .= "</main>";
        return $html;
    }

    public static function Consumables() 
    {
        wp_enqueue_script('home-scripts', get_stylesheet_directory_uri().'/assets/js/consumables-page.min.js', array('mc-base-dealer-public'));

        $wp_session     = WP_Session::get_instance();
        $user           = MagiAccounts_User::contactDetails($wp_session['contact_id']);
        $consumables    = json_decode($user->account->consumables_c);
        $classes        = MagiAccounts_Products::product_class_array();
        $html           = "";
        $html .= "<main class=\"dashboard-content page consumables\" lang=\"en-UK\">";
        require_once(plugin_dir_path(dirname(__FILE__)).'partials/consumables.php');
        $html .= "</main>";
        return $html;
    }

    public static function upgrades() 
    {
        //wp_enqueue_script('home-scripts', get_stylesheet_directory_uri().'/assets/js/consumables-page.min.js', array('mc-base-dealer-public'));

        $wp_session     = WP_Session::get_instance();
        $user           = MagiAccounts_User::contactDetails($wp_session['contact_id']);
        $classes        = MagiAccounts_Products::product_class_array();
        $html           = "";
        $html .= "<main class=\"dashboard-content page consumables\" lang=\"en-UK\">";
        require_once(plugin_dir_path(dirname(__FILE__)).'partials/upgrades.php');
        $html .= "</main>";
        return $html;
    }

}

$class_methods = get_class_methods('Dealer_Shortcodes');
    foreach ($class_methods as $method) {
    add_shortcode('MC_Dealers_'.$method, array('Dealer_Shortcodes', $method));
}


?>
