<?php

if (!defined('WPINC')) { die; }

class MC_Base_Dealers_Products
{
    public static function loadPrinters() 
    {
        $wp_session = WP_Session::get_instance();
        $result     = array();
        $clean	    = MagiConnect_FormFields::POST();

        if ($clean->pn < 1) { 
            $clean->pn = 1; 
        } else if ($clean->pn > $clean->last) { 
            $clean->pn = $clean->last; 
        }

        $limit = 'LIMIT '.($clean->pn - 1) * $clean->rpp.','.$clean->rpp;

        $url        = 'Account/Printers';
        $details    = array(
            'ID'        => $wp_session['account_sap_id'],
            'byClass'   => $clean->byclass,
            'limit'     => $limit,
        );

        $printers   = MagiConnect_SugarCRM::getSugar(json_encode($details),$url,true);
        $result['query'] = $printers->sql;
        $result['html'] = self::printerTableRows($printers->printers);
        echo json_encode($result);
        die();
    }

    public static function consumables() 
    {
        $result     = array('success' => false);
        $wp_session = WP_Session::get_instance();
        $dealer     = $wp_session['account_id'];

        $merge = array_combine( $_POST['class'], $_POST['link'] );

        $args = array(
            'ID'            => $dealer,
            'consumables_c' => json_encode($merge),
        );
        $update = MagiAccounts_User::updateAccount($args);

        // $result['args'] = $args;
        // $result['update'] = $update;

        if (!$update->success) {
            MagiConnect_Message::set('error', $update->errors);
            $result['message'] = MagiConnect_Message::render(true);
            echo json_encode($result);
            die();
        }

        MagiAccounts_User::contactDetails($wp_session['contact_id'], true);
        MagiConnect_Message::set('info', 'Consumables list updated successfully.');
        $result['message'] = MagiConnect_Message::render(true);
        echo json_encode($result);
        die();
    }

    public static function printerDetails($printer) 
    {
        $result     = array();
        $clean	    = MagiConnect_FormFields::POST();
        $classes    = MagiAccounts_Products::product_class_array();
        $class      = $classes->{$clean->class};

        $result['html'] = self::displayClass($class);
        echo json_encode($result);
        die();
    }

    public static function checkSerial()
    {
        $result     = array();
        $clean	    = MagiConnect_FormFields::POST();
        $found 	    = MagiAccounts_Products::serialCheck($clean->serial);

        if (!$found->success) {
            MagiConnect_Message::set('error', 'Serial number not found.');
            $result['message'] = MagiConnect_Message::render(true);
            echo json_encode($result);
            die();
        }
        
        $class      = $found->serial->class_code;
        $classes    = MagiAccounts_Products::product_class_array();
        $class      = $classes->{$class};

        $result['html'] = self::displayClass($class, $found->serial);
        echo json_encode($result);
        die();
    }

    public static function addToAccount()
    {

    }

