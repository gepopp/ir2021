<?php
\Carbon\Carbon::setLocale('de');

$user = wp_get_current_user();

global $wpdb;


$reminder_count = $wpdb->get_var(sprintf('SELECT count(*) FROM wp_user_read_later WHERE user_id = %d ORDER BY created_at', $user->ID));


$done = $wpdb->get_results(sprintf('SELECT * FROM wp_reading_log WHERE user_id = %d AND scroll_depth = 100 ORDER BY created_at DESC LIMIT 10', $user->ID));
$done_count = $wpdb->get_var(sprintf('SELECT count(*) FROM wp_reading_log WHERE user_id = %d AND scroll_depth = 100 ORDER BY created_at DESC', $user->ID));

$read = [];
foreach ($done as $d) {

    $cat = get_the_category($d->post_id);
    $cat = array_shift($cat);

    $author = 'Von ' . get_the_author_meta('display_name', get_post_field('post_author', $d->post_id)) . ' am ' . get_the_time('d.m.Y', $d->post_id);

    $read[] = [
        'id'        => $d->id,
        'title'     => html_entity_decode(get_the_title($d->post_id)),
        'permalink' => get_the_permalink($d->post_id),
        'cat'       => $cat->name ?? '',
        'author'    => $author,
        'time'      => ucfirst(\Carbon\Carbon::parse($d->created_at)->diffForHumans() . ' zu ' . $d->scroll_depth) . '%',
    ];
}


$allmost = $wpdb->get_results(sprintf('SELECT * FROM wp_reading_log WHERE user_id = %d AND scroll_depth < 100 ORDER BY created_at DESC LIMIT 10', $user->ID));
$done_allmost = $wpdb->get_var(sprintf('SELECT count(*) FROM wp_reading_log WHERE user_id = %d AND scroll_depth < 100 ORDER BY created_at DESC', $user->ID));

$not_read = [];
foreach ($allmost as $d) {

    $cat = get_the_category($d->post_id);
    $cat = array_shift($cat);

    $author = 'Von ' . get_the_author_meta('display_name', get_post_field('post_author', $d->post_id)) . ' am ' . get_the_time('d.m.Y', $d->post_id);


    $not_read[] = [
        'id'        => $d->id,
        'title'     => html_entity_decode(get_the_title($d->post_id)),
        'permalink' => get_the_permalink($d->post_id),
        'cat'       => $cat->name ?? '',
        'author'    => $author,
        'time'      => ucfirst(\Carbon\Carbon::parse($d->created_at)->diffForHumans() . ' zu ' . $d->scroll_depth) . '%',
    ];
}


$bookmarks = $wpdb->get_results(sprintf('SELECT * FROM wp_user_bookmarks WHERE user_id = %d ORDER BY created_at DESC LIMIT 10', $user->ID));
$bookmarks_count = $wpdb->get_var(sprintf('SELECT count(*) FROM wp_user_bookmarks WHERE user_id = %d ORDER BY created_at', $user->ID));

$bookmarks_table = [];
foreach ($bookmarks as $d) {

    $cat = get_the_category($d->post_id);
    $cat = array_shift($cat);

    $author = 'Von ' . get_the_author_meta('display_name', get_post_field('post_author', $d->post_id)) . ' am ' . get_the_time('d.m.Y', $d->post_id);


    $bookmarks_table[] = [
        'id'        => $d->id,
        'title'     => html_entity_decode(get_the_title($d->post_id)),
        'permalink' => get_the_permalink($d->post_id),
        'cat'       => $cat->name ?? '',
        'author'    => $author,
        'time'      => \Carbon\Carbon::parse($d->created_at)->diffForHumans(),
    ];
}


?>
<script>
    var read = <?php echo str_replace("'", '"', json_encode($read)) ?>;
    var not_read = <?php echo str_replace("'", '"', json_encode($not_read)) ?>;
    var bookmarks = <?php echo str_replace("'", '"', json_encode($bookmarks_table)) ?>;
</script>


