<?php
/**
 *  Shortcodes for the custom product plugin
 */

class ProductShortCodes{

    public function __construct()
    {
        add_action( 'init',array($this,'registerPostType') );
    }
}