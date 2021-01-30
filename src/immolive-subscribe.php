<?php
namespace immobilien_redaktion_2020;

add_action('admin_post_subscribe_immolive', function (){

    if(!wp_verify_nonce($_POST['subscribe_immolive'], 'subscribe_immolive')){
        wp_redirect(home_url());
    }

    if(sanitize_text_field($_POST['confirm']) !== 'on'
        || sanitize_text_field($_POST['email']) !== 'on'
        || get_post_type($_POST['immolive_id']) != 'immolive'
    ){
        wp_die('not valid');
        wp_redirect(home_url('live'));
    }

    $user = wp_get_current_user();
    $immolive_id = $_POST['immolive_id'];

    $registrants = get_field('field_601451bb66bc3', $immolive_id);

    foreach ($registrants as $registrant){
        if($registrant['user_email'] == $user->user_email){
            wp_safe_redirect(home_url('diskutieren'));
        }
    }

    add_row('field_601451bb66bc3', [
        'user_name' => $user->first_name . ' ' . $user->last_name,
        'user_email' => $user->user_email,
        'hat_dsg_bestatigt' => 1,
        'frage_ans_podium' => sanitize_text_field($_POST['question'])
    ], $immolive_id);

    wp_safe_redirect(home_url('diskutieren'));

});