<div class="container mx-auto mt-20 relative px-5 lg:px-0">
    <h1 class="text-2xl font-serif font-semibold">Ihre Inhlate</h1>
    <div class="grid grid-cols-5 gap-10"
         x-data="{ active: 'bookmarks' }">
        <div class="col-span-5 lg:col-span-1">
            <nav>
                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='bookmarks'" :class="{'bg-primary-100 text-white': active == 'bookmarks'}"
                     style="transition: background-color 0.5s ease;">Lesezeichen (<?php echo $bookmarks_count ?>)
                </div>
                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='reminder'" :class="{'bg-primary-100 text-white': active == 'reminder'}"
                     style="transition: background-color 0.5s ease;">Erinnerungen (<?php echo $reminder_count ?>)
                </div>
                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='fastfertig'" :class="{'bg-primary-100 text-white': active == 'fastfertig'}"
                     style="transition: background-color 0.5s ease;">Weiterlesen (<?php echo $done_allmost ?>)
                </div>
                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='gelesen'" :class="{'bg-primary-100 text-white': active == 'gelesen'}"
                     style="transition: background-color 0.5s ease;">Fertig gelesen (<?php echo $done_count ?>)
                </div>
            </nav>
        </div>
        <div class="col-span-5 lg:col-span-4 p-10 bg-white shadow-lg" style="min-height: 500px">

            <?php
            $reminder = $wpdb->get_results(sprintf('SELECT * FROM wp_user_read_later WHERE user_id = %d ORDER BY created_at DESC LIMIT 10', $user->ID));

            $reminder_table = [];
            foreach ($reminder as $d) {

                $cat = get_the_category($d->post_id);
                $cat = array_shift($cat);

                $author = 'von ' . get_the_author_meta('display_name', get_post_field('post_author', $d->post_id)) . ' am ' . get_the_time('d.m.Y', $d->post_id);

                $reminder_table[] = [
                    'id'        => $d->id,
                    'title'     => html_entity_decode(get_the_title($d->post_id)),
                    'permalink' => get_the_permalink($d->post_id),
                    'cat'       => $cat->name ?? '',
                    'author'    => $author,
                    'time'      => ucfirst(\Carbon\Carbon::parse($d->remind_at)->diffForHumans()),
                    'date'      => $d->remind_at,
                ];
            }
            ?>
            <script>
                var reminder = <?php echo str_replace("'", '"', json_encode($reminder_table)) ?>;
            </script>


            <table x-show.transition.in.opacity.duration.750ms="active == 'reminder'" class="w-full table-auto">

                <tbody x-data="logs('reminder', reminder, <?php echo $reminder_count ?>, <?php echo $user->ID ?>)">
                <tr x-show="logs.length === 0" class="h-64">
                    <td colspan="6" style="height: 500px">
                        <div class="flex h-full w-full items-center justify-center">
                            <p>Noch keine Inhlate vorhanden.<br><a href="<?php echo home_url() ?>" class="cursor-pointer underline text-primary-100">Zur Startseite</a>
                            </p>
                        </div>
                    </td>
                </tr>
                <template x-for="log in logs" x-key="log.id">
                    <tr class="mb-3 border-b border-primary-100">
                        <td class="p-3">
                            <a :href="log.permalink" class="hover:underline font-semibold lg:text-lg leading-none" x-text="log.title"></a>
                            <div class="w-full flex justify-between">
                                <div class="text-gray-500 text-sm hidden md:block">
                                    Erschienen in <span x-text="log.cat"></span> <span x-text="log.author"></span>
                                </div>
                                <script>
                                    var id      = log.id;
                                    var time    = log.time;
                                    var date    = log.date;
                                </script>
                                <div class="text-gray-500 text-sm hidden md:block" :id="'picker-' + id" x-data="reminderDate(id, time, date)"></div>

                            </div>
                        </td>
                    </tr>
                </template>
                <tr>
                    <td>
                        <div x-show="logs.length < all" class="flex justify-center mt-5">
                            <div class="px-2 py-2 bg-primary-100 text-white cursor-pointer" @click="loadNext()">weitere laden</div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>


            <table x-show.transition.in.opacity.duration.750ms="active == 'gelesen'" class="w-full table-auto">

                <tbody x-data="logs('read', read, <?php echo $done_count ?>, <?php echo $user->ID ?>)">
                <tr x-show="logs.length === 0" class="h-64">
                    <td colspan="6" style="height: 500px">
                        <div class="flex h-full w-full items-center justify-center">
                            <p>Noch keine Inhlate vorhanden.<br><a href="<?php echo home_url() ?>" class="cursor-pointer underline text-primary-100">Zur Startseite</a>
                            </p>
                        </div>
                    </td>
                </tr>
                <template x-for="log in logs" x-key="log.id">
                    <tr class="mb-3 border-b border-primary-100">
                        <td class="p-3">
                            <a :href="log.permalink" class="hover:underline font-semibold lg:text-lg leading-none" x-text="log.title"></a>
                            <div class="w-full flex justify-between">
                                <div class="text-gray-500 text-sm hidden md:block" x-text="log.cat"></div>
                                <div class="text-gray-500 text-sm" x-text="log.author"></div>
                                <div class="text-gray-500 text-sm hidden md:block" x-text="log.time"></div>
                            </div>
                        </td>
                    </tr>
                </template>
                <tr>
                    <td>
                        <div x-show="logs.length < all" class="flex justify-center mt-5">
                            <div class="px-2 py-2 bg-primary-100 text-white cursor-pointer" @click="loadNext()">weitere laden</div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>


            <table x-show.transition.in.opacity.duration.750ms="active == 'fastfertig'" class="w-full table-auto">
                <tbody x-data="logs('not_read', not_read, <?php echo $done_allmost ?>, <?php echo $user->ID ?>)">
                <tr x-show="logs.length === 0" class="h-64">
                    <td colspan="6" style="height: 500px">
                        <div class="flex h-full w-full items-center justify-center">
                            <p>Noch keine Inhlate vorhanden.<br><a href="<?php echo home_url() ?>" class="cursor-pointer underline text-primary-100">Zur Startseite</a>
                            </p>
                        </div>
                    </td>
                </tr>
                <template x-for="log in logs" x-key="log.id">
                    <tr class="mb-3 border-b border-primary-100">
                        <td class="p-3">
                            <a :href="log.permalink" class="hover:underline font-semibold text-lg" x-text="log.title"></a>
                            <div class="w-full flex justify-between">
                                <div class="text-gray-500 text-sm" x-text="log.cat"></div>
                                <div class="text-gray-500 text-sm" x-text="log.author"></div>
                                <div class="text-gray-500 text-sm" x-text="log.time"></div>
                            </div>
                        </td>
                    </tr>
                </template>
                <tr>
                    <td>
                        <div x-show="logs.length < all" class="flex justify-center mt-5">
                            <div class="px-2 py-2 bg-primary-100 text-white cursor-pointer" @click="loadNext()">weitere laden</div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>


            <table x-show.transition.in.opacity.duration.750ms="active == 'bookmarks'" class="w-full table-auto">
                <tbody x-data="logs('bookmarks', bookmarks, <?php echo $bookmarks_count ?>, <?php echo $user->ID ?>)">
                <tr x-show="logs.length === 0" class="h-64">
                    <td colspan="6" style="height: 500px">
                        <div class="flex h-full w-full items-center justify-center">
                            <p>Noch keine Inhlate vorhanden.<br><a href="<?php echo home_url() ?>" class="cursor-pointer underline text-primary-100">Zur Startseite</a>
                            </p>
                        </div>
                    </td>
                </tr>
                <template x-for="log in logs" x-key="log.id">
                    <tr class="mb-3 border-b border-primary-100">
                        <td class="p-3">
                            <a :href="log.permalink" class="hover:underline font-semibold text-lg" x-text="log.title"></a>
                            <div class="w-full flex justify-between">
                                <div class="text-gray-500 text-sm" x-text="log.cat"></div>
                                <div class="text-gray-500 text-sm" x-text="log.author"></div>
                                <div class="text-gray-500 text-sm" x-text="log.time"></div>
                                <div class="text-warning underline cursor-pointer text-sm" @click="removeBookmark(log.id)">löschen</div>
                            </div>
                        </td>
                    </tr>
                </template>
                <tr>
                    <td>
                        <div x-show="logs.length > all" class="flex justify-center mt-5">
                            <div class="px-2 py-2 bg-primary-100 text-white cursor-pointer" @click="loadNext()">weitere laden</div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>


        </div>
    </div>
</div>