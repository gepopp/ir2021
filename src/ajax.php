<?php
namespace immobilien_redaktion_2020;

add_action('wp_ajax_load_vimeo_thumbnail', 'immobilien_redaktion_2020\load_vimeo_image');
add_action('wp_ajax_nopriv_load_vimeo_thumbnail', 'immobilien_redaktion_2020\load_vimeo_image');

function load_vimeo_image(){
    $lib = new \Vimeo\Vimeo('f1663d720a1da170d55271713cc579a3e15d5d2f', 'd30MDbbXFXRhZK2xlnyx5VMk602G7J8Z0VHFP8MvNnDDuAVfcgPj2t5zwE5jpbyXweFrQKa9Ey02edIx/E3lJNVqsFxx+9PRShAkUA+pwyCeoh9rMoVT2dWv2X7WurgV', 'b57bb7953cc356e8e1c3ec8d4e17d2e9');
    $response = $lib->request('/videos/' . $_POST['id'], [], 'GET');
    $body = $response['body'];

    wp_die( $body['pictures']['sizes'][2]['link'] );

}

add_action('wp_ajax_get_page_views', 'immobilien_redaktion_2020\get_page_views');
add_action('wp_ajax_nopriv_get_page_views', 'immobilien_redaktion_2020\get_page_views');

function get_page_views()
{

//    $KEY_FILE_LOCATION = get_stylesheet_directory() . '/immobilien-redaktion-264213-b40469a0e617.json';
//
//    if (file_exists($KEY_FILE_LOCATION)) {
//
//        $client = new \Google_Client();
//        $client->setApplicationName("immobilien-redaktion-264213");
//        $client->setAuthConfig($KEY_FILE_LOCATION);
//        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
//        $analytics = new \Google_Service_Analytics($client);
//
//        $results = $analytics->data_ga->get(
//            'ga:192606539',
//            '2005-01-01',
//            'today',
//            'ga:pageviews',
//            [
//                'filters' => 'ga:pagePath=@' . get_post_field('post_name', $_POST['id']),
//
//            ]
//        );
//
//        if (count($results->getRows()) > 0) {
//
//            $rows = $results->getRows();
//            $sessions = $rows[0][0];
//
//            update_field('field_5f9ff32f68d04', $sessions, $_POST['id']);
//            wp_die($sessions);
//
//
//        } else {
//            return "No results found.";
//        }
//    } else {
//        echo 'no json';
//    }
}

add_action('wp_ajax_load_more_category', 'immobilien_redaktion_2020\load_more_category');
add_action('wp_ajax_nopriv_load_more_category', 'immobilien_redaktion_2020\load_more_category');

function load_more_category()
{
    $query = new WP_Query([

        'post_type'           => 'post',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'posts_per_page'      => 10,
        'cat'                 => (int)$_POST['id'],
        'offset'              => (int)$_POST['offset'],
    ]);

    $posts = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();


            $posts[] = [
                'ID'        => get_the_ID(),
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),
                'img_url'   => !has_post_thumbnail() || !checkRemoteFile(get_the_post_thumbnail_url(get_the_ID(), 'article')) ? false : get_the_post_thumbnail_url(get_the_ID(), 'article'),
                'author'    => get_the_author(),
                'date'      => get_the_time('d.m.Y'),
            ];
        }
    }
    echo json_encode($posts);
    die();

}


add_action('wp_ajax_load_more_author', 'immobilien_redaktion_2020\load_more_author');
add_action('wp_ajax_nopriv_load_more_author', 'immobilien_redaktion_2020\load_more_author');

function load_more_author()
{
    $query = new WP_Query([

        'post_type'           => 'post',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'posts_per_page'      => 10,
        'category__not_in'    => [17, 696, 159],
        'tag__not_in'         => 989,
        'author'              => (int)$_POST['id'],
        'offset'              => (int)$_POST['offset'],
    ]);

    $posts = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();


            $posts[] = [
                'ID'        => get_the_ID(),
                'title'     => get_the_title(),
                'permalink' => get_the_permalink(),
                'img_url'   => !has_post_thumbnail() || !checkRemoteFile(get_the_post_thumbnail_url(get_the_ID(), 'article')) ? false : get_the_post_thumbnail_url(get_the_ID(), 'article'),
                'author'    => get_the_author(),
                'date'      => get_the_time('d.m.Y'),
            ];
        }
    }
    echo json_encode($posts);
    die();

}


add_action('wp_ajax_load_videos', 'immobilien_redaktion_2020\load_videos');
add_action('wp_ajax_nopriv_load_videos', 'immobilien_redaktion_2020\load_videos');

function load_videos()
{

    $query = new \WP_Query([
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'posts_per_page'      => 6,
        'paged'               => (int)$_POST['page'] + 1,
        'category__in'        => [(int)$_POST['cat']],
    ]);

    $posts = [];

    if ($query->have_posts()):
        $runner = 1;
        while ($query->have_posts()):
            $query->the_post();

            if (get_field('field_5c65130772844')):
                $url = "https://cdn.jwplayer.com/v2/media/" . get_field('field_5c65130772844') . "/poster.jpg";
            elseif (get_field('field_5f96fa1673bac')):
                $url = "https://img.youtube.com/vi/" . get_field('field_5f96fa1673bac') . "/mqdefault.jpg";
            elseif (get_field('field_5fe2884da38a5')):
                $lib = new \Vimeo\Vimeo('f1663d720a1da170d55271713cc579a3e15d5d2f', 'd30MDbbXFXRhZK2xlnyx5VMk602G7J8Z0VHFP8MvNnDDuAVfcgPj2t5zwE5jpbyXweFrQKa9Ey02edIx/E3lJNVqsFxx+9PRShAkUA+pwyCeoh9rMoVT2dWv2X7WurgV', 'b57bb7953cc356e8e1c3ec8d4e17d2e9');
                $response = $lib->request('/videos/' . get_field('field_5fe2884da38a5'), [], 'GET');
                $body = $response['body'];
                $url = $body['pictures']['sizes'][2]['link'];
            else:
                $url = false;
            endif;


            $posts[] = [
                'ID'        => get_the_ID(),
                'permalink' => get_the_permalink(),
                'title'     => get_the_title(),
                'img'       => $url,
            ];
            $runner++;
        endwhile;
    endif;


    wp_die(json_encode($posts));
}

