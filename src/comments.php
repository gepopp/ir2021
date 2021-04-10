<?php

namespace immobilien_redaktion_2020;

add_action('wp_insert_comment', function ($id, $comment) {

    wp_schedule_single_event(time() + 30,
        'scheduledAdminNotice',
        ['comment' => $comment]);

    return $comment;

}, 10, 2);

add_action('scheduledAdminNotice', 'immobilien_redaktion_2020\sendAdminCommentNotice', 10, 1);

function sendAdminCommentNotice($comment)
{
    $addresses = get_field('field_607177c0d282b', 'option');

    ob_start();
    echo '<p>';
    echo $comment->comment_author;
    echo '</p><p>';
    echo $comment->comment_author_email;
    echo '</p><p>';
    echo $comment->comment_content;
    echo '</p><p>';
    echo $comment->comment_date;
    echo '</p><p>';
    echo '<a href="' . get_edit_comment_link($comment->comment_ID) . '">bearbeiten</a>';
    echo '</p>';
    $content = ob_get_clean();


    wp_mail($addresses, 'Neuer kommentar auf der Immobilien Redaktion', $content, ['Content-Type: text/html; charset=UTF-8']);
}