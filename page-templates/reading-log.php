<?php

$user = wp_get_current_user();

global $wpdb;

$done    = $wpdb->get_results(sprintf('SELECT * FROM wp_reading_log WHERE user_id = %d AND scroll_depth = 100 ORDER BY created_at DESC LIMIT 10', $user->ID));
$done_count = $wpdb->get_var(sprintf('SELECT count(*) FROM wp_reading_log WHERE user_id = %d AND scroll_depth = 100 ORDER BY created_at DESC LIMIT 10', $user->ID));


$allmost = $wpdb->get_results(sprintf('SELECT * FROM wp_reading_log WHERE user_id = %d AND scroll_depth < 100 ORDER BY created_at DESC LIMIT 10', $user->ID));
$done_allmost = $wpdb->get_var(sprintf('SELECT count(*) FROM wp_reading_log WHERE user_id = %d AND scroll_depth < 100 ORDER BY created_at DESC LIMIT 10', $user->ID));


\Carbon\Carbon::setLocale('de');

?>
<div class="container mx-auto mt-20 relative">
    <h1 class="text-2xl font-serif font-semibold">Ihre Inhlate</h1>
    <div class="grid grid-cols-5 gap-10"
    x-data="{ active: 'fastfertig'}">
        <div>
            <nav>
                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='fastfertig'" :class="{'bg-primary-100 text-white': active == 'fastfertig'}"
                     style="transition: background-color 0.5s ease;">Weiterlesen (<?php echo $done_allmost ?>)</div>
                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='gelesen'" :class="{'bg-primary-100 text-white': active == 'gelesen'}"
                style="transition: background-color 0.5s ease;">Fertig gelesen (<?php echo $done_count ?>)</div>
            </nav>
        </div>
        <div class="col-span-4 p-10 bg-white shadow-lg" style="min-height: 500px">
            <table x-show.transition.in.opacity.duration.750ms="active == 'gelesen'" class="w-full table-auto">
                <thead>
                <tr>
                    <th class="text-left">Ihre gelesenen Artikel</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($done as $log): ?>
                    <tr class="mb-3 border-b border-primary-100">
                        <td class="p-3">
                            <a href="<?php echo get_the_permalink($log->post_id) ?>" class="hover:underline font-semibold text-lg">
                                <?php echo get_the_title($log->post_id) ?>
                            </a>
                            <div class="w-full flex justify-between">
                                <div class="text-gray-500 text-sm">
                                    <?php
                                    $cat = get_the_category($log->post_id);
                                    $cat = array_shift($cat);
                                    echo  $cat->name ?>
                                </div>

                                <div class="text-gray-500 text-sm">
                                    <?php echo 'Von ' . get_the_author_meta('display_name', get_post_field( 'post_author', $log->post_id )) ?> am <?php echo get_the_time('d.m.Y', $log->post_id) ?>
                                </div>
                                <div class="text-gray-500 text-sm">
                                    <?php echo ucfirst( \Carbon\Carbon::parse($log->created_at)->diffForHumans() ) ?> zu <?php echo $log->scroll_depth ?> %
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


            <table x-show.transition.in.opacity.duration.750ms="active == 'fastfertig'" class="w-full table-auto">
                <tbody>
                <?php foreach ($allmost as $log): ?>
                    <tr class="mb-3 border-b border-primary-100">
                        <td class="p-3">
                            <a href="<?php echo get_the_permalink($log->post_id) ?>" class="hover:underline font-semibold text-lg">
                                <?php echo get_the_title($log->post_id) ?>
                            </a>
                            <div class="w-full flex justify-between">
                                <div class="text-gray-500 text-sm">
                                    <?php echo get_the_category($log->post_id) ?>
                                </div>


                                <div class="text-gray-500 text-sm">
                                    <?php echo get_the_author_meta('display_name', get_post_field( 'post_author', $log->post_id )) ?> am <?php echo get_the_time('d.m.Y', $log->post_id) ?>
                                </div>
                                <div class="text-gray-500 text-sm">
                                    <?php echo ucfirst( \Carbon\Carbon::parse($log->created_at)->diffForHumans() ) ?> zu <?php echo $log->scroll_depth ?> %
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>