<?php

if (!function_exists('pr_exit')) {
    function pr_exit($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        exit;
    }
}

if (!function_exists('getQuestionType')) {
    function getQuestionType(){
        $data[] = array(
                "question_type"=>"Message",
                "question_rule"=>"",
                "label"=>"Message",
                "icon"=>"bi-chat-dots"
            );
        $data[] =   array(
                "question_type"=>"MultiChoice",
                "question_rule"=>"",
                "label"=>"Multi Choice",
                "icon"=>"bi-check-circle"
            );
        $data[]=array(
                "question_type"=>"TextQuestion",
                "question_rule"=>"",
                "label"=>"Text Question",
                "icon"=>"bi-patch-question"
            );
        $data[]=array(
                "question_type"=>"Email",
                "question_rule"=>"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",
                "label"=>"Email",
                "icon"=>"bi-envelope"
            );
        $data[]=array(
                "question_type"=>"PhoneNumber",
                "question_rule"=>"/^[1-9][0-9]{10}$/",
                "label"=>"Phone Number",
                "icon"=>"bi-telephone"
            );
        $data[]=array(
                "question_type"=>"Appointment",
                "question_rule"=>"",
                "label"=>"Appointment",
                "icon"=>"bi-calendar2-check"
            );
        $data[]=array(
                "question_type"=>"Yes/No",
                "question_rule"=>"",
                "label"=>"Yes/No",
                "icon"=>"bi-check-circle"
            );
        $data[]=array(
                "question_type"=>"MultiSelect",
                "question_rule"=>"",
                "label"=>"Multi Select",
                "icon"=>"bi-check-square"
            );
        $data[]=array(
                "question_type"=>"List",
                "question_rule"=>"",
                "label"=>"List",
                "icon"=>"bi-list-task"
            );
        $data[]=array(
                "question_type"=>"Number",
                "question_rule"=>"/^[1-9][0-9]$/",
                "label"=>"Number",
                "icon"=>"bi-hash"
            );
        $data[]=array(
                "question_type"=>"Range",
                "question_rule"=>"/^[1-9][0-9]$/",
                "label"=>"Range",
                "icon"=>"bi-menu-button-wide"
            );
        $data[]=array(
                "question_type"=>"Rating",
                "question_rule"=>"",
                "label"=>"Rating",
                "icon"=>"bi-star"
            );
        $data[]=array(
                "question_type"=>"Opinion",
                "question_rule"=>"",
                "label"=>"Opinion Scale",
                "icon"=>"bi-speedometer2"
            );
        $data[]=array(
                "question_type"=>"Date",
                "question_rule"=>"",
                "label"=>"Date",
                "icon"=>"bi-calendar"
            );
        $data[]=array(
                "question_type"=>"File",
                "question_rule"=>"",
                "label"=>"File Upload",
                "icon"=>"bi-upload"
            );
        $data[]=array(
                "question_type"=>"Links",
                "question_rule"=>"",
                "label"=>"Links",
                "icon"=>"bi-link"
            );
        $data[]=array(
                "question_type"=>"ThankYou",
                "question_rule"=>"",
                "label"=>"Thank You",
                "icon"=>"bi-hand-thumbs-up"
            );
        $data[]=array(
                "question_type"=>"WhatsApp",
                "question_rule"=>"",
                "label"=>"WhatsApp",
                "icon"=>"bi-whatsapp"
            );
        
      
        return $data;
    }
}

if (!function_exists('fileUpload')) {
    function fileUpload($fileName,$fileData)
    {
        // pr_exit(wp_upload_bits($fileName,null, $fileData));
        $data =wp_upload_bits($fileName,null, $fileData);
        return $fileName;
    }
}

if (!function_exists('get_the_user_ip')) {
    function get_the_user_ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return apply_filters('wpb_get_ip', $ip);
    }
}