    private static function printerTableRows($printers)
    {
        $classes = MagiAccounts_Products::product_class_array();
        $html = "";
        foreach ($printers as $printer) {
            $code = $printer->class_code;
            $pclass = $classes->$code;
            $html .= "<div class=\"table-row printer-row\" role=\"row\" data-id=\"{$printer->id}\">";
                $html .= "<div class=\"printer-class\">";
                    $html .= "<div class=\"serial\" role=\"cell\">";
                    $html .= "<span><a href=\"\">{$printer->serial}</a></span>";
                    $html .= "</div>";
                    $html .= "<div class=\"class\" role=\"cell\">";
                    $html .= "<span class=\"class\">{$printer->class}</span>";
                    $html .= "<span class=\"code\">{$printer->product_code}</span>";
                    $html .= "</div>";
                    $html .= "<div class=\"image\">";
                    $html .= "<img src=\"{$pclass->class_image}\" alt=\"\">";
                    $html .= "</div>";
                    // $html .= "<div class=\"desc\" role=\"cell\">";
                    // $html .= "<span>{$printer->product_desc}</span>";
                    // $html .= "</div>";
                    $html .= "<div class=\"status\" role=\"cell\">";
                    $html .= "<span>{$printer->status}</span>";
                    $html .= "</div>";
                $html .= "</div>";
                $html .= "<div class=\"printer-warranty\">";
                    $timestamp = strtotime($printer->warranty_end);
                    $class = ($timestamp < time()) ? "ended" : "current";
                    $html .= "<div class=\"warranty\" role=\"cell\">";
                    $html .= "<span>Start: ".date("d/m/Y", strtotime($printer->warranty_start))."</span>";
                    $html .= "<span class=\"{$class}\">End: ".date("d/m/Y", strtotime($printer->warranty_end))."</span>";
                    $html .= "</div>";
                    $html .= "<div class=\"w-status\" role=\"cell\">";
                    $html .= "<span  class=\"{$class}\">{$printer->warranty_status}</span>";
                    $html .= "</div>";
                $html .= "</div>";
                $html .= "<div class=\"printer-upgrades\">";
                    $html .= "<div class=\"keys\" role=\"cell\">";
                    // $html .= "<span>{$printer->feature_keys}</span>";
                    $html .= "</div>";
                    $html .= "<div class=\"reg\" role=\"cell\">";
                    // $html .= "<span>{$printer->registrations}</span>";
                    $html .= "</div>";
                    $html .= "<div class=\"view\" role=\"cell\">";
                    $html .= "<span><a href=\"".site_url('/printer/'.$printer->id)."\">View printer</a></span>";
                    $html .= "</div>";
                $html .= "</div>";
            $html .= "</div>";
        }
        $html .= MagiConnect_Core::working();
        return $html;
    }

    private static function displayClass($class, $printer = '')
    {
        $html = "";
        $html = "<div class=\"class-image\">";
        $html .= "<img class=\"class-image\"src=\"{$class->class_image}\" alt=\"{$class->name}\">";
        $html .= "</div>";
        $html .= "<div class=\"class-info\">";
        $html .= "<h4 class=\"h4 title\">{$class->name}</h4>";
        $html .= "<h5 class=\"h5 sub-title\">{$printer->serial} <small>{$printer->status}</small></h5>";
        $html .= "<h6>Warranty {$printer->warranty_status}</h6>";
        $html .= "<p class=\"row\"><span class=\"key\">Warranty:</span><span class=\"value\">{$class->wrty_length} years</span></p>";
        $html .= "<p class=\"row\"><span class=\"key\">Start Date:</span><span class=\"value\">".date("d/m/Y", strtotime($printer->warranty_start))."</span></p>";
        $html .= "<p class=\"row\"><span class=\"key\">End Date:</span><span class=\"value\">".date("d/m/Y", strtotime($printer->warranty_end))."</span></p>";
        $html .= "<h6>Printer</h6>";
        $html .= "<p class=\"row\"><span class=\"key\">Desc:</span><span class=\"value\">{$printer->product_desc}</span></p>";
        $html .= "<p class=\"row\"><span class=\"key\">Family:</span><span class=\"value\">{$class->family}</span></p>";
        $html .= "<p class=\"row\"><span class=\"key\">Product code:</span><span class=\"value\">{$printer->product_code}</span></p>";
        $html .= "<p class=\"row\"><span class=\"key\">Class code:</span><span class=\"value\">{$printer->class_code}</span></p>";
        $upgrades = ($class->upgradable) ? '<i class="valid fal fa-check"></i>' : '<i class="fal fa-times"></i>';
        $html .= "<p class=\"row\"><span class=\"key\">Online upg:</span><span class=\"value\">{$upgrades}</span></p>";
        $html .= "<form class=\"\" method=\"post\" id=\"addPrinter\" data-action=\"add-to-account\">";
            $html .= MagiConnect_Formfields::formField('', 'serial_id', 'hidden', $printer->id, ''); 
            $html .= MagiConnect_Formfields::formField('', 'create', 'submit', 'Manage printer', '');
        $html .= "</form>";
        $html .= "</div>";
        return $html;
    }



}













