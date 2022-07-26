<?php
global $current_user;

add_filter( 'wp_nav_menu_items', 'add_task_manager_admin_link', 10, 2 );
function add_task_manager_admin_link( $items, $args ) {
    if (is_user_logged_in() ) {
        $user = get_user_by('id', get_current_user_id() );
        
        if ($user->roles[0] === 'administrator' || $user->roles[0] == 'user'){
            $items .= '<li class="menu-item"><a class="menu-link" href="'.get_site_url().'/task-manager">Task Manager</a></li>';
            $items .= '<li class="menu-item"><a class="menu-link" href="'.get_site_url().'/workflow-manager">Workflow Manager</a></li>';
            $items .= '<li class="menu-item"><a class="menu-link" href="'.get_site_url().'/tasks-completed">Tasks Completed</a></li>';
        }
        if ($user->roles[0] === 'Client'){
            $items .= '<li class="menu-item"><a href="'.get_site_url().'/client-add-task">Add task</a></li>';
            $items .= '<li class="menu-item menu-item-task-manager"><a href="'.get_site_url().'/client-task-manager" class="menu-link">Task Manager</a></li>';
        }
    }   
    return $items;
}
?>