<?php

$when = 'past';
extract( $args );

$events = wp_remote_get( 'https://immolive.immobilien-redaktion.com/api/event/pastthree' );
$events = json_decode( wp_remote_retrieve_body( $events ) );

?>
    <div class="container mx-auto mt-20">
        <div class="text-center mb-10">
            <h1 class="inline text-cent font-serif text-3xl font-semibold"
                style="background: linear-gradient(0deg, #5C97D0 0%, #5C97D0 50%, transparent 50%, transparent 100%);">ImmoLive</h1>
        </div>
    </div>
    <div class="container mx-auto mt-20">
        <section class="mb-5 pb-5 border-b border-primary-100">
            <div class="container flex flex-col px-6 mx-auto space-y-6 xl:flex-row xl:items-center">
                <div class="w-full xl:w-1/2">
                    <div class="xl:max-w-lg">
                        <h1 class="text-3xl font-bold tracking-wide text-gray-800 lg:text-5xl mt-5">
                            <a href="<?php echo $events->upcoming->link ?>">
								<?php echo $events->upcoming->title ?>
                            </a>
                        </h1>
                        <p class="border-t border-b border-primary-100 my-3 py-3 text-lg font-semibold text-center animate-pulse">
                            Live am <?php echo \Carbon\Carbon::parse( $events->upcoming->start )->format( 'd.m.Y \u\m H:i' ) ?> Uhr
                        </p>
                        <div class="mt-8 space-y-5">
                            <p class="flex items-center text-gray-700 line-clamp-5">
								<?php echo strip_tags( $events->upcoming->description ) ?>
                            </p>
                            <a href="<?php echo $events->upcoming->link ?>" class="w-full bg-primary-100 shadow-2xl text-white text-center py-3 hover:shadow-2xl hover:font-semibold block">Details</a>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center w-full xl:w-1/2 order-first xl:order-last">
                    <div class="relative w-full">
                        <div class="relative w-full pt-16by9">
                            <div class="absolute top-0 left-0 w-full h-full">
                                <iframe src="<?php echo $events->upcoming->embed_url ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="width: 100%; height: 100%"></iframe>
                            </div>

                        </div>
                        <a href="<?php echo $events->upcoming->link ?>" class="absolute top-0 left-0 h-full w-full"></a>
                    </div>
                </div>
            </div>
        </section>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 my-5">
			<?php foreach ( $events->past as $event ): ?>
                <div class="bg-white shadow-lg">
                    <a href="<?php echo $event->link ?>">
                        <img src="<?php echo $event->image ?>" class="w-full h-auto aspect-video"/>
                    </a>
                    <div class="p-3">
                        <h2 class="text-xl font-bold tracking-wide text-gray-800 lg:text-2xl mt-5 line-clamp-2 h-16"><?php echo $event->title ?></h2>
                        <p class="border-t border-b border-primary-100 my-3 py-3 text-lg font-semibold text-center">
                            Live am <?php \Carbon\Carbon::setLocale( 'de' );
							echo \Carbon\Carbon::parse( $event->start )->format( 'd.m.Y' ); ?>
                        </p>
                        <p class="line-clamp-3 mb-4"><?php echo strip_tags( $event->description ) ?></p>
                        <a href="<?php echo $event->link ?>" class="w-full bg-primary-100 shadow-2xl text-white text-center py-3 hover:shadow-2xl hover:font-semibold block">Details</a>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
<?php
