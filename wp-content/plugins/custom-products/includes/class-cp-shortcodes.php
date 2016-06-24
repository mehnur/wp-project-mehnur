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

        return 'Products listed.';
    }
}