add_action('wp_ajax_nopriv_user_exists', function () {
    if (get_user_by('email', sanitize_email($_POST['email']))) {
        wp_die('success');
    } else {
        wp_die('not find', 400);
    }
});
add_action('wp_ajax_user_exists', function () {
    if (get_user_by('email', sanitize_email($_POST['email']))) {
        wp_die('success');
    } else {
        wp_die('not find', 400);
    }
});



add_action('wp_ajax_send_email_pin', function (){

    $user = get_user_by('email', sanitize_email($_POST['old_email']));

    if(!$user){
        wp_die("Wir konnten keinen Pin senden, laden Sie die Seite neu und versuchen sie es erneut.", 400);
    }

    global $wpdb;

    $wpdb->delete('wp_user_pending_email', ['user_id' => $user->ID]);

    $pin = rand(1001,9999);

    $wpdb->insert('wp_user_pending_email',
    [
       'user_id' => $user->ID,
       'new_email' => sanitize_email($_POST['email']),
       'pin' => $pin
    ],
    ['%d', '%s', '%d']);


    $result = wp_remote_post('https://api.createsend.com/api/v3.2/transactional/smartEmail/0ee71250-5880-473a-b721-bd741fa17f0d/send', [
        'headers' => [
            'authorization' => 'Basic ' . base64_encode('fab3e169a5a467b38347a38dbfaaad6d'),
        ],
        'body'    => json_encode([
            'To'                  => $user->data->user_email,
            "Data"
                                  => [
                'fullname' => $user->data->display_name,
                'PIN'     => $pin,
            ],
            "AddRecipientsToList" => false,
            "ConsentToTrack"      => "Yes",
        ]),
    ]);



    if (wp_remote_retrieve_response_code($result) < 200 || wp_remote_retrieve_response_code($result) > 299) {
        wp_die('Wir konnten keinen Pin senden.', 400);
    }
    wp_die('success');
//
});


add_action('wp_ajax_validate_pin', function (){


    global $wpdb;
    $pin_row = $wpdb->get_row('SELECT * FROM wp_user_pending_email WHERE pin = ' . sanitize_text_field($_POST['pin']));



    if(!$pin_row || sanitize_email($_POST['email']) != $pin_row->new_email){
        wp_die('Pin falsch', 400);
    }


    wp_update_user([
       'ID' =>$pin_row->user_id,
       'user_email' => $pin_row->new_email
    ]);

    wp_die('update erfolgreich');


});

add_action('wp_ajax_update_reading_log', function(){

    $user = sanitize_text_field($_POST['user']);
    $post = sanitize_text_field($_POST['post']);

    $depth = (int) sanitize_text_field($_POST['depth']) > 100 ? 100 : sanitize_text_field($_POST['depth']);

    if($depth > 10){
        global $wpdb;

        $exist = $wpdb->get_var(sprintf('SELECT id FROM wp_reading_log WHERE user_id = %d AND post_id = %d', $user, $post));

        if($exist == null){
            $wpdb->insert('wp_reading_log',
            [
                'user_id' => $user,
                'post_id' => $post,
                'scroll_depth' => $depth,
                'permalink' => get_the_permalink($post),
                'created_at'    => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ], ['%d', '%d', '%d', '%s', '%s']);
        }else{
            $wpdb->update('wp_reading_log',
                ['scroll_depth' => $depth],
                ['id' => $exist],
                ['%d'],
                ['%d']);
        }
        wp_die($depth);
    }
});

add_action('wp_ajax_load_log', function (){

    global $wpdb;

    $log = sanitize_text_field($_POST['log']);

    if($log == 'read'){
       $sql = sprintf('SELECT * FROM wp_reading_log WHERE user_id = %d AND scroll_depth = 100 ORDER BY created_at DESC LIMIT %d, 10', sanitize_text_field($_POST['user_id']), sanitize_text_field($_POST['offset']));
    }

    if($log == 'not_read'){
        $sql = sprintf('SELECT * FROM wp_reading_log WHERE user_id = %d AND scroll_depth < 100 ORDER BY created_at DESC LIMIT %d, 10', sanitize_text_field($_POST['user_id']), sanitize_text_field($_POST['offset']));
    }

    $logs = $wpdb->get_results($sql);

    $return = [];
    foreach ($logs as $d) {

        $cat = get_the_category($d->post_id);
        $cat = array_shift($cat);

        $author = 'Von ' . get_the_author_meta('display_name', get_post_field('post_author', $d->post_id)) . ' am ' . get_the_time('d.m.Y', $d->post_id);

        $return[] = [
            'id'        => $d->id,
            'title'     => html_entity_decode(get_the_title($d->post_id)),
            'permalink' => get_the_permalink($d->post_id),
            'cat'       => $cat->name ?? '',
            'author'    => $author,
            'time'      => ucfirst(\Carbon\Carbon::parse($d->created_at)->diffForHumans() . ' zu ' . $d->scroll_depth). '%'
        ];
    }

    wp_die(json_encode($return));

});