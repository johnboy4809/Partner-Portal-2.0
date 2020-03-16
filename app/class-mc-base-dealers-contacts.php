<?php

if (! defined('WPINC')) {die;}

class MC_Base_Dealers_Contacts
{

    public static function login()
    {
        $result  = array('success' => false);
        $clean	 = MagiConnect_FormFields::POST();
        $found   = MagiAccounts_Contact::findByUsername($clean->email);
        $hashed  = MagiConnect_Core::passwordHash($clean->password);

        // Find account
        if (!$found) {
            MagiConnect_Message::set('error', 'Unknown email/password combination, please try again.');
            $result['message'] = MagiConnect_Message::render(true);
            echo json_encode($result);
            die();
        }

        // Dealer Account
        if (!$found->dealer_contact_c) {
            MagiConnect_Message::set('error', 'This site is for Magicard partners only.');
            $result['message'] = MagiConnect_Message::render(true);
            echo json_encode($result);
            die();
        }

        // Check account is updated in SugarCRM
        if (empty($found->registrationpassword_c) || (strpos($found->registrationpassword_c, '*') !== false)) {
            $url = site_url('/resetpw', MagiConnect_Core::protocall());
            $result['working'] = "Redirecting...";
            $result['url'] = $url;
            echo json_encode($result);
            die();
        }

        // Account verified
        if ($found->bademail_c) {
            $url    = site_url('/verify', MagiConnect_Core::protocall());
            $button = "<a href=\"{$url}\" class=\"inputButton whiteBtn\">Click to verify</a>";
            MagiConnect_Message::set('info', "Your account has not been verified please chack your emails or {$button}");
            $result['message'] = MagiConnect_Message::render(true);
            $result['url']	   = $url;
            echo json_encode($result);
            die();
        }

        // Account password check
        if ($found->registrationpassword_c != $hashed) {
            MagiConnect_Message::set('error', 'Unknown email/password combination, please try again.');
            $result['message'] = MagiConnect_Message::render(true);
            echo json_encode($result);
            die();
        }

        $wp_session = WP_Session::get_instance();
        $wp_session['contact_id'] = MagiConnect_Core::obfuscate('encrypt',$found->id);

        $result['success'] 	= true;
        $result['working']	= "Logging you in...";
        $result['url']		= site_url('/', MagiConnect_Core::protocall());
        echo json_encode($result);
		die();
    }

    public static function contactDetails($ID, $force = false, $expiry = 60 * MINUTE_IN_SECONDS) 
    {
        if (false === ($contact = get_transient($ID.'_contact')) || $force) {
            $bean       = MagiAccounts_Contact::contactDetails($ID);
            $contact    = (object)[];

            if ($bean) {
                $contact        = $bean;
                // Get Avatar
                if ($bean->contact->picture) {
                    $url        = "Contacts/{$bean->contact->id}/file";
                    $fileinfo   = MagiConnect_SugarCRM::getSugar('', $url);
                    $fileExt    = MagiConnect_Core::mime2ext($fileinfo->picture->{'content-type'});
                    $folder     = self::$user_folder.'/'.$bean->contact->id.'/avatar';
                    $contact->contact->avatar = MagiConnect_Core::downloadToWP("{$url}/picture", "{$fileinfo->picture->name}.{$fileExt}", $folder);
                }
                // Get Account
                if ($bean->account->logo_c) {
                    $url        = "Accounts/{$bean->account->id}/file";
                    $fileinfo   = MagiConnect_SugarCRM::getSugar('', $url);
                    $fileExt    = MagiConnect_Core::mime2ext($fileinfo->logo_c->{'content-type'});
                    $folder     = MagiAccounts_Account::$account_folder.'/'.$bean->account->id.'/logo';
                    $contact->account->logo = MagiConnect_Core::downloadToWP("{$url}/logo_c", "{$fileinfo->logo_c->name}.{$fileExt}", $folder);
                }
                $contact = json_encode($contact);
                set_transient($ID.'_contact', $contact, $expiry);
            }
        }
        return json_decode($contact);
    }

