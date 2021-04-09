<?php
add_action('init', function (){
    if(is_page_template('pagetemplate-google-login.php')){
        wp_die(var_dump($_REQUEST));
    }

});