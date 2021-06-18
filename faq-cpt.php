<?php

// Register Custom Post Type
function faq_cpt() {

    $labels = array(
        'name'                  => _x( 'FAQs', 'Post Type General Name', 'faq' ),
        'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'faq' ),
        'menu_name'             => __( 'FAQs', 'faq' ),
        'name_admin_bar'        => __( 'FAQ', 'faq' ),
        'archives'              => __( 'FAQ Archives', 'faq' ),
        'attributes'            => __( 'FAQ Attributes', 'faq' ),
        'parent_item_colon'     => __( 'Parent FAQ:', 'faq' ),
        'all_items'             => __( 'All FAQs', 'faq' ),
        'add_new_item'          => __( 'Add New FAQ', 'faq' ),
        'add_new'               => __( 'Add New', 'faq' ),
        'new_item'              => __( 'New FAQ', 'faq' ),
        'edit_item'             => __( 'Edit FAQ', 'faq' ),
        'update_item'           => __( 'Update FAQ', 'faq' ),
        'view_item'             => __( 'View FAQ', 'faq' ),
        'view_items'            => __( 'View FAQs', 'faq' ),
        'search_items'          => __( 'Search FAQ', 'faq' ),
        'not_found'             => __( 'Not found', 'faq' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'faq' ),
        'featured_image'        => __( 'Featured Image', 'faq' ),
        'set_featured_image'    => __( 'Set featured image', 'faq' ),
        'remove_featured_image' => __( 'Remove featured image', 'faq' ),
        'use_featured_image'    => __( 'Use as featured image', 'faq' ),
        'insert_into_item'      => __( 'Insert into FAQ', 'faq' ),
        'uploaded_to_this_item' => __( 'Uploaded to this FAQ', 'faq' ),
        'items_list'            => __( 'FAQs list', 'faq' ),
        'items_list_navigation' => __( 'FAQs list navigation', 'faq' ),
        'filter_items_list'     => __( 'Filter FAQs list', 'faq' ),
    );
    $args = array(
        'label'                 => __( 'FAQ', 'faq' ),
        'description'           => __( 'Frequently Asked Questions', 'faq' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
        'taxonomies'            => array( 'faq_category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-editor-help',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'faqs',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
        'rest_base'             => 'faqs',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type( 'faq', $args );

}
add_action( 'init', 'faq_cpt', 0 );