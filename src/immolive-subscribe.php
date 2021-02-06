<?php

namespace immobilien_redaktion_2020;

add_action('admin_post_subscribe_immolive', function () {

    $wrapper = new \ZoomAPIWrapper(get_field('field_60126f14b73d4', 'option'), get_field('field_60126f20b73d5', 'option'));


    if (!wp_verify_nonce($_POST['subscribe_immolive'], 'subscribe_immolive')) {
        wp_redirect(home_url());
    }

    if (sanitize_text_field($_POST['confirm']) !== 'on'
        || sanitize_text_field($_POST['email']) !== 'on'
        || get_post_type($_POST['immolive_id']) != 'immolive'
    ) {
        wp_redirect(get_field('field_601e5f56775db', 'option'));
    }

    $user = wp_get_current_user();
    $immolive_id = $_POST['immolive_id'];

    $registrants = get_field('field_601451bb66bc3', $immolive_id);

    $zoom_registrants = $wrapper->doRequest('GET', '/webinars/' . get_field('field_60127a6c90f6b', $immolive_id) . '/registrants');
    foreach ($zoom_registrants['registrants'] as $registrant) {

        $exists = false;

        foreach ($registrants as $existing_registrant) {
            if ($existing_registrant['user_email'] == $registrant['email']) {
                $exists = true;
            }
        }

        if (!$exists) {
            add_row('field_601451bb66bc3', [
                'user_name'            => $registrant['first_name'] . ' ' . $registrant['last_name'],
                'user_email'           => $registrant['email'],
                'hat_dsg_bestatigt'    => 0,
                'frage_ans_podium'     => $registrant['comment'],
                'zoom_registrant_id'   => $registrant['id'],
                'zoom_teilnehmer_link' => $registrant['join_url'],
            ], $immolive_id);
        }
    }

    foreach ($registrants as $registrant) {
        if ($registrant['user_email'] == $user->user_email) {
            wp_safe_redirect(get_field('field_601e5f56775db', 'option'));
        }
    }


    $response = $wrapper->doRequest('POST', '/webinars/' . get_field('field_60127a6c90f6b', $immolive_id) . '/registrants', [], [], [
        'email'      => $user->user_email,
        'first_name' => $user->first_name,
        'last_name'  => $user->last_name,
        'comments'   => sanitize_text_field($_POST['question']),
    ]);

    add_row('field_601451bb66bc3', [
        'user_name'            => $user->first_name . ' ' . $user->last_name,
        'user_email'           => $user->user_email,
        'hat_dsg_bestatigt'    => 1,
        'frage_ans_podium'     => sanitize_text_field($_POST['question']),
        'zoom_registrant_id'   => $response['registrant_id'],
        'zoom_teilnehmer_link' => $response['join_url'],
        'referer'              => sanitize_text_field($_POST['referer']),
    ], $immolive_id);


    wp_safe_redirect(get_field('field_601e5f56775db', 'option'));

});