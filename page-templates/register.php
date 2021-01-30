<?php

use Overtrue\Socialite\SocialiteManager;

global $FormSession;
?>
<script>
    var register_data = <?php echo json_encode($FormSession->getFormData()) ?>;
</script>
<h1 class="text-2xl font-serif font-semibold mb-5">Registrieren</h1>
<div class="w-full">
    <?php get_template_part('page-templates/register', 'form') ?>
</div>
