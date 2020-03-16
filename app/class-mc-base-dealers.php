<?php
    if (!defined('ABSPATH')) exit;

    class MC_Base_Dealers 
    {

        protected $loader;
        protected $plugin_slug;
        protected $version;

        public function __construct() 
        {
            $this->plugin_slug = 'magicard';
            $this->version = '1.0.0';
            $this->load_dependencies();
            $this->define_admin_hooks();
            $this->define_public_hooks();
        }

        private function load_dependencies() 
        {
            require_once get_theme_file_path('/app/class-mc-base-dealers-public.php');
            require_once get_theme_file_path('/app/class-mc-base-dealers-contacts.php');
            require_once get_theme_file_path('/app/class-mc-base-dealers-modal.php');
            require_once get_theme_file_path('/app/class-mc-base-dealers-products.php');
            require_once get_theme_file_path('/app/class-mc-base-dealers-cases.php');
            require_once get_theme_file_path('/app/class-mc-base-dealers-charts.php');
            // Theme loader
            require_once get_theme_file_path('/app/class-mc-base-dealers-loader.php');
            $this->loader = new MC_Base_Dealers_Loader();
        }

        private function define_admin_hooks()
        {

        }

        private function define_public_hooks()
        {
            $public = new MC_Base_Dealers_Public($this->get_version());
            $this->loader->add_action('wp_enqueue_scripts', $public, 'enqueue_scripts');
            $this->loader->add_action('wp_enqueue_scripts', $public, 'enqueue_styles');
            $this->loader->add_action('init', $public, 'register_shortcodes');
            $this->loader->add_filter('query_vars', $public, 'add_query_vars');
            $this->loader->add_action('init', $public, 'add_rewrite_rules' );
            // Contact Ajax
            $this->loader->add_action('wp_ajax_regEmailCheck', 'MC_Base_Dealers_Contacts', 'contactEmailCheck');
            $this->loader->add_action('wp_ajax_nopriv_regEmailCheck', 'MC_Base_Dealers_Contacts', 'contactEmailCheck');
            $this->loader->add_action('wp_ajax_partnerContactRegister', 'MC_Base_Dealers_Contacts', 'registerContact');
            $this->loader->add_action('wp_ajax_nopriv_partnerContactRegister', 'MC_Base_Dealers_Contacts', 'registerContact');
            $this->loader->add_action('wp_ajax_verifyEmail', 'MC_Base_Dealers_Contacts', 'verifyContact');
            $this->loader->add_action('wp_ajax_nopriv_verifyEmail', 'MC_Base_Dealers_Contacts', 'verifyContact');
            $this->loader->add_action('wp_ajax_reset-email', 'MC_Base_Dealers_Contacts', 'resetPWEmail');
            $this->loader->add_action('wp_ajax_nopriv_reset-email', 'MC_Base_Dealers_Contacts', 'resetPWEmail');
            $this->loader->add_action('wp_ajax_reset-pw', 'MC_Base_Dealers_Contacts', 'resetPW');
            $this->loader->add_action('wp_ajax_nopriv_reset-pw', 'MC_Base_Dealers_Contacts', 'resetPW');
            $this->loader->add_action('wp_ajax_login', 'MC_Base_Dealers_Contacts', 'login');
            $this->loader->add_action('wp_ajax_nopriv_login', 'MC_Base_Dealers_Contacts', 'login');
            $this->loader->add_action('wp_ajax_updateContact', 'MC_Base_Dealers_Contacts', 'updateContact');
            $this->loader->add_action('wp_ajax_nopriv_updateContact', 'MC_Base_Dealers_Contacts', 'updateContact');
            // Form Ajax  
            $this->loader->add_action('wp_ajax_check-serial', 'MC_Base_Dealers_Products', 'checkSerial');
            $this->loader->add_action('wp_ajax_nopriv_check-serial', 'MC_Base_Dealers_Products', 'checkSerial');
            $this->loader->add_action('wp_ajax_add-to-account', 'MC_Base_Dealers_Products', 'addToAccount');
            $this->loader->add_action('wp_ajax_nopriv_add-to-account', 'MC_Base_Dealers_Products', 'addToAccount');
            $this->loader->add_action('wp_ajax_create-case', 'MagiAccounts_Case', 'createCase');
            $this->loader->add_action('wp_ajax_nopriv_create-case', 'MagiAccounts_Case', 'createCase');   
            $this->loader->add_action('wp_ajax_consumables', 'MC_Base_Dealers_Products', 'consumables');
            $this->loader->add_action('wp_ajax_nopriv_consumables', 'MC_Base_Dealers_Products', 'consumables');               
            // Modal Ajax
            $this->loader->add_action('wp_ajax_modal-logout', 'MC_Base_Dealers_Modals', 'logout');
            $this->loader->add_action('wp_ajax_nopriv_modal-logout', 'MC_Base_Dealers_Modals', 'logout');
            $this->loader->add_action('wp_ajax_modal-check-serial-form', 'MC_Base_Dealers_Modals', 'checkSerialform');
            $this->loader->add_action('wp_ajax_nopriv_modal-check-serial-form', 'MC_Base_Dealers_Modals', 'checkSerialform');
            $this->loader->add_action('wp_ajax_modal-create-case-form', 'MC_Base_Dealers_Modals', 'createCaseForm');
            $this->loader->add_action('wp_ajax_nopriv_modal-create-case-form', 'MC_Base_Dealers_Modals', 'createCaseForm');
            // Chart Ajax
            $this->loader->add_action('wp_ajax_chart-cases-totals', 'MC_Base_Dealers_Charts', 'cases');
            $this->loader->add_action('wp_ajax_nopriv_chart-cases-totals', 'MC_Base_Dealers_Charts', 'cases');
            $this->loader->add_action('wp_ajax_chart-class-totals', 'MC_Base_Dealers_Charts', 'printers');
            $this->loader->add_action('wp_ajax_nopriv_chart-class-totals', 'MC_Base_Dealers_Charts', 'printers');
            // Table Ajax
            $this->loader->add_action('wp_ajax_printer-rows', 'MC_Base_Dealers_Products', 'loadPrinters');
            $this->loader->add_action('wp_ajax_nopriv_printer-rows', 'MC_Base_Dealers_Products', 'loadPrinters');
            // $this->loader->add_action('wp_ajax_printerInfo', 'MC_Base_Dealers_Products', 'printerDetails');
            // $this->loader->add_action('wp_ajax_nopriv_printerInfo', 'MC_Base_Dealers_Products', 'printerDetails');
            $this->loader->add_action('wp_ajax_case-rows', 'MC_Base_Dealers_Cases', 'loadCases');
            $this->loader->add_action('wp_ajax_nopriv_case-rows', 'MC_Base_Dealers_Cases', 'loadCases');
            $this->loader->add_action('wp_ajax_loadCase', 'MC_Base_Dealers_Cases', 'loadCase');
            $this->loader->add_action('wp_ajax_nopriv_loadCase', 'MC_Base_Dealers_Cases', 'loadCase');
        }

        public function run() 
        {
            $this->loader->run();
        }

        public function get_version() 
        {
            return $this->version;
        }


    }   