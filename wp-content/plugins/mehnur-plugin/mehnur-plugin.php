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
 * Copyright:2016 Xentora Solutions.
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
		'post_type' => 'book',
         'post_status'=>'publish'
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


// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_book_taxonomies', 0 );

// create two taxonomies, genres and Authors for the post type "book"
function create_book_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Genres', 'taxonomy general name' ),
        'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Genres' ),
        'all_items'         => __( 'All Genres' ),
        'parent_item'       => __( 'Parent Genre' ),
        'parent_item_colon' => __( 'Parent Genre:' ),
        'edit_item'         => __( 'Edit Genre' ),
        'update_item'       => __( 'Update Genre' ),
        'add_new_item'      => __( 'Add New Genre' ),
        'new_item_name'     => __( 'New Genre Name' ),
        'menu_name'         => __( 'Genre' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'genre' ),
    );

    register_taxonomy( 'genre', array( 'book' ), $args );

    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'Authors', 'taxonomy general name' ),
        'singular_name'              => _x( 'Writer', 'taxonomy singular name' ),
        'search_items'               => __( 'Search Authors' ),
        'popular_items'              => __( 'Popular Authors' ),
        'all_items'                  => __( 'All Authors' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Writer' ),
        'update_item'                => __( 'Update Writer' ),
        'add_new_item'               => __( 'Add New Writer' ),
        'new_item_name'              => __( 'New Writer Name' ),
        'separate_items_with_commas' => __( 'Separate Authors with commas' ),
        'add_or_remove_items'        => __( 'Add or remove Authors' ),
        'choose_from_most_used'      => __( 'Choose from the most used Authors' ),
        'not_found'                  => __( 'No Authors found.' ),
        'menu_name'                  => __( 'Authors' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'writer' ),
    );

    register_taxonomy( 'writer', 'book', $args );
}
 

add_action('before_form','addField');
function addField(){
    ?>
    This is my form
    <input type="text" name="test" placeholder="test field by arif" />
    <?php
}

add_filter('modify_args','argChanges',10,2);
function argChanges($args,$secondargument){

    $args['post_type']='post';

    return $args;

}

add_filter('login_headertitle','ssargChanges',10,1);
function ssargChanges($title){

    $title = 'MEHNNNNNNNNNUUURR';
    return $title;

}

// 10 is for the piroity for execution
// 2 shows number of arguments. If there is one arugment then we dont pass 1 but if there are more than 1 argument, then we have to pass the
// argumetn in the add_filter hook

add_action('login_enqueue_scripts','ourFooter');
function ourFooter(){

    echo 'hellllloooo';
}