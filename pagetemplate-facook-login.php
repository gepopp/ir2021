<?php
/**
 * Template Name: Facebook login
 */

session_start();


$fb = new Facebook\Facebook( [
	'app_id'                => '831950683917414',
	'app_secret'            => 'd6d52d59ce1f1efdbf997b980dffe229',
	'default_graph_version' => 'v2.10',
] );

$helper = $fb->getRedirectLoginHelper();

if ( isset( $_GET['state'] ) ) {
	$helper->getPersistentDataHandler()->set( 'state', $_GET['state'] );
}

try {
	$accessToken = $helper->getAccessToken();
} catch ( Facebook\Exception\ResponseException $e ) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch ( Facebook\Exception\SDKException $e ) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

if ( ! isset( $accessToken ) ) {
	if ( $helper->getError() ) {
		header( 'HTTP/1.0 401 Unauthorized' );
		echo "Error: " . $helper->getError() . "\n";
		echo "Error Code: " . $helper->getErrorCode() . "\n";
		echo "Error Reason: " . $helper->getErrorReason() . "\n";
		echo "Error Description: " . $helper->getErrorDescription() . "\n";
	} else {
		header( 'HTTP/1.0 400 Bad Request' );
		echo 'Bad request';
	}
	exit;
}

$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken( $accessToken );

$tokenMetadata->validateAppId( '831950683917414' );
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if ( ! $accessToken->isLongLived() ) {
	// Exchanges a short-lived access token for a long-lived one
	try {
		$accessToken = $oAuth2Client->getLongLivedAccessToken( $accessToken );
	} catch ( Facebook\Exception\SDKException $e ) {
		echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
		exit;
	}
}

try {
	// Returns a `Facebook\Response` object
	$response = $fb->get( '/me?fields=id,name,email', $accessToken->getValue() );
} catch ( Facebook\Exception\ResponseException $e ) {
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch ( Facebook\Exception\SDKException $e ) {
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

try {
	// message must come from the user-end
	$data = ['message' => 'testing...'];
	$request = $fb->post('/me/feed', $data);
	$response = $request->getGraphEdge()->asArray;
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

echo $response['id'];

$fbuser = $response->getGraphUser();
$user = get_user_by( 'email', $fbuser['email'] );
if ( ! $user ) {

	$wp_user = wp_create_user( $fbuser['name'] . ' ' . uniqid(), uniqid(), $fbuser['email'] );

	wp_update_user( [
		'ID'           => $wp_user,
		'display_name' => $fbuser['name'],
	] );

	( new CampaignMonitor() )->transactional( 'registration_activated', $wp_user );

	$user = get_user_by( 'ID', $wp_user );

}

wp_clear_auth_cookie();
wp_set_current_user( $user->ID );
wp_set_auth_cookie( $user->ID );


if ( ! empty( $_GET['state'] ) ) {

	$decoded = base64_decode( $_GET['state'] );

	if ( str_contains($decoded, 'http'))
	{
		wp_redirect( urldecode_deep( $decoded ) );
		exit();
	}
}
wp_safe_redirect( get_field( 'field_601bc4580a4fc', 'option' ) );
exit();

