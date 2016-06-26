<?php
/**
 *  Shortcodes for the custom product plugin
 */

class ProductShortCodes{

    public function __construct()
    {
        add_shortcode( 'list_products',array($this,'listProducts') );
    }

    public function listProducts()
    {
            $args = array(
                'post_type' => 'product',
                'post_status'=>'publish'

            );
        $query = new WP_Query($args);

        if($query->have_posts()){

            while ( $query->have_posts() ) : $query->the_post();

                global $post;

//                print_r($post);
//                echo $post->ID;
//                exit;

                $price = get_post_meta($post->ID,'price',true);
                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */

                ?>
                <h2> Title :  <?php the_title(); ?> </h2>
                <h3> Price : <?php echo $price; ?>

                <?php

                // End the loop.
            endwhile;
        }

        return 'Products listed.';
    }
}

new ProductShortCodes();