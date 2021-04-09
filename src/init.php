<?php
add_action('init', function (){
    if(is_page_template('pagetemplate-google-login.php'))
    echo var_dump($_REQUEST);
});