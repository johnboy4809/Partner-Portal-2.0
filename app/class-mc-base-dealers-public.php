<?php

if (!defined('WPINC')) { die; }

class MC_Base_Dealers_Public 
{
    private $version;
    protected $loader;

    public function __construct($version) 
    {
        $this->version = $version;
    }

    public function enqueue_styles() {
        wp_enqueue_style('mc-base-dealer-styles', get_stylesheet_directory_uri().'/assets/css/dealers.min.css', array('mc-base-styles'), $this->version, false);
    }

    public function enqueue_scripts() {
        wp_enqueue_script('mc-base-dealer-public', get_stylesheet_directory_uri().'/assets/js/dealers.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script('charts', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js', array('jquery'), '0.8.3', true);
        wp_enqueue_script('charts-data', get_stylesheet_directory_uri().'/assets/js/charts.min.js', array('charts'), $this->version, true);
    }

    public function register_shortcodes() {
        require_once dirname( __DIR__).'/public/shortcodes/class-Dealer-Shortcodes.php';
    }

    public function add_query_vars($aVars) 
    {
        $aVars[] = "case-id";
        return $aVars;
    }

    public function add_rewrite_rules() 
    {
        add_rewrite_rule(
            'cases/([^/]*)/?$',
            'index.php?pagename=cases&case-id=$matches[1]',
            'top'
        );
    }



}

?>
