<?php

if (!defined('WPINC')) { die; }

class MC_Base_Dealers_Cases
{

    public static function loadCases() 
    {
        $wp_session = WP_Session::get_instance();
        $dealer     = $wp_session['contact_id'];
        $result     = array();
        $clean	    = MagiConnect_FormFields::POST();

        if ($clean->pn < 1) { 
            $clean->pn = 1; 
        } else if ($clean->pn > $clean->last) { 
            $clean->pn = $clean->last; 
        }
        $limit = 'LIMIT '.($clean->pn - 1) * $clean->rpp.','.$clean->rpp;

        $url        = 'Case/MyCases';
        $details    = array(
            'ID'    => $dealer,
            'limit' => $limit,
        );
        $cases = MagiConnect_SugarCRM::getSugar(json_encode($details),$url,true);

        $result['html'] = self::casesTableRows($cases->cases);
        $result['clean'] = $clean;
        $result['limit'] = $limit;
        echo json_encode($result);
        die();
    }

    public static function loadCase()
    {
        $result     = array();
        $clean	    = MagiConnect_FormFields::POST();
        $case       = MagiAccounts_Case::getCase($clean->id);
        $replies    = 0;

        if (property_exists($case, 'notes')) {
            $replies = count($case->notes);
        }

        $html = self::formatCase($case, $replies);
        if ($replies > 0) {
            $html .= self::formatReplies($case->notes, $replies);
        }

        $result['case'] = $case;
        $result['html'] = $html;
        echo json_encode($result);
        die();
    }

    public static function casesTableRows($cases)
    {
        $classes = MagiAccounts_Products::product_class_array();
        $html = "";
        foreach ($cases as $case) {
            $html .= "<div class=\"table-row case-row\" role=\"row\" data-id=\"{$case->id}\">";
                $status = (in_array($case->status, MagiAccounts_Case::$closed)) ? 'closed' : 'open';
                $html .= "<div class=\"dot {$status}\" role=\"cell\">";
                    $html .= "<i class=\"fas fa-circle\"></i>";
                $html .= "</div>";
                $html .= "<div class=\"case-info\" role=\"cell\">";
                    $html .= "<div class=\"title\">";
                        $html .= "<h3 class=\"h5\">{$case->name} - <small>{$case->root_cause}</small></h3>";
                        $desc = strlen($case->description) > 30 ? substr($case->description,0,30).'...' : $case->description;
                        $html .= "<p>{$desc}</p>";
                    $html .= "</div>";
                    $html .= "<div class=\"info\">";
                        $html .= "<span class=\"status {$status}\">{$case->status}</span>";
                        $html .= "<span class=\"update\">Last Update: <time class=\"timeago\" datetime=\"{$case->date_modified}\"></time></span>";
                        $html .= "<span class=\"replies\">{$case->replies} ".MagiConnect_Core::pluralize($case->replies, "Reply")." </span>";
                    $html .= "</div>";
                $html .= "</div>";
                $html .= "<div class=\"created\" role=\"cell\">";
                    $html .= "<span>".date("d/m/Y", strtotime($case->date_entered))."</span>";
                $html .= "</div>";
            $html .= "</div>";
        }
        $html .= MagiConnect_Core::working();
        return $html;
    }  

    public static function formatCase($Q, $replies) 
    {
        $html = '';
        $html .= "<article class=\"case-post\" data-case-id=\"{$Q->case->id}\">";
        $html .= "<header class=\"case-header\">";
        $html .= "<h3 class=\"h4 title\">{$Q->case->name} - {$Q->case->customersstatedissue_c}</h3>";
        $html .= "<p class=\"date\">Case created on ".date("d/m/Y", strtotime($Q->case->date_entered))."</p>";
        $html .= "<p class=\"date\">Latest reply</a> on <time class=\"timeago\" datetime=\"{$Q->case->date_modified}\"></time></p>";
        $html .= "</header>";
        $html .= "<p>{$Q->case->description}</p>";
        if (property_exists($Q, 'attachment')) {
            $Q->attachment->id      = $Q->case->id;
            $Q->attachment->module  = 'Cases';
            $Q->attachment->field   = 'filename'; 
            $html .= "<div class=\"attachment\">";
            $html .= "<h6>Attachment</h6>";
            $html .= MagiConnect_Core::formatSugarAttachment($Q->attachment);
            $html .= "</div>";
        }
        $html .= "</article>";
        if (!$replies) {
            $html .= "<div class=\"reply-count\">";
            $html .= "<span class=\"title\">O Replies</span>";
            $html .= "<span><a href=\"\" class=\"blueBtn\">Add a reply</a></span>";
            $html .= "</div>";
        }   
        return $html;
    }

    public static function formatReplies($notes, $replies) 
    {
        $html = "";
        $html .= "<div class=\"reply-count\">";
        $html .= "<h4 class=\"title\">{$replies} ".MagiConnect_Core::pluralize($replies, 'Reply')."</h4>";
        $html .= "</div>";
        $html .= "<div class=\"case-replies\">";
            foreach ($notes as $note) {
                $html .= "<article class=\"card case-reply\" data-note-id=\"{$note->id}\">";
                $html .= "<header class=\"case-header\">";
                $html .= "<p class=\"date\">Created on ".date("d/m/Y", strtotime($note->date_entered))."</p>";
                $html .= "</header>";
                $html .= "<div class=\"case-answer\">";
                $html .= $note->description;
                $html .= "</div>";
                if ($note->filename) {
                    $attachment = new stdClass;
                        $attachment->module                 = 'Notes';
                        $attachment->field                  = 'filename';
                        $attachment->id                     = $note->id;
                        $attachment->name                   = $note->filename;
                        $attachment->{'content-length'}     = $note->file_size;
                        $attachment->{'content-type'}       = $note->file_mime_type;
                    $html .= "<div class=\"attachment\">";
                    $html .= "<h6>Attachment</h6>";
                    $html .= MagiConnect_Core::formatSugarAttachment($attachment);
                    $html .= "</div>";
                }
                $html .= "</article>";
            }
            $html .= "<div class=\"reply-count\">";
            $html .= "<span><a href=\"\" class=\"blueBtn\">Add a reply</a></span>";
            $html .= "</div>";
        $html .= "</div>";
        return $html;
    }



    
}