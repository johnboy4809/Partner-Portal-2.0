<?php

if (!defined('WPINC')) { die; }

class MC_Base_Dealers_Charts
{
    public static function cases()
    {
        $result         = array('success' => false); 
        $wp_session     = WP_Session::get_instance();
        $cases          = MagiAccounts_Case::accountCases($wp_session['contact_id']); 

        if (!$cases->total > 0) {
            echo json_encode($result);
            die();
        }

        foreach ($cases->totals as $key => $val) {
            $result['labels'][] = $key;
            $result['values'][] = $val;
        }

        echo json_encode($result);
        die();
    }

    public static function printers()
    {
        $result         = array('success' => false); 
        $wp_session     = WP_Session::get_instance();
        $printers       = MagiAccounts_Products::accountPrinters($wp_session['account_sap_id']); 

        if (!$printers->total > 0) {
            echo json_encode($result);
            die();
        }

        foreach ($printers->totals as $key => $val) {
            $result['labels'][] = $key;
            $result['values'][] = $val;
        }

        echo json_encode($result);
        die();
    }





}

