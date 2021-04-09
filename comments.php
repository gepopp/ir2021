<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Freeshifter
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}

$gray = 'gray-800';
if (get_post_format() == 'video') {
    $gray = 'white';
}


?>

<div id="comments" class="comments-area">
    <div>
        <?php
        $user = wp_get_current_user();
        $image = get_field('field_5ded37c474589', 'user_' . $user->ID);
        ?>
        <div x-data="addComment(<?php echo $user->ID ?>, <?php the_ID(); ?>)" x-init="init()">
            <div class="flex space-x-3 items-end pb-5 mb-5">
                <?php if ($image): ?>
                    <img src="<?php echo $image['sizes']['author_small'] ?>" class="rounded-full w-16 h-16 p-1 border border-<?php echo $gray ?>">
                <?php else: ?>
                    <?php echo get_avatar($user, 48, null, null, ['class' => 'rounded-full w-12 h-12 p-1 border border-' . $gray]) ?>
                <?php endif; ?>

                <?php if (is_user_logged_in()): ?>
                    <div class="flex-grow relative">
                        <textarea
                                x-model="comment"
                                type="text"
                                class="rounded-l shadow-xl bg-gray-100 w-full  text-gray-800 border-b border-white block w-full py-2 px-2 leading-tight appearance-none focus:outline-none placeholder-gray-500 h-12"
                                placeholder="Schreiben Sie einen neuen Kommentar ..." @keydown.enter="validate()"></textarea>
                        <p class="text-xs text-aktuelles-100 absolute" x-text="commentError" x-show="commentError"></p>
                    </div>
                    <div class="" @click="validate()">
                        <svg class="w-8 h-8 text-<?php echo $gray ?> font-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                <?php else: ?>
                    <div class="w-full">
                        <p>Zum kommentieren bitte</p>
                        <div class="flex space-x-5 w-full">
                            <div class="flex-1">
                                <?php $link = get_the_permalink();
                                $link .= '#comments';

                                ?>
                                <a href="<?php echo add_query_arg(['redirect' => $link], get_field('field_601bbffe28967', 'option')); ?>" class="block w-full py-3 border border-primary-100 text-white font-medium text-center">einloggen</a>
                            </div>
                            <div class="flex-1">
                                <a href="<?php echo add_query_arg(['redirect' => get_the_permalink()], get_field('field_601bc00528968', 'option')); ?>" class="block w-full py-3 border border-primary-100 text-white font-medium text-center">registrieren</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <hr>


            <template x-for="c in comments" x-key="comment.id">

                <div class="flex space-x-2 py-3">
                    <div>
                        <img :src="c.author_avatar_urls[48]" class="rounded-full p-1 border border-white w-10 h-10">
                    </div>
                    <div class="flex-1">
                        <p x-text="formatDate(c.date)" class="text-xs m-0 text-<?php echo $gray ?>"></p>
                        <div class="text-<?php echo $gray ?> text-lg comment" x-html="c.content.rendered"></div>
                        <p class="text-<?php echo $gray ?> uppercase font-medium text-xs cursor-pointer m-0" @click="openAnswer(c)" x-show="c.id != addAnswer">
                            <span x-text="c.child_count + ' - '" x-show="c.child_count > 0" class="text-<?php echo $gray ?>"></span>Antworten
                        </p>

                        <div x-show="addAnswer == c.id" @click.away="addAnswer = false">
                            <template x-for="child in children">
                                <div>
                                    <div class="shadow rounded-md p-4 w-full mx-auto" x-show="!child.id">
                                        <div class="animate-pulse flex space-x-4 items-center">
                                            <div class="rounded-full bg-gray-100 h-10 w-10"></div>
                                            <div class="flex-1 space-y-4 py-1">
                                                <div class="space-y-2">
                                                    <div class="h-4 bg-gray-100 rounded"></div>
                                                    <div class="h-4 bg-gray-100 rounded w-5/6"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show.transition.fade.in="child.id" class="flex space-x-4 items-center px-4 py-2">
                                        <div>
                                            <img :src="child.author_avatar_urls[48]" class="rounded-full p-1 border border-<?php echo $gray ?> w-10 h-10 flex-none">
                                        </div>
                                        <div class="flex-1">
                                            <p x-text="formatDate(child.date)" class="text-xs m-0 text-<?php echo $gray ?> -mb-1"></p>
                                            <div class="text-<?php echo $gray ?> text-lg comment" x-html="child.content.rendered"></div>
                                        </div>
                                    </div>
                            </template>


                            <?php if (is_user_logged_in()): ?>
                                <div class="flex items-end space-x-4">
                                        <textarea
                                                x-model="answer"
                                                type="text"
                                                class="rounded-l shadow-xl mt-3 bg-gray-100 w-full  text-gray-800 border-b border-white block w-full py-2 px-2 leading-tight appearance-none focus:outline-none placeholder-gray-500 h-12"
                                                placeholder="Antworten Sie hier ..." @keydown.enter="validate(c.id)"></textarea>
                                    <div class="" @click="validate(c.id)">
                                        <svg class="w-8 h-8 text-<?php echo $gray ?> font-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                </div>
                            <?php else: ?>
                                <p>Zum antworten bitte</p>
                                <div class="flex space-x-5 w-full">
                                    <div class="flex-1">
                                        <a href="<?php echo add_query_arg(['redirect' => $link], get_field('field_601bbffe28967', 'option')); ?>" class="block w-full py-3 border border-primary-100 text-white font-medium text-center">einloggen</a>
                                    </div>
                                    <div class="flex-1">
                                        <a href="<?php echo add_query_arg(['redirect' => get_the_permalink()], get_field('field_601bc00528968', 'option')); ?>" class="block w-full py-3 border border-primary-100 text-white font-medium text-center">registrieren</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

</div>
