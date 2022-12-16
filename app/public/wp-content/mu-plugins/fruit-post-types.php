<?php

function fruit_post_types()
{
    //Question Post type
    register_post_type('question', array(
        'capability_type' => 'question',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'questions'),
        'has_archive' => true,
        'public' => true,
        'show_in_rest' => true,
        'labels' => array(
            'name' => 'Questions',
            'add_new_item' => 'Add New Question',
            'edit_item' => 'Edit Question',
            'all_items' => 'All Questions',
            'singular_name' => 'Question'
        ),
        'menu_icon' => 'dashicons-sticky'
    ));
}

add_action('init', 'fruit_post_types');