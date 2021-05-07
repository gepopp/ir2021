<?php
use Overtrue\Socialite\SocialiteManager;

$config = [
	'linkedin' => [
		'client_id'     => '78q1kul4q95hsh',
		'client_secret' => 'mO7jlH6rG9bahUrX',
		'redirect'      => home_url( 'l-oauth' ),
	],
];
// 194317471061-jdtvke2dpcensj3p9ckfq20cbsre23dl.apps.googleusercontent.com
// O_JXIOXqatwxOMYq45ggJ1tj

$socialite = new SocialiteManager( $config );
?>

<a href="<?php echo $socialite->create( 'linkedin' )->withState( urlencode( $_GET['redirect'] ?? '' ) )->redirect(); ?>"
   class="flex justify-center items-center bg-primary-100 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-full text-center block"
>
	<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
	     viewBox="0 0 500 500" fill="currentColor" class="w-4 h-4 text-white mr-3" xml:space="preserve">
                                    <path class="st0" d="M123.3,481.6H27.7V172.8h95.6V481.6L123.3,481.6z M75,132.4L75,132.4c-31.2,0-56.5-25.5-56.5-57
	c0-31.5,25.3-57,56.5-57s56.5,25.5,56.5,57C131.6,106.8,106.2,132.4,75,132.4L75,132.4z M481.5,481.6L481.5,481.6h-95.1
	c0,0,0-117.6,0-162.1c0-44.4-16.9-69.3-52-69.3c-38.3,0-58.2,25.8-58.2,69.3c0,47.6,0,162.1,0,162.1h-91.7V172.8h91.7v41.6
	c0,0,27.6-51,93.1-51c65.5,0,112.4,40,112.4,122.7C481.5,368.8,481.5,481.6,481.5,481.6z"/>
</svg>
	<span><?php _e( 'Via LinkedIn einloggen', 'ir21' ) ?></span>
</a>