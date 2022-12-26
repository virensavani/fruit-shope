<?php
include(plugin_dir_path(__FILE__) .'\helper.php');
define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
// Question Collection table create
function question_collection_table()
{

    global $wpdb;

    $table_name = $wpdb->prefix . "question_collection";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        subscriber_id int(20)  NULL DEFAULT 0,
        question_sequence int(11) NOT NULL, 
        question_type varchar(255) NOT NULL,
        question  varchar(255) NOT NULL,
        question_option json NULL,
        question_config json NULL,
        PRIMARY KEY id (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

add_action('init', 'question_collection_table');

// Create  Question
add_action('admin_post_createcollection', 'createQuestionCollection');
add_action('admin_post_nopriv_createcollection',  'createQuestionCollection');

function createQuestionCollection()
{
    if (current_user_can('administrator')) {
        global $wpdb;
        pr_exit($_POST);
        $table_name = $wpdb->prefix . "question_collection";

        $question['question_sequence'] = sanitize_text_field($_POST['question_sequence']);
        $question['question'] = sanitize_text_field($_POST['questionName']);
        $question['question_type'] = sanitize_text_field($_POST['questionType']);
        $question['question_option'] = sanitize_text_field($_POST['option']);
        $wpdb->insert($table_name, $question);
        wp_safe_redirect(admin_url('admin.php?page=question'));
    } else {
        wp_safe_redirect(site_url());
    }
    exit;
}

//Question collection API
add_action('rest_api_init', 'questionConfigRoutes');

function questionConfigRoutes()
{
    register_rest_route('chatbot/v1', '/get-all-question', array(
        'methods' => 'GET',
        'callback' => 'getAllQuestion'
    ));

    register_rest_route('chatbot/v1', '/get-question/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'getQuestionCollection'
    ));

    register_rest_route('chatbot/v1', '/fetch_ajax_content', array(
        'methods' => 'POST',
        'callback' => 'fetch_ajax_content'
    ));

    // register_rest_route('chatbot/v1', '/delete-question/(?P<id>\d+)', array(
    //     'methods' => 'DELETE',
    //     'callback' => 'createQuestion'
    // ));

    // register_rest_route('chatbot/v1', '/edit-question', array(
    //     'methods' => 'POST',
    //     'callback' => 'editQuestion'
    // ));
}

function fetch_ajax_content() {

    if ( isset( $_POST ) ) {
        $id = $_POST['id'];
        return mec_get_admin_menu_page('content',$id);
    }
    
}
function mec_get_admin_menu_page($slug, $name = null) {

    do_action("mec_get_admin_menu_page_{$slug}", $slug, $name);

    $templates = array();
    if (isset($name))
        $templates[] = "{$slug}-{$name}.php";

    $templates[] = "{$slug}.php";
    mec_locate_admin_menu_template($templates, true, false);
}

/* Extend locate_template from WP Core 
* Define a location of your plugin file dir to a constant in this case = PLUGIN_DIR_PATH 
* Note: PLUGIN_DIR_PATH - can be any folder/subdirectory within your plugin files 
*/ 
function mec_locate_admin_menu_template($template_names, $load = false, $require_once = true ) 
{ 
    $located = ''; 
    foreach ( (array) $template_names as $template_name ) { 
        if ( !$template_name ) continue; 
        /* search file within the PLUGIN_DIR_PATH only */ 
        if ( file_exists(PLUGIN_DIR_PATH . '/question-template-parts/' . $template_name)) { 
            $located = PLUGIN_DIR_PATH . '/question-template-parts/' . $template_name; 
            break; 
        } 
    }
    if ( $load && '' != $located )
    
    load_template( $located, $require_once );

    return $located;
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

function getQuestionCollection(){
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