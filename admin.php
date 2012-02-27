<?php
/**
 * @package Editables
 */

// Enqueue 'editable.css'
add_action( 'admin_enqueue_scripts', 'editables_load_css' );
function editables_load_css() {
		wp_register_style( 'editables.css', EDITABLES_PLUGIN_URL . 'editables.css' );
		wp_enqueue_style( 'editables.css' );
}

// Add 'Slug' column to admin ui
function editables_columns( $columns ) {
	unset($columns['date']);
    return array_merge($columns, 
              array('slug' => __('Slug'),
                    'date' => __('Date')));
}
add_filter('manage_edit-editable_columns', 'editables_columns');

// Get data for 'Slug' column
function editables_custom_columns( $column ) {
	global $post;
	switch( $column ) {
		case 'slug':
			echo $post->post_name;
		break;
	}
}
add_action('manage_posts_custom_column', 'editables_custom_columns');
