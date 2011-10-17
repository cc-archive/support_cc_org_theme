<?php
    if ( ! function_exists('bloginfo') ) {
        function bloginfo ($param) {
            if ( $param == 'home' )
                print 'http://creativecommons.org';
            if ( $param == 'stylesheet_directory' ) {
                // print $theme_path . '/cc-wp';
                print '/sites/default/themes/cc/cc-wp';
            }
        }
    }
?>
