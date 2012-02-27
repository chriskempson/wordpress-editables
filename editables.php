<?php
/**
 * @package Editables
 */
/*
Plugin Name: Editables
Description: Create editable areas for your layout
Plugin URI: https://github.com/chriskempson/wordpress-editables
Version: 1.0
Author: Chris Kempson
Author URI: http://chriskempson.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

define('EDITABLES_VERSION', '1.0.0');
define('EDITABLES_PLUGIN_URL', plugin_dir_url( __FILE__ ));

if ( is_admin() )
	require_once dirname( __FILE__ ) . '/admin.php';

// Add custom post type for editables
add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'editable',
		array(
			'labels' => array(
				'name' => __( 'Editables' ),
				'singular_name' => __( 'Editable' ),
				'add_new' => __( 'Add New' ),
				'add_new_item' => __( 'Add New Editable' ),
				'edit_item' => __( 'Edit Editable' ),
				'new_item' => __( 'New Editable' ),
				'all_items' => __( 'All Editables' ),
				'view_item' => __( 'View Editable'),
				'not_found' =>  __( 'No editables found'),
				'not_found_in_trash' => __( 'No editables found in Trash' ),
				'menu_name' => 'Editables'
			),
			'description' => 'Editiable layout areas',
			'public' => true,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'supports' => array(
				'title',
				'editor',
				'custom-fields',
			),
		)
	);
}

// Helper functions for theme developers
function get_editable( $slug ) {
	return get_page_by_path($slug, null, 'editable');
}

function get_editable_field( $slug, $field ) {
	$editable = get_editable($slug);
	return (is_object($editable) ? $editable->$field : null);
}

function the_editable_field( $slug, $field ) {
	echo get_editable_field($slug, $field);
}

function the_editable_content( $slug ) {
	$content = get_editable_field($slug, 'post_content');
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	echo $content;
}