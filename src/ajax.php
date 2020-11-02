<?php
add_action('wp_ajax_get_page_views', 'get_page_views');
add_action('wp_ajax_nopriv_get_page_views', 'get_page_views');

function get_page_views($post_id = null)
{
    $KEY_FILE_LOCATION = get_stylesheet_directory() . '/immobilien-redaktion-264213-b40469a0e617.json';

    if (file_exists($KEY_FILE_LOCATION)) {
        // Create and configure a new client object.
        $client = new \Google_Client();


        $client->setApplicationName("immobilien-redaktion-264213");
        $client->setAuthConfig($KEY_FILE_LOCATION);
        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $analytics = new \Google_Service_Analytics($client);


        $permalink = get_the_permalink($post_id ?? $_POST['id']);
        $permalink = explode('/', $permalink);
        // $permalink = array_pop($permalink);


        $results = $analytics->data_ga->get(
            'ga:192606539',
            '2005-01-01',
            'today',
            'ga:pageviews',
            [
                'filters' => 'ga:pagePath=@' . get_post_field('post_name', $post_id ?? $_POST['id']),

            ]
        );

        // Parses the response from the Core Reporting API and prints
        // the profile name and total sessions.
        if (count($results->getRows()) > 0) {

            // Get the profile name.
            $profileName = $results->getProfileInfo()->getProfileName();

            // Get the entry for the first entry in the first row.
            $rows = $results->getRows();
            $sessions = $rows[0][0];


            if (defined('DOING_AJAX') && DOING_AJAX) {
                // Print the results.
                wp_die($sessions);
            } else {
                return $sessions;
            }


        } else {
            return "No results found.";
        }
    } else {
        echo 'no json';
    }
}

add_action('wp_ajax_load_more_category', 'load_more_category');
add_action('wp_ajax_nopriv_load_more_category', 'load_more_category');

function load_more_category()
{
//
//    echo var_dump($_POST);
//    die();
//

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

add_action('wp_ajax_load_videosload_videos', 'load_videos');
add_action('wp_ajax_nopriv_load_videos', 'load_videos');

function load_videos()
{

    $query = new WP_Query([
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'posts_per_page'      => 6,
        'paged'               => (int)$_POST['page'],
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