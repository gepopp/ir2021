<?php

$user = wp_get_current_user();

global $wpdb;
$done    = $wpdb->get_results(sprintf('SELECT * FROM wp_reading_log WHERE user_id = %d AND scroll_depth = 100', $user->ID));
$allmost = $wpdb->get_results(sprintf('SELECT * FROM wp_reading_log WHERE user_id = %d AND scroll_depth < 100', $user->ID));

\Carbon\Carbon::setLocale('de');

?>
<div class="container mx-auto mt-20 relative">
    <h1 class="text-2xl font-serif font-semibold">Ihre Inhlate</h1>
    <div class="grid grid-cols-5 gap-10"
    x-data="{ active: 'gelesen'}">
        <div>
            <nav>
                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='fastfertig'" :class="{'bg-primary-100 text-white': active == 'fastfertig'}"
                     style="transition: background-color 0.5s ease;">Fast fertig gelesen</div>
                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='gelesen'" :class="{'bg-primary-100 text-white': active == 'gelesen'}"
                style="transition: background-color 0.5s ease;">Bereits gelesen</div>
            </nav>
        </div>
        <div class="col-span-4 p-10 bg-white shadow-lg" style="min-height: 500px">
            <table x-show.transition.in.opacity.duration.750ms="active == 'gelesen'" class="w-full table-auto">
                <thead>
                <tr>

                    <th class="text-left">Artikel</th>
                    <th class="text-left">gelesen am</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($done as $log): ?>
                    <tr class="mb-3 border-b border-primary-100">
                        <td class="p-3">
                            <a href="<?php echo get_the_permalink($log->post_id) ?>" class="hover:underline">
                                <?php echo get_the_title($log->post_id) ?>
                            </a>

                        </td>
                        <td class="whitespace-no-wrap p-3"><?php echo ucfirst( \Carbon\Carbon::parse($log->created_at)->diffForHumans() ) ?> zu <?php echo $log->scroll_depth ?> %</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


            <table x-show.transition.in.opacity.duration.750ms="active == 'fastfertig'" class="w-full table-auto">
                <thead>
                <tr>
                    <th class="text-left">Artikel</th>
                    <th class="text-left">gelesen am</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allmost as $log): ?>
                    <tr class="mb-3 border-b border-primary-100">
                        <td class="p-3">
                            <a href="<?php echo get_the_permalink($log->post_id) ?>" class="hover:underline">
                                <?php echo get_the_title($log->post_id) ?>
                            </a>

                        </td>
                        <td class="whitespace-no-wrap p-3"><?php echo ucfirst( \Carbon\Carbon::parse($log->created_at)->diffForHumans() ) ?> zu <?php echo $log->scroll_depth ?> %</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>