<?php
$fb = new Facebook\Facebook( [
	'app_id'                => '831950683917414',
	'app_secret'            => 'd6d52d59ce1f1efdbf997b980dffe229',
	'default_graph_version' => 'v2.10',
] );

$helper = $fb->getRedirectLoginHelper();

$permissions = [ 'email' ]; // Optional permissions
if(isset($_GET['redirect'])){
	$helper->getPersistentDataHandler()->set('state', $_GET['redirect']);
}
$loginUrl    = $helper->getLoginUrl( trailingslashit(home_url( 'fb-login' )), $permissions );
?>

<a href="<?php echo $loginUrl ?>"
   class="flex justify-center items-center bg-primary-100 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-full text-center block"
>
	<svg version="1.1" id="digital_x5F_marketing" xmlns="http://www.w3.org/2000/svg"
	     viewBox="0 0 128 128" fill="currentColor" class="text-white w-4 mr-3" xml:space="preserve">
                    <path id="icon:4" class="st1" d="M74,35.3v12.5h21.6v23.6H74c0,26.4,0,56.6,0,56.6H50.3c0,0,0-27.5,0-56.6H30.4V47.8h19.9V30.6
		c0-36.2,47.3-30.3,47.3-30.3v22C97.6,22.4,74,19.5,74,35.3z"/>
</svg>
	<span><?php _e( 'Via Facebook einloggen', 'ir21' ) ?></span>
</a>
