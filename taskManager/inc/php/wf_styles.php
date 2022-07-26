<?php

function wf_styles(){
	wp_enqueue_style('wf-style',  plugins_url(  '../css/wf_style.css',__FILE__), 1.2 );
	wp_enqueue_script('jquery');
	wp_enqueue_script('wf-query',  plugins_url( '../js/wf_query.js',__FILE__), array('jquery'), 1.2);
}
add_action('init', 'wf_styles');
?>