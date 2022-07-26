<?php

global $wp;

print_r(get_post_type());


function wf_type_taxonomies() {
    $labelsActions = array(
        'name'              => _x( 'Type of tasks', 'taxonomy general name' ),
        'singular_name'     => _x( 'Type of tasks', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Type of tasks' ),
        'all_items'         => __( 'All Type of tasks' ),
        'parent_item'       => __( 'Parent Type of task' ),
        'parent_item_colon' => __( 'Parent Type of task:' ),
        'edit_item'         => __( 'Edit Type of task' ),
        'update_item'       => __( 'Update Type of task' ),
        'add_new_item'      => __( 'Add New Type of task' ),
        'new_item_name'     => __( 'New Type of task Name' ),
        'menu_name'         => __( 'Type of task' ),
    );
    $argsActions   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labelsActions,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'rewrite'           => [ 'slug' => 'actions' ],
        'supports'          => array( 'title', 'editor', 'comments', 'thumbnail' )
    );
    register_taxonomy( 'actions', 'task', $argsActions );

    $labelsClientSite = array(
        'name'              => _x( 'Client Sites', 'taxonomy general name' ),
        'singular_name'     => _x( 'Client Sites', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Client Sites' ),
        'all_items'         => __( 'All Client Sites' ),
        'parent_item'       => __( 'Parent Client Site' ),
        'parent_item_colon' => __( 'Parent Client Site:' ),
        'edit_item'         => __( 'Edit Client Site' ),
        'update_item'       => __( 'Update Client Site' ),
        'add_new_item'      => __( 'Add New Client Site' ),
        'new_item_name'     => __( 'New Client Site' ),
        'menu_name'         => __( 'Client Site' ),
    );
    $argsClientSite   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labelsClientSite,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'rewrite'           => [ 'slug' => 'client' ],
        'supports'          => array( 'title', 'editor', 'comments', 'thumbnail' )
    );
    register_taxonomy( 'client', 'task', $argsClientSite );
}
add_action( 'init', 'wf_type_taxonomies' );


function wf_type_taxonomies_workflow() {
    $labelsClientSiteWorkflow = array(
        'name'              => _x( 'Client Sites', 'taxonomy general name' ),
        'singular_name'     => _x( 'Client Sites', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Client Sites' ),
        'all_items'         => __( 'All Client Sites' ),
        'parent_item'       => __( 'Parent Client Site' ),
        'parent_item_colon' => __( 'Parent Client Site:' ),
        'edit_item'         => __( 'Edit Client Site' ),
        'update_item'       => __( 'Update Client Site' ),
        'add_new_item'      => __( 'Add New Client Site' ),
        'new_item_name'     => __( 'New Client Site' ),
        'menu_name'         => __( 'Client Site' ),
    );
    $argsClientSiteWorkflow   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labelsClientSiteWorkflow,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'rewrite'           => [ 'slug' => 'client' ],
        'supports'          => array( 'title', 'editor', 'comments', 'thumbnail' )
    );
    register_taxonomy( 'client', 'workflow', $argsClientSiteWorkflow );
}
add_action( 'init', 'wf_type_taxonomies_workflow' );
?>