    public static function registerContact()
    {
        $result         = array('success' => false);
        $clean	        = MagiConnect_FormFields::POST();
        $clean->opt_out = (isset($clean->opt_out)) ? 0 : 1; 

        $register = MagiAccounts_Contact::registerContact($clean); 
        if ($register) {
            if (MagiAccounts_Contact::putToken($register, 'verify')) {
                MagiConnect_Message::set('ok', 'Your account has been created successfully. Plaese check your inbox to vertify your account.');
                $result['message']  = MagiConnect_Message::render(true);
                echo json_encode($result);
                die();
            }
            MagiConnect_Message::set('error', 'Verify token could not be set.');
            $result['message']  = MagiConnect_Message::render(true);
            echo json_encode($result);
            die();
        }

        MagiConnect_Message::set('error', 'There was ap problem creating your account.');
        $result['message'] = MagiConnect_Message::render(true);
        echo json_encode($result);
        die();
    }

    public static function contactEmailCheck()
    {
        $result   = array('success' => false);
		$clean    = MagiConnect_FormFields::POST(); 
		$check    = MagiAccounts_Contact::emailCheck($clean->reg_email);

		if (!$check) {
			$result['success'] = true;
			echo json_encode($result);
			die();
		}

		echo json_encode($result);
		die();
    }

    public static function verifyContact()
    {
        $result   = array('success' => false);
        $clean    = MagiConnect_FormFields::POST(); 
        $found 	  = MagiAccounts_Contact::findByUsername($clean->Email);

        if ($found) {
            MagiAccounts_Contact::putToken($found->id, 'verify');
        }

        MagiConnect_Message::set('info', 'A verification email has been sent to this address.');
        $result['message']  = MagiConnect_Message::render(true);
        echo json_encode($result);
        die();
    }

    public static function updateContact()
    {
        $result   = array('success' => false);
        $clean    = MagiConnect_FormFields::POST(); 
        $ID       = $clean->id; 

        unset($clean->id);
        unset($clean->action);
        unset($clean->update);

        $update   = MagiAccounts_Contact::updateContact($ID, $clean);

        if ($update) {
            MagiConnect_Message::set('ok', 'Your details were updated successfully.');
            $result['message']  = MagiConnect_Message::render(true);
            echo json_encode($result);
            die();
        }

        MagiConnect_Message::set('error', 'There was a problem updating your account.');
        $result['message']  = MagiConnect_Message::render(true);
        echo json_encode($result);
        die();
    }

    public static function resetPWEmail()
    {
        $result   = array('success' => false);
        $clean    = MagiConnect_FormFields::POST(); 
        $found 	  = MagiAccounts_Contact::findByUsername($clean->Email);

        if ($found) {
            MagiAccounts_Contact::putToken($found->id, 'resetpw');
        }

        MagiConnect_Message::set('info', 'A reset request has been sent to your email address.');
        $result['message'] = MagiConnect_Message::render(true);
        echo json_encode($result);
        die();
    }

    public static function resetPW()
    {
        $result     = array('success' => false);
        $clean	    = MagiConnect_FormFields::POST();

        if ($clean->set_password == $clean->confirm) {
            $ID      = $clean->contact_id;
            $PW      = MagiConnect_Core::passwordHash($clean->set_password);
            $reset 	 = MagiAccounts_Contact::updateContactPW($ID, $PW);
            if ($reset) {
                MagiConnect_Message::set('ok', 'Your password was reset successfully. We are redirecting you to the login page.');
                $result['message']  = MagiConnect_Message::render(true);
                $result['url']	    = site_url('/login', MagiConnect_Core::protocall());
                echo json_encode($result);
                die();
            }
        }

        MagiConnect_Message::set('error', 'We could not reset your password at this time.');
        $result['message']  = MagiConnect_Message::render(true);
        echo json_encode($result);
        die();
    }

}