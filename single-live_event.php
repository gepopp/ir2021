<?php
get_header();
the_post();

$event_id = get_field('field_6069e92463992');

?>

    <div class="container mx-auto my-20">
        <?php get_template_part('video', 'head') ?>
        <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe src="https://vimeo.com/event/<?php echo $event_id ?>/embed" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
        </div>
    </div>

    <div class="container mx-auto my-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
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
                        <?php echo  get_avatar($user, 48, null, null, ['class' => 'rounded-full w-12 h-12 p-1 border border-white' ]) ?>
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
                            <div class="flex-1">
                                <p x-text="formatDate(c.date)" class="text-xs m-0 text-white -mb-1"></p>
                                <div class="text-white text-lg" x-html="c.content.rendered"></div>
                                <p class="text-white uppercase font-medium text-xs cursor-pointer" @click="openAnswer(c)" x-show="c.id != addAnswer">
                                    <span x-text="c.child_count + ' - '" x-show="c.child_count > 0"></span>Antworten
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
                                                    <img :src="child.author_avatar_urls[48]" class="rounded-full p-1 border border-white w-10 h-10 flex-none">
                                                </div>
                                                <div class="flex-1">
                                                    <p x-text="formatDate(child.date)" class="text-xs m-0 text-white -mb-1"></p>
                                                    <div class="text-white text-lg" x-html="child.content.rendered"></div>
                                                </div>
                                            </div>
                                    </template>
                                    <div class="flex items-end space-x-4">
                                        <textarea
                                                x-model="answer"
                                                type="text"
                                                class="bg-gray-100 w-full  text-gray-800 border-b border-white block w-full py-2 px-2 leading-tight appearance-none focus:outline-none placeholder-gray-500 h-12"
                                                placeholder="Antworten Sie hier ..." @keydown.enter="validate(c.id)"></textarea>
                                        <div class="" @click="validate(c.id)">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>
<?php
get_footer();

