<?php

/*
    Plugin Name: Collect Chat
    Description: Collect of chatbot Question
    Version: 1.0
    Author: Karmaleen
    Author URI: http://localhost:10040/
*/
require_once plugin_dir_path(__FILE__) . 'inc/question-type.php';
require_once plugin_dir_path(__FILE__) . 'question-script/script-page.php';
// require_once plugin_dir_path(__FILE__) . 'inc/question-collection-route.php';
require_once plugin_dir_path(__FILE__) . 'question-script/addQuestion.php';

// function add_cors_http_header()
// {
//     header("Access-Control-Allow-Origin: *");
// }
// add_action('init', 'add_cors_http_header');
function my_theme_enqueue_styles(){
    // wp_enqueue_style('jquery_ui_bootstrap', '//cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/assets/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap_min', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css');
    wp_enqueue_style('font-awesome','//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css');
    wp_enqueue_style('icon_css','//cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css');
    wp_enqueue_style('custom_css', plugin_dir_url(__FILE__) . 'css/custom.css');

    wp_enqueue_script('bootstrap_bundle', '//cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', NULL, '1.0', true);
    wp_enqueue_script('jquery_min',  '//cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js', NULL, '1.0', true);
    wp_enqueue_script('jquery_min',  plugin_dir_url(__FILE__) .'js/jquery.min.js', NULL, '1.0', true);
    wp_enqueue_script('jquery_easing',  plugin_dir_url(__FILE__) .'js/jquery.easing.js', NULL, '1.0', true);
    wp_enqueue_script('jquery_ui_min',  plugin_dir_url(__FILE__) .'js/jquery-ui.min.js', NULL, '1.0', true);
    wp_enqueue_script('bootstrap_min',  plugin_dir_url(__FILE__) .'js/bootstrap.min.js', NULL, '1.0', true);

}
add_action('admin_head' , 'my_theme_enqueue_styles');

// main class started

class CollectChat
{
    function __construct()
    {
        add_action('admin_menu', array($this, 'adminMenu'));
        add_action('wp_enqueue_scripts',array($this,'loadAssets'));
        add_action('phpmailer_init', array($this,'mailtrap'));
    }

    function loadAssets(){
        wp_localize_script('main-chatbot-js', 'collectchatData', array(
            'root_url' => get_site_url(),
        ));
    }

    function adminMenu()
    {
        // chatbot setting Menu
        $mainPageHook = add_menu_page('Build', 'Build', 'manage_options', 'build', array($this, 'scriptPage'), plugin_dir_url(__FILE__) . 'custom.svg', '50');
        add_submenu_page('build', 'Add Question', 'Add Question', 'manage_options', 'add-question', array($this, 'addQuestion'));
        add_action("load-{$mainPageHook}", array($this, 'pageAssets'));
    }

    function pageAssets()
    {
        wp_localize_script('main-chatbot-js', 'collectchatData', array(
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

    function addQuestion(){
        addQuestion();
    }

}

$collectChatPlugin = new CollectChat;