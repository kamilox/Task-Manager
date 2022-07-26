<?php
function add_task_submenu(){
    add_menu_page(
        'tasks_assigned',
        'Tasks manager',
        'manage_options',
        'tasks_assigned',
        'labels',
        'dashicons-admin-page', 
        6
    );

    add_submenu_page(
        'tasks_assigned',//parent slug
        '', // 
        'Add New Task', //
        'manage_options', // 
        'actions', //  
        'add_new_task' // 
    );

    add_submenu_page(
        'tasks_assigned',//parent slug
        '', // 
        'Add New Sites', //
        'manage_options', // 
        'client', //  
        'site' // 
    );

    add_submenu_page(
        'tasks_assigned',//parent slug
        '', // 
        'Add New Tasks Categories', //
        'manage_options', // 
        'task', //  
        'task' // 
    );
}
add_action('admin_menu', 'add_task_submenu');

//url add new task
function add_new_task() {
    ?><script>window.location = "<?php echo admin_url('post-new.php?post_type=task'); ?>";</script><?php 
}
//url add new task
function site() {
     ?><script>window.location = "<?php echo admin_url('edit-tags.php?taxonomy=client&post_type=task'); ?>";</script><?php
}
//url add new item
function task() {
    ?><script>window.location = "<?php echo admin_url('edit-tags.php?taxonomy=actions&post_type=task'); ?>";</script><?php
}

//workflow section
function add_workflow_submenu(){
    add_menu_page(
        'workflows_manager',
        'Workflows manager',
        'manage_options',
        'workflows_manager',
        'labels',
        'dashicons-admin-page', 
        7
    );

    add_submenu_page(
        'workflows_manager',//parent slug
        '', // 
        'Add New Workflow', //
        'manage_options', // 
        'workflows', //  
        'add_new_workflow' // 
    );

}
add_action('admin_menu', 'add_workflow_submenu');

//url add new task
function add_new_workflow() {
    ?><script>window.location = "<?php echo admin_url('post-new.php?post_type=workflow'); ?>";</script><?php 
}
?>