<?php
\Carbon\Carbon::setLocale('de');

$user = wp_get_current_user();

global $wpdb;

$done = $wpdb->get_results(sprintf('SELECT * FROM wp_reading_log WHERE user_id = %d AND scroll_depth = 100 ORDER BY created_at DESC LIMIT 10', $user->ID));
$done_count = $wpdb->get_var(sprintf('SELECT count(*) FROM wp_reading_log WHERE user_id = %d AND scroll_depth = 100 ORDER BY created_at DESC LIMIT 10', $user->ID));


$allmost = $wpdb->get_results(sprintf('SELECT * FROM wp_reading_log WHERE user_id = %d AND scroll_depth < 100 ORDER BY created_at DESC LIMIT 10', $user->ID));
$done_allmost = $wpdb->get_var(sprintf('SELECT count(*) FROM wp_reading_log WHERE user_id = %d AND scroll_depth < 100 ORDER BY created_at DESC LIMIT 10', $user->ID));

$read = [];
foreach ($done as $d) {

    $cat = get_the_category($d->post_id);
    $cat = array_shift($cat);

    $author = 'Von ' . get_the_author_meta('display_name', get_post_field('post_author', $d->post_id)) . ' am ' . get_the_time('d.m.Y', $d->post_id);

    $read[] = [
        'id'        => $d->id,
        'title'     => html_entity_decode(get_the_title($d->post_id)),
        'permalink' => get_the_permalink($d->post_id),
        'cat'       => $cat->name,
        'author'    => $author,
        'time'      => ucfirst(\Carbon\Carbon::parse($d->created_at)->diffForHumans() . ' zu ' . $d->scroll_depth) . '%',
    ];
}
$not_read = [];
foreach ($allmost as $d) {

    $cat = get_the_category($d->post_id);
    $cat = array_shift($cat);

    $author = 'Von ' . get_the_author_meta('display_name', get_post_field('post_author', $d->post_id)) . ' am ' . get_the_time('d.m.Y', $d->post_id);


    $not_read[] = [
        'id'        => $d->id,
        'title'     => html_entity_decode(get_the_title($d->post_id)),
        'permalink' => get_the_permalink($d->post_id),
        'cat'       => $cat->name,
        'author'    => $author,
        'time'      => ucfirst(\Carbon\Carbon::parse($d->created_at)->diffForHumans() . ' zu ' . $d->scroll_depth) . '%',
    ];
}
?>
<script>
    var read = <?php echo str_replace("'", '"', json_encode($read)) ?>;
    var not_read = <?php echo str_replace("'", '"', json_encode($not_read)) ?>;
</script>


<div class="container mx-auto mt-20 relative">
    <h1 class="text-2xl font-serif font-semibold">Ihre Inhlate</h1>
    <div class="grid grid-cols-5 gap-10"
         x-data="{ active: 'fastfertig' }">
        <div>
            <nav>
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
        <div class="col-span-4 p-10 bg-white shadow-lg" style="min-height: 500px">
            <table x-show.transition.in.opacity.duration.750ms="active == 'gelesen'" class="w-full table-auto">

                <tbody x-data="logs('read', read, <?php echo $done_count ?>, <?php echo $user->ID ?>)">
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


            <table x-show.transition.in.opacity.duration.750ms="active == 'fastfertig'" class="w-full table-auto">
                <tbody x-data="logs('not_read', not_read, <?php echo $done_allmost ?>, <?php echo $user->ID ?>)">
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
        </div>
    </div>
</div>