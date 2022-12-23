<?php

if (!function_exists('getLinksList')) {
    function getLinksList(){
        $data[] = array(                
            "type" => "Phone",
            "img" => "https://collectcdn.com/social/phone.svg",
            "link" => "tel:0000000000", 
            "text" => "Call to",
            "sameTab" => false
        );
        $data[] = array(
            "type" => "Email",
            "img" => "https://collectcdn.com/social/email.svg", 
            "link" => "mailto:ruchit.karmaln@gmail.com", 
            "text" => "Email us",
            "sameTab" => false
        );
        $data[] = array(
            "type" => "Link",
            "img" => "https://collectcdn.com/social/link.svg", 
            "link" => "http://karmaleen.com/", 
            "text" => "Open",
            "sameTab" => false
        );
        $data[] = array(
            "type" => "Facebook",
            "img" => "https://collectcdn.com/social/facebook.svg",  
            "link" => "https://www.facebook.com/ruchit.kukadiya/", 
            "text" => "Follow",
            "sameTab" => false
        );
        $data[] = array(
            "type" => "Instagram",
            "img" => "https://collectcdn.com/social/instagram.svg", 
            "link" => "https://www.instagram.com/ruchit.kukadiya/", 
            "text" => "Follow",
            "sameTab" => false
        );
        $data[] = array(
            "type" => "Youtube",
            "img" => "https://collectcdn.com/social/youtube.svg",
            "link" => "https://www.youtube.com/ruchitkukadiya/",
            "text" => "Follow",
            "sameTab" => false  
        );
        $data[] = array(
            "type" => "Linkedin",
            "img" => "https://collectcdn.com/social/linkedin.svg",
            "link" => "",
            "text" => "",
            "sameTab" => false
        );

        return $data;
    }
}
