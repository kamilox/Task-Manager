<?php
    global $post, $wp;
        
    $args = array(
        'post_type' => 'task',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $query = new WP_Query( $args );
    
    if(isset($_POST['search_by_name'])){
        $args = array(
            'post_type' => 'task',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key'     => 'assing_to_field',
                    'value'   => $_POST['search_by_name'],
                    'compare' => 'LIKE',
                ),
            ),

        );
        $query = new WP_Query( $args );
    }

    if(isset($_POST['search_by_status'])){
        $args = array(
            'post_type' => 'task',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key'     => 'status_field',
                    'value'   => $_POST['search_by_status'],
                    'compare' => 'LIKE',
                ),
            ),

        );
        $query = new WP_Query( $args );
    }

    if(isset($_POST['search_by_sprint'])){
        $args = array(
            'post_type' => 'task',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key'     => 'sprint_field',
                    'value'   => $_POST['search_by_sprint'],
                    'compare' => 'LIKE',
                ),
            ),

        );
        $query = new WP_Query( $args );
    }

    if(isset($_POST['search_by_site'])){
        $args = array(
            'post_type' => 'task',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'doctor',
                    'field' => 'term_id',
                    'terms' => $_POST['search_by_site']
                ),
            ),
        );
        $query = new WP_Query( $args );
    }

    if(isset($_POST['restore'])){
        $args = array(
            'post_type' => 'task',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        );
        $query = new WP_Query( $args );
    }

    if(isset($_POST['sort_by_date'])){
        $args = array(
            'post_type' => 'task',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => array(
                'date' => 'ASC'
            )

        );
        $query = new WP_Query( $args );
    }

?>