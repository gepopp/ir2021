<?php
get_header();
the_post();

$event_id = get_field('field_6069e92463992');

?>

    <div class="container mx-auto my-20">
        <?php get_template_part('page-templates/video', 'head') ?>
        <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe src="https://vimeo.com/event/<?php echo $event_id ?>/embed" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
        </div>
    </div>

    <div class="container mx-auto my-10">
        <div class="grid grid-cols-2 gap-10">
            <div>
                <h1 class="text-white text-xl lg:text-3xl font-serif"><?php the_title() ?></h1>
                <div class="text-white">
                    <?php the_content(); ?>
                </div>
            </div>
            <div>

                <?php

                $user = wp_get_current_user();
                $image = get_field('field_5ded37c474589', 'user_' . $user->ID);

                ?>
                <div x-data="addComment(<?php echo $user->ID ?>, <?php the_ID(); ?>)" x-init="init()">
                    <div class="flex space-x-3 items-end pb-5 mb-5">
                        <?php if ($image): ?>
                            <img src="<?php echo $image['sizes']['author_small'] ?>" class="rounded-full w-16 h-16 p-1 border border-white">
                        <?php else: ?>
                            <div class="w-12 h-12 bg-white p-1 border border-white rounded-full flex-none">
                                <div class="flex w-full h-full justify-center items-center">
                                <span class="text-3xl font-medium"><?php $meta = wp_get_current_user();
                                    echo $meta->data->display_name[0] ?? '' ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="flex-grow relative">
                        <textarea
                                x-model="comment"
                                type="text"
                                class="bg-gray-100 w-full  text-gray-800 border-b border-white block w-full py-2 px-2 leading-tight appearance-none focus:outline-none placeholder-gray-500 h-12"
                                placeholder="Schreiben Sie einen neuen Kommentar ..." @keydown.enter="validate()"></textarea>
                                <p class="text-xs text-aktuelles-100 absolute" x-text="commentError" x-show="commentError"></p>
                        </div>

                        <div class="" @click="validate()">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <hr>
                    <template x-for="c in comments" x-key="comment.id">

                        <div class="flex space-x-2 py-3">
                            <div>
                                <img :src="c.author_avatar_urls[48]" class="rounded-full p-1 border border-white w-10 h-10">
                            </div>
                            <div class="w-full">
                                <p x-text="formatDate(c.date)" class="text-xs m-0 text-white -mb-1"></p>
                                <div class="text-white text-lg" x-html="c.content.rendered"></div>
                                <p class="text-white uppercase font-medium text-xs cursor-pointer" @click="addAnswer = c.id" x-show="c.id != addAnswer">
                                  <span x-text="c.child_count + ' - '" x-show="c.child_count > 0"></span>Antworten
                                </p>


                                <textarea
                                        x-model="answer"
                                        x-show="addAnswer == c.id"
                                        type="text"
                                        class="bg-gray-100 w-full  text-gray-800 border-b border-white block w-full py-2 px-2 leading-tight appearance-none focus:outline-none placeholder-gray-500 h-12"
                                        placeholder="Antworten Sie hier ..." @keydown.enter="validate(c.id)"></textarea>

                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>
<?php
get_footer();

