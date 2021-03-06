<?php
use Overtrue\Socialite\SocialiteManager;
$config = [
	'google'   => [
		'client_id'     => '194317471061-jdtvke2dpcensj3p9ckfq20cbsre23dl.apps.googleusercontent.com',
		'client_secret' => 'O_JXIOXqatwxOMYq45ggJ1tj',
		'redirect'      => home_url( 'g-oauth' ),
	],
];
$socialite = new SocialiteManager( $config );

$link = $socialite->create( 'google' )->redirect();
if(isset($_GET['redirect'])){
	$link = $socialite->create( 'google' )->withState($_GET['redirect'])->redirect();
}
?>
<a href="<?php echo $link ?>"
   class="flex justify-center items-center bg-primary-100 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-full text-center block"
>
	<svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
	     fill="currentColor" class="text-white h-4  w-4 mr-3" viewBox="0 0 128 128" xml:space="preserve">
    <path id="icon_5_" d="M30.418,49.137
		c-9.242-7.272-16.109-12.661-21.237-16.601C20.161,13.095,40.993,0,64.895,0c16.572,0,31.696,6.316,43.053,16.659
		C94.563,29.32,94.997,30.044,89.724,35.317c-6.577-5.447-13.733-9.329-24.829-9.329C49.163,25.988,36.009,35.52,30.418,49.137z
		 M27.491,64c0-1.97,0.145-3.882,0.435-5.765C20.48,52.382,12.107,45.892,5.299,40.677C2.459,47.891,0.895,55.772,0.895,64
		c0,9.271,1.97,18.079,5.505,26.017c6.577-5.592,14.399-12.284,21.787-18.6C27.723,69.012,27.491,66.549,27.491,64z M64.895,102.012
		c-15.124,0-27.871-8.837-33.811-21.613c-8.924,7.62-15.529,13.269-20.484,17.47C21.9,115.976,41.978,128,64.895,128
		c15.326,0,27.321-3.882,36.476-10.169c-6.055-5.244-13.791-11.879-21.15-18.108C76.02,101.23,70.979,102.012,64.895,102.012z
		 M126.345,51.339c-12.516,0-61.45,0-61.45,0v25.322c0,0,24.569-0.029,34.593-0.029c-2.665,7.996-5.997,14.255-11.183,18.513
		c8.894,7.533,15.326,13.009,19.962,17.065C124.926,96.072,129.04,70.664,126.345,51.339z"/>
</svg>
	<span><?php _e( 'Via Google einloggen', 'ir21' ) ?></span>
</a>
