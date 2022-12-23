<?php
include(plugin_dir_path(__FILE__) .'\helper.php');

// Question Collection table create
function question_collection_table()
{

    global $wpdb;

    $table_name = $wpdb->prefix . "question_collection";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        question_sequence NOT NULL, 
        question_type varchar(255) NOT NULL,
        question_name  varchar(255)  NOT NULL,
        question_option json NULL DEFAULT [],
        question_config json NULL DEFAULT [],
        PRIMARY KEY id (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

add_action('init', 'question_collection_table');

// Create  Question
add_action('admin_post_createquestioncollection', 'createQuestionCollection');
add_action('admin_post_nopriv_createquestioncollection',  'createQuestionCollection');

function createQuestionCollection()
{
    if (current_user_can('administrator')) {
        global $wpdb;
        pr_exit($_POST);
        $table_name = $wpdb->prefix . "question_collection";

        $question['question_sequence'] = sanitize_text_field($_POST['question_sequence']);
        $question['question'] = sanitize_text_field($_POST['question']);
        $question['question_type'] = sanitize_text_field($_POST['question_type']);
        $question['question_option'] = sanitize_text_field($_POST['option']);
        $wpdb->insert($table_name, $question);
        wp_safe_redirect(admin_url('admin.php?page=question'));
    } else {
        wp_safe_redirect(site_url());
    }
    exit;
}

//Question collection API
add_action('rest_api_init', 'uiConfigRoutes');

function uiConfigRoutes()
{
    register_rest_route('chatbot/v1', '/get-all-question', array(
        'methods' => 'GET',
        'callback' => 'getAllQuestion'
    ));

    register_rest_route('chatbot/v1', '/get-question/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'getQuestion'
    ));

    register_rest_route('chatbot/v1', '/create-question', array(
        'methods' => 'POST',
        'callback' => 'createQuestion'
    ));

    register_rest_route('chatbot/v1', '/delete-question/(?P<id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => 'createQuestion'
    ));

    register_rest_route('chatbot/v1', '/edit-question', array(
        'methods' => 'POST',
        'callback' => 'editQuestion'
    ));
}

function getAllQuestion(){
    global $wpdb;
    $table_name = $wpdb->prefix . "question_collection";
    $id = urldecode($request->get_param( 'id' ));
    
    $my_query = $wpdb->prepare("SELECT config_setting FROM " . $table_name);
    $response = $wpdb->get_results($my_query);
    
    if (empty($response)) {
        $response[] =['question' =>"There are no question to display"]; 
        return wp_send_json_error($response);
    }
    return wp_send_json_success($response);
}

function getQuestion(){
    global $wpdb;
    $table_name = $wpdb->prefix . "question_collection";
    $id = urldecode($request->get_param( 'id' ));
    
    $my_query = $wpdb->prepare("SELECT config_setting FROM " . $table_name ." WHERE id = " . $id);
    $response = $wpdb->get_results($my_query);
    
    if (empty($response)) {
        $response[] =['question' =>"There are no question to display"]; 
        return wp_send_json_error($response);
    }
    return $response[0];
}