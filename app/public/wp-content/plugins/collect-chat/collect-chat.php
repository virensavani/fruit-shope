<?php

/*
    Plugin Name: Collect Chat
    Description: Collect of chatbot Question
    Version: 1.0
    Author: Karmaleen
    Author URI: http://localhost:10010/
*/
require_once plugin_dir_path(__FILE__) . 'script/script-page.php';
require_once plugin_dir_path(__FILE__) . 'inc/question-type.php';

// function add_cors_http_header()
// {
//     header("Access-Control-Allow-Origin: *");
// }
// add_action('init', 'add_cors_http_header');

// main class started
class CollectChat
{
    function __construct()
    {
        add_action('admin_menu', array($this, 'adminMenu'));
        add_action('wp_enqueue_scripts',array($this,'loadAssets'));
        add_action('phpmailer_init', array($this,'mailtrap'));
    }

    function adminMenu()
    {
        // chatbot setting Menu
        $mainPageHook = add_menu_page('Build', 'Build', 'manage_options', 'build', array($this, 'scriptPage'), plugin_dir_url(__FILE__) . 'custom.svg', '50');
        add_submenu_page('build', 'Script', 'Script', 'manage_options', 'script', array($this, 'scriptPage'));
        add_action("load-{$mainPageHook}", array($this, 'pageAssets'));
    }

    function pageAssets()
    {
        wp_enqueue_script('font-awesome',  plugin_dir_url(__FILE__) .'js/bootstrap.bundle.min.js', NULL, '1.0', true);
        wp_enqueue_style('chatbot_custom_css', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css');
        wp_enqueue_style('chatbot_bootstarp_theme', plugin_dir_url(__FILE__) . 'css/bootstrap-theme.min.css');
        wp_enqueue_style('custom_css', plugin_dir_url(__FILE__) . 'css/custom.css');

        wp_enqueue_style('jquery_modal_css', '//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css');
        wp_localize_script('main-chatbot-js', 'chatbotData', array(
            'root_url' => get_site_url(),

        ));
    }

    function scriptPage(){
        scriptPage();
    }
    function mailtrap($phpmailer)
    {
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '935df1d91e8c94';
        $phpmailer->Password = '54584f7ac912f9';
    }

}

$collectChatPlugin = new CollectChat;