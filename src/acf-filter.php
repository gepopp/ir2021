<?php

namespace immobilien_redaktion_2020;

add_filter('acf/update_value/key=field_5fe7058a647cb', function ($value, $post_id, $field, $original){


   $vimeo_id = get_field('field_5fe2884da38a5', $post_id);

   if($vimeo_id != ''){
       $vimeo_id = get_field('field_5fe2884da38a5', $post_id);
       $lib = new \Vimeo\Vimeo('f1663d720a1da170d55271713cc579a3e15d5d2f', 'd30MDbbXFXRhZK2xlnyx5VMk602G7J8Z0VHFP8MvNnDDuAVfcgPj2t5zwE5jpbyXweFrQKa9Ey02edIx/E3lJNVqsFxx+9PRShAkUA+pwyCeoh9rMoVT2dWv2X7WurgV', 'b57bb7953cc356e8e1c3ec8d4e17d2e9');
       $response = $lib->request('/videos/' . $vimeo_id, [], 'GET');
       $body = $response['body'];

       return  $body['pictures']['sizes'][4]['link'];
   }
   return $value;


}, 10, 4);