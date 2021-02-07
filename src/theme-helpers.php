<?php
function speakerVertical($speaker)
{
    ?>
    <div class="flex flex-col mt-10">
        <div class="relative h-auto">
            <img src="<?php echo $speaker['bild']['sizes']['article-portrait'] ?>" class="w-full h-auto border-8 border-white" alt="<?php echo $speaker['name'] ?>"/>
            <?php if ($speaker['unternehmenswebseite'] != '' && $speaker['logo']['sizes']['xs'] != ''): ?>
                <div class="absolute top-0 right-0 w-24 h-24 -mt-6 lg:-mr-6 bg-white rounded-full p-3">
                    <a href="<?php echo $speaker['unternehmenswebseite'] ?>" target="_blank">
                        <img src="<?php echo $speaker['logo']['sizes']['xs'] ?>" class="w-full h-auto p-2" alt="<?php echo $speaker['name'] ?>"/>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="mt-12 lg:mt-2">
            <div class="bg-white px-3 inline-block">
                <h1 class="text-xl lg:text-2xl text-primary-100 font-bold leading-none inline uppercase"><?php echo $speaker['name'] ?></h1>
            </div>
            <p class="text-base leading-tight text-white py-5"><?php echo $speaker['kurzbeschreibung'] ?></p>
        </div>
    </div>
    <?php
}


function speakerHorizontal($speaker)
{
    ?>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mt-10">
        <div class="relative h-auto">
            <img src="<?php echo $speaker['bild']['sizes']['article'] ?>" class="w-full h-auto border-8 border-white" alt="<?php echo $speaker['name'] ?>"/>
            <?php if ($speaker['unternehmenswebseite'] != '' && $speaker['logo']['sizes']['xs'] != ''): ?>
                <div class="absolute bottom-0 right-0 w-24 h-24 -mb-12 lg:-mr-12 bg-white rounded-full p-3">
                    <a href="<?php echo $speaker['unternehmenswebseite'] ?>" target="_blank">
                        <img src="<?php echo $speaker['logo']['sizes']['xs'] ?>" class="w-full h-auto p-2" alt="<?php echo $speaker['name'] ?>"/>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="mt-12 lg:mt-2">
            <div class="bg-white px-3">
                <h1 class="text-xl lg:text-3xl text-primary-100 font-bold leading-none inline uppercase"><?php echo $speaker['name'] ?></h1>
            </div>
            <p class="text-base leading-tight text-white py-5"><?php echo $speaker['kurzbeschreibung'] ?></p>
        </div>
    </div>
    <?php
}