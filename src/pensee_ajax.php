<?php

require_once PENSEES_PATH . 'src/pensee_helper.php';

function PENSEES_ajax_get_random_pensee() {
    $current_id = intval($_POST['exclude_id'] ?? 0);
    $post = PENSEES_Helper::get_random_pensee($current_id);
    
    if ($post) {
        $response = PENSEES_Helper::format_for_json($post);
        wp_send_json($response);
    } else {
        wp_send_json_error('No pensées found.');
    }

    wp_die();
}

function PENSEES_ajax_get_pensee_by_id() {
    $id = intval($_POST['id'] ?? 0);
    $post = PENSEES_Helper::get_pensee($id);

    if (!$post) {
        wp_send_json_error('Invalid pensée ID.');
    }

    $response = PENSEES_Helper::format_for_json($post);
    wp_send_json($response);
    wp_die();
}

add_action('wp_ajax_get_random_pensee', 'PENSEES_ajax_get_random_pensee');
add_action('wp_ajax_nopriv_get_random_pensee', 'PENSEES_ajax_get_random_pensee');

add_action('wp_ajax_get_pensee_by_id', 'PENSEES_ajax_get_pensee_by_id');
add_action('wp_ajax_nopriv_get_pensee_by_id', 'PENSEES_ajax_get_pensee_by_id');
