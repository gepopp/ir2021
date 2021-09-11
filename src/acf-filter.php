<?php

namespace immobilien_redaktion_2020;

use Carbon\Carbon;

add_filter('acf/load_field/key=field_601273dde8eb6', function ($field) {


    $wrapper = new \ZoomAPIWrapper(get_field('field_60126f14b73d4', 'option'), get_field('field_60126f20b73d5', 'option'));
    $result = $wrapper->doRequest('GET', '/users/' . get_field('field_6012782af436e', 'option'));

    if ($result) {
        $zoom_user_id = $result['id'];
    }
    $webinars = $wrapper->doRequest('GET', '/webinars/82588347464/registrants');

    ob_start();
    ?>
    <pre>
        <code>
            <?php echo print_r($webinars) ?>
        </code>
    </pre>
    <?php
    $field['message'] = ob_get_clean();
    return $field;

});