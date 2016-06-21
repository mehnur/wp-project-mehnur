<?php
/**
 * Plugin Name: Mehnur Plugin
 * Plugin URI: http://xentora.com
 * Description:
 * Version: 1.0
 * Author: Arif Amir | Mehnur Tahir
 * Author URI: http://xentora.com/
 * Developer: Xentora Solutions
 * Developer URI: http://xentora.com/
 * Copyright: � 2016 Xentora Solutions.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

 
 //Shortcode
 
 function myFirstShortCode(){
	 
	 $string = 'Hi this is my first shortcode';
	 return $string;
 }
 
 add_shortcode('mehnur_shortcode1','myFirstShortCode');
 
 // Paste [mehnur_shortcode] in any page or post. It will show the output.
 
 
 //Shortcode
 
 function bookShortCode(){
	 
	 $args = array(
		'post_type' => 'book'
	 );
	 
	 $query = new WP_Query( $args );
	 
	 ob_start();
	 
	 if($query->have_posts()){
		 
		while ( $query->have_posts() ) : $query->the_post(); 
			
			//echo '<h1>' . the_title() . '</h1>';
			echo '<h1><a href="'.get_permalink().'">' . get_the_title() . '</a></h1>';
				
		endwhile; // end of the loop.
	 }
	 
	  $content = ob_get_contents();
	  ob_end_clean();
	 
	 return $content;
	 
 }
 
 add_shortcode('mehnur_shortcode','bookShortCode');
 
 
 
 add_action( 'init', 'codex_book_init' );

 /**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_book_init() {
	$labels = array(
		'name'               => _x( 'Books', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Book', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Books', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Book', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Book', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Book', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Book', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Books', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'book' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title' , 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'book', $args );
	//register_post_type( 'mehnur', $args );
}
 
 
 
 
