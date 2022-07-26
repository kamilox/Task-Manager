<?php
function redirect_cpt_archive($template) {
    global $wp, $wpdb, $post;
    $taxonomy = 'actions';

    $url = home_url( $wp->request );
    $url_xplode = explode('/', $url);
    if(is_user_logged_in()){
        global $current_user, $post, $wp;
        wp_get_current_user();
        $userRoles = wp_get_current_user()->roles;
        if($userRoles[0] != 'Client'){
            foreach ($url_xplode as $key => $path) {
                if($path == "task-manager"){
                    $template = plugin_dir_path(__FILE__) . 'wf_task_manager.php'; 
                }
                if($path == "task"){
                    $template = plugin_dir_path(__FILE__) . 'wf_singular.php'; 
                }
                if($path == "workflow-manager"){
                    $template = plugin_dir_path(__FILE__) . 'wf_workflow_manager.php'; 
                }
                if($path == "tasks-completed"){
                    $template = plugin_dir_path(__FILE__) . 'wf_tasks_completed.php'; 
                }
                if($path == "workflow"){
                    $template = plugin_dir_path(__FILE__) . 'wf_singular_workflow.php'; 
                }
            } 
        }else{
            foreach ($url_xplode as $key => $path) {
                if($path == "client-add-task"){
                    $template = plugin_dir_path(__FILE__) . 'wf_client_task_form.php'; 
                }
                if($path == "client-task-manager"){
                    $template = plugin_dir_path(__FILE__) . 'wf_client_task_manager.php'; 
                }
            } 
        }
    }
    
    
    if ( !file_exists( $template ) ) {
        include $template;
    }
 
    return $template;

}
add_filter( 'template_include', 'redirect_cpt_archive' );
?>