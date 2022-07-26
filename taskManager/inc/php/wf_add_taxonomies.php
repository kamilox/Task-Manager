<?php

function add_tasks_terms(){
    //Insert kind of actions
    wp_insert_term(
        'Simple action',    //the term 
        'actions',  //the taxonomy
        array(
            'description' => 'Simple action',
            'slug'        => 'simple-actions',
            'parent'      => 'actions',
            )
    );
    wp_insert_term(
        'Recurrent action',    //the term 
        'actions',  //the taxonomy
        array(
            'description' => 'Recurrent action',
            'slug'        => 'recurrent-actions',
            'parent'      => 'actions',
            )
    );
    //Insert clients by default
    wp_insert_term(
        'Arian Mowlavi',    //the term 
        'client',  //the taxonomy
        array(
            'description' => 'Dr. Arian Mowlavi',
            'slug'        => 'arian-mowlavi',
            'parent'      => 'actions',
            )
    );
    //Add Dr Mowlavi's basics websites
    $parent_mowlavi_dr = term_exists( 'arian-mowlavi', 'client' );
    $parent_mowlavi_dr_id = $parent_mowlavi_dr['term_id']; 
    $mowlavi_sites= ['Cosmetic Plastic Surgery Institute', 'High Definition Liposuction', 'Dr. Laguna'];

    foreach ($mowlavi_sites as $key => $mowlavi_site) {
        wp_insert_term(
            $mowlavi_site,   // the term 
            'client', // the taxonomy
            array(
            'description' => $mowlavi_site,
            'slug'        => strtolower(str_replace(' ','-',$mowlavi_site)),
            'parent'      => $parent_mowlavi_dr_id,
            )
        );          
    }



    wp_insert_term(
        'Anh-Tuan Truong',    //the term 
        'client',  //the taxonomy
        array(
            'description' => 'Dr. Anh-Tuan Truong',
            'slug'        => 'anh-tuan-truong',
            'parent'      => 'actions',
            )
    );
    //Add Dr Truong's basics websites
    $parent_truong_dr = term_exists( 'anh-tuan-truong', 'client' );
    $parent_truong_dr_id = $parent_truong_dr['term_id']; 
    $truong_sites= ['Chicago Breast and Body', 'Femsculpt', 'Xsculpt', 'Chicago Aesthetics'];

    foreach ($truong_sites as $key => $truong_site) {
        wp_insert_term(
            $truong_site,   // the term 
            'client', // the taxonomy
            array(
            'description' => $truong_site,
            'slug'        => strtolower(str_replace(' ','-',$truong_site)),
            'parent'      => $parent_truong_dr_id,
            )
        );          
    }
    wp_insert_term(
        'Steven J. Cyr',    //the term 
        'client',  //the taxonomy
        array(
            'description' => 'Dr. Steven J. Cyr',
            'slug'        => 'steven-cyr',
            'parent'      => 'actions',
            )
    );
    
}
add_action('init', 'add_tasks_terms');
?>