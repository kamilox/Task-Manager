<?php
    $title_1 = 'Task Manager';
    $title_2 = 'Client Add Task';
    $title_3 = 'Client Task Manager';
    $title_4 = 'Workflow Manager';
    $title_5 = 'Tasks Completed';

    if(get_page_by_title($title_1) == NULL){
        $page_task_manager = array(
            'post_title' => $title_1,
            'post_content' => 'content',
            'post_status' => 'publish',
            'post_type' => 'page'
        );
        wp_insert_post($page_task_manager);
    }

    if(get_page_by_title($title_2) == NULL){
        $page_client_task = array(
            'post_title' => $title_2,
            'post_content' => 'content',
            'post_status' => 'publish',
            'post_type' => 'page'
        );
        wp_insert_post($page_client_task);
    }

    if(get_page_by_title($title_3) == NULL){
        $page_client_task_manager = array(
            'post_title' => $title_3,
            'post_content' => 'content',
            'post_status' => 'publish',
            'post_type' => 'page'
        );
        wp_insert_post($page_client_task_manager);
    }

    if(get_page_by_title($title_4) == NULL){
        $page_workflow_manager = array(
            'post_title' => $title_4,
            'post_content' => 'content',
            'post_status' => 'publish',
            'post_type' => 'page'
        );
        wp_insert_post($page_workflow_manager);
    }

    if(get_page_by_title($title_5) == NULL){
        $page_tasks_completed = array(
            'post_title' => $title_5,
            'post_content' => 'content',
            'post_status' => 'publish',
            'post_type' => 'page'
        );
        wp_insert_post($page_tasks_completed);
    }
?>