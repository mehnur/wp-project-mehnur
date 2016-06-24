<?php
/**
 * Custom post types for the CPT plugin
 */

class customPostTypeProduct{

    public function __construct()
    {
        add_action( 'init',array($this,'registerPostType') );
    }

    public function registerPostType()
    {

            $product_args = apply_filters( 'filter_products_args',
                array(
                    'labels'              => array(
                        'name'                  => __( 'Products', 'cp-lang' ),
                        'singular_name'         => __( 'Product', 'cp-lang' ),
                        'menu_name'             => _x( 'Products', 'Admin menu name', 'cp-lang' ),
                        'add_new'               => __( 'Add Product', 'cp-lang' ),
                        'add_new_item'          => __( 'Add New Product', 'cp-lang' ),
                        'edit'                  => __( 'Edit', 'cp-lang' ),
                        'edit_item'             => __( 'Edit Product', 'cp-lang' ),
                        'new_item'              => __( 'New Product', 'cp-lang' ),
                        'view'                  => __( 'View Product', 'cp-lang' ),
                        'view_item'             => __( 'View Product', 'cp-lang' ),
                        'search_items'          => __( 'Search Products', 'cp-lang' ),
                        'not_found'             => __( 'No Products found', 'cp-lang' ),
                        'not_found_in_trash'    => __( 'No Products found in trash', 'cp-lang' ),
                        'parent'                => __( 'Parent Product', 'cp-lang' ),
                        'featured_image'        => __( 'Product Image', 'cp-lang' ),
                        'set_featured_image'    => __( 'Set products image', 'cp-lang' ),
                        'remove_featured_image' => __( 'Remove products image', 'cp-lang' ),
                        'use_featured_image'    => __( 'Use as products image', 'cp-lang' ),
                    ),
                    'description'         => __( 'This is where you can add new products to your store.', 'cp-lang' ),
                    'public'              => true,
                    'show_ui'             => true,
                    'map_meta_cap'        => true,
                    'publicly_queryable'  => true,
                    'exclude_from_search' => false,
                    'hierarchical'        => false, // Hierarchical causes memory issues - WP loads all records!
                    'rewrite'             => array( 'slug' => 'cp-product', 'with_front' => false, 'feeds' => true ),
                    'query_var'           => true,
                    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields', 'page-attributes', 'publicize', 'wpcom-markdown' ),
                    'has_archive'         => 'shop',
                    'show_in_nav_menus'   => true
                ));

            register_post_type( 'product',$product_args);
    }

}

new customPostTypeProduct();