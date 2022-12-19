<?php
include(plugin_dir_path(__FILE__) .'\helper.php');

// Create table if not exist
add_action('init', 'question_types');
function question_types(){
     global $wpdb;

    $table_name = $wpdb->prefix . "question_types";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        question_type varchar(255) NOT NULL, 
        question_rule varchar(255) NULL DEFAULT '',
        label varchar(255) NULL DEFAULT '',
        icon varchar(255) NULL DEFAULT '',
        PRIMARY KEY id (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}


// Create Question type 
add_action( 'init', 'createQuestionType' );
function createQuestionType() {
    if ( !get_option('run_only_once_09') ):
        global $wpdb;
        $data = getQuestionType();
        $table_name = $wpdb->prefix . "question_types";
        
        foreach($data as $type){
            $wpdb->insert($table_name, $type);
        }
        
        add_option('run_only_once_09', 1); 
    endif;
}

//Question type API
add_action('rest_api_init', 'questionTypeRoutes');

function questionTypeRoutes(){
    register_rest_route('chatbot/v1', '/get-all-question-type', array(
        'methods' => 'GET',
        'callback' => 'getAllQuestionType'
    ));
}

// Get question types
function getAllQuestionType(){
    global $wpdb;
    $table_name = $wpdb->prefix . "question_types";
    
    $my_query = $wpdb->prepare("SELECT * FROM " . $table_name);
    $response = $wpdb->get_results($my_query);
    
    if (empty($response)) {
        $response[] =['question' =>"There are no question type to display"]; 
        return wp_send_json_error($response);
    }
    return wp_send_json_success($response);
}
