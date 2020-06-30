<?php
function post_type_dental_procedures() {
	$labels = array(
    	'name' => _x('Dental Procedures', '', 'majix'),
    	'singular_name' => _x('Dental Procedures', '', 'majix'),
    	'add_new' => _x('Add New Dental Procedure', 'majix'),
    	'add_new_item' => __('Add New Dental Procedure', 'majix'),
    	'edit_item' => __('Edit Dental Procedure', 'majix'),
    	'new_item' => __('New Dental Procedure', 'majix'),
    	'view_item' => __('View Dental Procedure', 'majix'),
    	'search_items' => __('Search Dental Procedures', 'majix'),
    	'not_found' =>  __('No Dental Procedure found', 'majix'),
    	'not_found_in_trash' => __('No Dental Procedures found in Trash', 'majix'), 
    	'parent_item_colon' => ''
	);
	$args = array(
    	'labels'              => $labels,
    	'public'              => true,
    	'publicly_queryable'  => true,
    	'show_ui'             => true,
    	'query_var'           => true,
    	'rewrite'             => true,
    	'capability_type'     => 'post',
    	'hierarchical'        => false,
    	'menu_position'       => 5,
    	'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
    	'menu_icon'           => 'dashicons-format-aside'
	);
	register_post_type( 'dental_procedures', $args );
}
add_action('init', 'post_type_dental_procedures');