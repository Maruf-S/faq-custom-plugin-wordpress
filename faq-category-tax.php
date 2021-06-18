<?php

// Register Custom Taxonomy
function faq_category_tax() {

    $labels = array(
        'name'                       => _x( 'FAQ Categories', 'Taxonomy General Name', 'faq' ),
        'singular_name'              => _x( 'FAQ Category', 'Taxonomy Singular Name', 'faq' ),
        'menu_name'                  => __( 'FAQ Categories', 'faq' ),
        'all_items'                  => __( 'All Categories', 'faq' ),
        'parent_item'                => __( 'Parent Category', 'faq' ),
        'parent_item_colon'          => __( 'Parent Category:', 'faq' ),
        'new_item_name'              => __( 'New Category Name', 'faq' ),
        'add_new_item'               => __( 'Add New Category', 'faq' ),
        'edit_item'                  => __( 'Edit Category', 'faq' ),
        'update_item'                => __( 'Update Category', 'faq' ),
        'view_item'                  => __( 'View Category', 'faq' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'faq' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'faq' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'faq' ),
        'popular_items'              => __( 'Popular Categories', 'faq' ),
        'search_items'               => __( 'Search Categories', 'faq' ),
        'not_found'                  => __( 'Not Found', 'faq' ),
        'no_terms'                   => __( 'No categories', 'faq' ),
        'items_list'                 => __( 'Categories list', 'faq' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'faq' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rest_base'                  => 'faq-categories',
        'rest_controller_class'      => 'WP_REST_Terms_Controller',
    );
    register_taxonomy( 'faq_category', array( 'faq' ), $args );

}
add_action( 'init', 'faq_category_tax', 0 );