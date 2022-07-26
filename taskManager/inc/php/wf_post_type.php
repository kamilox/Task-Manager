<?php
/**
 * Register a custom post type called "Task".
 *
 * @see get_post_type_labels() for label keys.
 */
function wpdocs_codex_tasks_init() {
    $labels = array(
        'name'                  => _x( 'Tasks', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Task', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Tasks', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Task', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New Task', 'textdomain' ),
        'add_new_item'          => __( 'Add New Task', 'textdomain' ),
        'new_item'              => __( 'New Task', 'textdomain' ),
        'edit_item'             => __( 'Edit Task', 'textdomain' ),
        'view_item'             => __( 'View Task', 'textdomain' ),
        'all_items'             => __( 'All Tasks', 'textdomain' ),
        'search_items'          => __( 'Search Tasks', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Tasks:', 'textdomain' ),
        'not_found'             => __( 'No Tasks found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No Tasks found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Task Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Task archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into Task', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Task', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter Tasks list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Tasks list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Tasks list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels' => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'query_var'          => true,
        'description' => __('Post images types', 'textdomain'),
        'show_ui' => true,
        'show_in_menu' => 'tasks_assigned',
        'rewrite' => array('slug' => 'task'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hieralchical' => true,
        'menu_position' => 5,
        'supports'  => array( 'title', 'editor', 'author', 'thumbnail', 'comments' ),
        'can_export' => true,
        'menu_icon' => 'dashicons-format-gallery',
           
        
    );
 
    register_post_type( 'task', $args );
}
add_action( 'init', 'wpdocs_codex_tasks_init' );
// 
function wpdocs_codex_workflow_init() {
    $labels = array(
        'name'                  => _x( 'Workflows', 'Post type general name', 'workflow' ),
        'singular_name'         => _x( 'Workflow', 'Post type singular name', 'workflow' ),
        'menu_name'             => _x( 'Workflows', 'Admin Menu text', 'workflow' ),
        'name_admin_bar'        => _x( 'Workflow', 'Add New on Toolbar', 'workflow' ),
        'add_new'               => __( 'Add New Workflow', 'workflow' ),
        'add_new_item'          => __( 'Add New Workflow', 'workflow' ),
        'new_item'              => __( 'New Workflow', 'workflow' ),
        'edit_item'             => __( 'Edit Workflow', 'workflow' ),
        'view_item'             => __( 'View Workflow', 'workflow' ),
        'all_items'             => __( 'All Workflows', 'workflow' ),
        'search_items'          => __( 'Search Workflows', 'workflow' ),
        'parent_item_colon'     => __( 'Parent Workflows:', 'workflow' ),
        'not_found'             => __( 'No Workflows found.', 'workflow' ),
        'not_found_in_trash'    => __( 'No Workflows found in Trash.', 'workflow' ),
        'featured_image'        => _x( 'Workflow Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'workflow' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'workflow' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'workflow' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'workflow' ),
        'archives'              => _x( 'Workflow archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'workflow' ),
        'insert_into_item'      => _x( 'Insert into Workflow', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'workflow' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this Workflow', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'workflow' ),
        'filter_items_list'     => _x( 'Filter Workflows list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'workflow' ),
        'items_list_navigation' => _x( 'Workflows list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'workflow' ),
        'items_list'            => _x( 'Workflows list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'workflow' ),
    );
 
    $args = array(
        'labels' => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'query_var'          => true,
        'description' => __('Post images types', 'textdomain'),
        'show_ui' => true,
        'show_in_menu' => 'workflows_manager',
        'rewrite' => array('slug' => 'workflow'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hieralchical' => true,
        'menu_position' => 5,
        'supports'  => array( 'title', 'editor', 'author', 'thumbnail', 'comments' ),
        'can_export' => true,
        'menu_icon' => 'dashicons-format-gallery',
           
        
    );
 
    register_post_type( 'workflow', $args );
}
 
add_action( 'init', 'wpdocs_codex_workflow_init' );
?>