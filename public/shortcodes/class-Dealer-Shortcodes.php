<?php

if (! defined('WPINC')) { die; }

class Dealer_Shortcodes 
{

    public static function Home($atts, $content = "")
    {
        wp_enqueue_script('home-scripts', get_stylesheet_directory_uri().'/assets/js/home-page.min.js', array('mc-base-dealer-public'));
        wp_enqueue_script('charts', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js', array('jquery'), '0.8.3', true);
        wp_enqueue_script('charts-data', get_stylesheet_directory_uri().'/assets/js/charts.min.js', array('charts'), '1.0.0', true);

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

    public static function Cases($atts, $content = "") 
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

    public static function Consumables($atts, $content = "")
    {
        wp_enqueue_script('home-scripts', get_stylesheet_directory_uri().'/assets/js/consumables-page.min.js', array('mc-base-dealer-public'));

        $wp_session     = WP_Session::get_instance();
        $user           = MC_Base_Dealers_Contacts::contactDetails($wp_session['contact_id']);
        $consumables    = json_decode($user->account->consumables_c);
        $classes        = MagiAccounts_Products::product_class_array();
        
        $html           = "";
        $html .= "<main class=\"dashboard-content page consumables\" lang=\"en-UK\">";
        require_once(plugin_dir_path(dirname(__FILE__)).'partials/consumables.php');
        $html .= "</main>";
        return $html;
    }

    public static function upgrades($atts, $content = "")
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

    // Contact Shortcodes
    public static function Login($atts, $content = "")
    {
        $wp_session = WP_Session::get_instance();
        if (MagiAccounts_Contact::loggedIn()) {
			wp_redirect(site_url('/', MagiConnect_Core::protocall()));
			exit;
        }

        wp_enqueue_script('register', get_stylesheet_directory_uri().'/assets/js/login-page.min.js', array('mc-base-main-public'), '1.0.0', true);
        
        $html = '';
        require_once(plugin_dir_path(dirname(__FILE__)).'partials/login-form.php');
        return $html;
    }

    public static function Register($atts, $content = "") 
    {
        $wp_session = WP_Session::get_instance();
        if (MagiAccounts_Contact::loggedIn()) {
			wp_redirect(site_url('/', MagiConnect_Core::protocall()));
			exit;
        }

        wp_enqueue_script('register', get_stylesheet_directory_uri().'/assets/js/register-page.min.js', array('mc-base-main-public'), '1.0.0', true);

        $html = '';
        require_once(plugin_dir_path(dirname(__FILE__)).'partials/register-form.php');
        return $html;
    }

    public static function Verify($atts, $content = "")
    {
        $wp_session = WP_Session::get_instance();
        if (MagiAccounts_Contact::loggedIn()) {
			wp_redirect(site_url('/', MagiConnect_Core::protocall()));
			exit;
        }

        if (get_query_var('token') !== '') {
            $token = get_query_var('token');
            $verified = MagiConnect_Core::verifyToken($token, 'verify_');
            if ($verified) {
                MagiAccounts_Contact::verifyContact($verified);
                $html = '';
                require_once(plugin_dir_path(dirname(__FILE__)).'partials/verified.php');
                return $html;
            }
        }

        wp_enqueue_script('verify', get_stylesheet_directory_uri().'/assets/js/verify-account-page.min.js', array('mc-base-main-public'), '1.0.0', true);

        $html = '';
        require_once(plugin_dir_path(dirname(__FILE__)).'partials/verify-form.php');
        return $html;
    }

    public static function ResetPW($atts, $content = "") 
    {
        $wp_session = WP_Session::get_instance();
        if (MagiAccounts_Contact::loggedIn()) {
			wp_redirect(site_url('/', MagiConnect_Core::protocall()));
			exit;
        }
        
        wp_enqueue_script('login', get_stylesheet_directory_uri().'/assets/js/reset-password-page.min.js', array('mc-base-main-public'), '1.0.0', true);

        if (get_query_var('token') !== '') {
            $token = get_query_var('token');
            $verified = MagiConnect_Core::verifyToken($token, 'resetpw_');
            if ($verified) {
                $html = '';
                require_once(plugin_dir_path(dirname(__FILE__)).'partials/reset-password-form.php');
                return $html;
            }
        }

        $html = '';
        require_once(plugin_dir_path(dirname(__FILE__)).'partials/reset-password-email.php');
        return $html;
    }

    public static function Account($atts, $content = "")
    {
        wp_enqueue_script('home-scripts', get_stylesheet_directory_uri().'/assets/js/account-page.min.js', array('mc-base-dealer-public'));
        
        $wp_session  = WP_Session::get_instance();
        $user        = MC_Base_Dealers_Contacts::contactDetails($wp_session['contact_id']);

        $html       = "";
        $html .= "<main class=\"dashboard-content page account\" lang=\"en-UK\">";
        require_once(plugin_dir_path(dirname(__FILE__)).'partials/account.php');
        $html .= "</main>";
        return $html;
    }
}

$class_methods = get_class_methods('Dealer_Shortcodes');
    foreach ($class_methods as $method) {
    add_shortcode('MC_Dealers_'.$method, array('Dealer_Shortcodes', $method));
}


?>
