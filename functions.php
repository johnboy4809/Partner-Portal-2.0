<?php

    if (!defined('ABSPATH')) exit;

    require_once get_theme_file_path('/app/class-mc-base-dealers.php');

    function run_mc_base_dealers() {
        $setup = new MC_Base_Dealers();
        $setup->run();
    }

    run_mc_base_dealers();


 ?> 