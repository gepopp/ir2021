<?php
\Carbon\Carbon::setLocale('de');
?>


<div class="container mx-auto mt-20 relative px-5 lg:px-0">
    <h1 class="text-2xl font-serif font-semibold">Ihre Inhalte</h1>
    <div class="grid grid-cols-5 gap-10"
         x-data="{ active: 'reminder' }">
        <div class="col-span-5 lg:col-span-1">
            <nav>
                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='reminder'" :class="{'bg-primary-100 text-white': active == 'reminder'}"
                     style="transition: background-color 0.5s ease;">Erinnerungen
                </div>

                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='bookmarks'" :class="{'bg-primary-100 text-white': active == 'bookmarks'}"
                     style="transition: background-color 0.5s ease;">Lesezeichen
                </div>

                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='fastfertig'" :class="{'bg-primary-100 text-white': active == 'fastfertig'}"
                     style="transition: background-color 0.5s ease;">Weiterlesen
                </div>

                <div class="cursor-pointer p-2 border-b border-primary-100"
                     @click="active='gelesen'" :class="{'bg-primary-100 text-white': active == 'gelesen'}"
                     style="transition: background-color 0.5s ease;">Fertig gelesen
                </div>
            </nav>
        </div>
        <div class="col-span-5 lg:col-span-4 p-10 bg-white shadow-lg" style="min-height: 500px">
           <?php get_template_part('page-templates/log', 'reminder') ?>
           <?php get_template_part('page-templates/log', 'bookmarks') ?>
           <?php get_template_part('page-templates/log', 'read') ?>
           <?php get_template_part('page-templates/log', 'readon') ?>
        </div>
    </div>
</div>