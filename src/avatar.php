<?php
add_filter('pre_get_avatar_data', 'tsm_acf_profile_avatar', 10, 2);
function tsm_acf_profile_avatar( $args, $id_or_email ) {

  if ( $id_or_email instanceof WP_Comment ) {

        if ( ! empty( $id_or_email->user_id ) ) {

            $user = get_user_by( 'id', (int) $id_or_email->user_id );

        }

      // Get the file id
      $image = get_field('field_5ded37c474589', 'user_' . $user->ID); // CHANGE TO YOUR FIELD NAME


      //wp_die(var_dump($image));

      // Bail if we don't have a local avatar
      if ( ! $image) {
          return $args;
      }

      $image_id = $image['ID'];

      switch ($args['size']){
          case 24:
              $args['url'] = $image['sizes']['author_extra_small'] ?? $image['url'];
              break;
          case 48:
              $args['url'] = $image['sizes']['author_small'] ?? $image['url'];
              break;
          case 96:
              $args['url'] = $image['sizes']['author_large'] ?? $image['url'];
              break;
          default:
              $args['url'] = $image['url'];
      }

      return $args;
    }

  return $args;
}


add_action( 'rest_api_init', function() {
    \register_rest_field( 'comment', 'child_count', [
        'get_callback' => function ( $comment ) {

            $children = get_comments(['parent' => $comment['id']]);

            return (int) count($children);
        },
        'schema'       => [
            'description' => 'List number of comments attached to this post.',
            'type'        => 'integer',
        ],
    ] );
});