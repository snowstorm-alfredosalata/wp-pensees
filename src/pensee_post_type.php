<?php

function PENSEES_register_pensee_post_type(): void {
    $args = array(
        'labels' => array(
            'name'          => 'Pensees',
            'singular_name' => 'Pensee',
            'menu_name'     => 'Pensees',
            'add_new'       => 'Add New Pensee',
            'add_new_item'  => 'Add New Pensee',
            'new_item'      => 'New Pensee',
            'edit_item'     => 'Edit Pensee',
            'view_item'     => 'View Pensee',
            'all_items'     => 'All Pensees',
        ),
        'public'              => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'show_in_rest'        => true,
        'supports'            => array('title', 'editor', 'author', 'thumbnail'),
        'rewrite'             => array('slug' => 'pensees')
    );

    register_post_type( 'pensee', $args );
}