<?php

namespace immobilien_redaktion_2020;

use Carbon\Carbon;

add_filter('acf/update_value/key=field_5fe7058a647cb', function ($value, $post_id, $field, $original) {


    $vimeo_id = get_field('field_5fe2884da38a5', $post_id);

    if ($vimeo_id != '') {
        $vimeo_id = get_field('field_5fe2884da38a5', $post_id);
        $lib = new \Vimeo\Vimeo('f1663d720a1da170d55271713cc579a3e15d5d2f', 'd30MDbbXFXRhZK2xlnyx5VMk602G7J8Z0VHFP8MvNnDDuAVfcgPj2t5zwE5jpbyXweFrQKa9Ey02edIx/E3lJNVqsFxx+9PRShAkUA+pwyCeoh9rMoVT2dWv2X7WurgV', 'b57bb7953cc356e8e1c3ec8d4e17d2e9');
        $response = $lib->request('/videos/' . $vimeo_id, [], 'GET');
        $body = $response['body'];

        return $body['pictures']['sizes'][4]['link'];
    }
    return $value;


}, 10, 4);


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