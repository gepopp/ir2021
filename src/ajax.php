<?php
add_action('wp_ajax_get_page_views', 'get_page_views');
add_action('wp_ajax_nopriv_get_page_views', 'get_page_views');

function get_page_views()
{
    $KEY_FILE_LOCATION = get_stylesheet_directory() . '/immobilien-redaktion-264213-b40469a0e617.json';

    if (file_exists($KEY_FILE_LOCATION)) {
        // Create and configure a new client object.
        $client = new \Google_Client();


        $client->setApplicationName("immobilien-redaktion-264213");
        $client->setAuthConfig($KEY_FILE_LOCATION);
        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $analytics = new \Google_Service_Analytics($client);


        $permalink = get_the_permalink($_POST['id']);
        $permalink = explode('/', $permalink);
        // $permalink = array_pop($permalink);


        $results = $analytics->data_ga->get(
            'ga:192606539',
            '2005-01-01',
            'today',
            'ga:pageviews',
            [
                'filters' => 'ga:pagePath=@' . get_post_field('post_name', $_POST['id']),

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

            // Print the results.
            wp_die($sessions);
        } else {
            return "No results found.";
        }
    } else {
        echo 'no json';
    }
}