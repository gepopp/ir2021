<?php


namespace irclasses\Boot;

use irclasses\FormSession;
use irclasses\CampaignMonitor;

class NewsletterAbo {


	public function __construct() {

		add_action( 'admin_post_get_immolive_ics', [ $this, 'add_newsletter_subscriber' ] );
		add_action( 'admin_post_nopriv_get_immolive_ics', [ $this, 'add_newsletter_subscriber' ] );

	}

	public function add_newsletter_subscriber() {

		$session = FormSession::session();


		if ( ! wp_verify_nonce( $_POST['newsletter'], 'newsletter' ) ) {
			$session->addToErrorBag( 'newsletter', 'nonce' );
			wp_safe_redirect( home_url( $_POST['_wp_http_referer'] ) );
		}

		$email = sanitize_email( $_POST['email'] );

		if ( empty( $email ) ) {
			$session->addToErrorBag( 'newsletter', 'email_not_valid' );
			wp_safe_redirect( home_url( $_POST['_wp_http_referer'] ) );
		}

		if ( (int) $_POST['agb'] != 1 ) {
			$session->addToErrorBag( 'newsletter', 'agb' );
			wp_safe_redirect( home_url( $_POST['_wp_http_referer'] ) );
		}

		if ( get_post_type( (int) $_POST['post_id'] ) !== 'immolive' ) {
			$session->addToErrorBag( 'newsletter', 'default' );
			wp_safe_redirect( home_url( $_POST['_wp_http_referer'] ) );
		}

		$ical_url = get_field( 'field_6143982f5f5f2', $_POST['post_id'] );
		$ical     = file_get_contents( $ical_url );

		$result = wp_remote_post( sprintf( 'https://api.createsend.com/api/v3.2/transactional/smartEmail/%s/send', 'f681cc3f-299d-447c-8444-4b7fbec46082' ), [
			'headers' => [
				'authorization' => 'Basic ' . base64_encode( 'fab3e169a5a467b38347a38dbfaaad6d' ),
			],
			'body'    => json_encode( [
				'To'                  => $email,
				"Data"                => [
					'title' => get_the_title( $_POST['post_id'] ),
					'link'  => home_url( 'live' ),
				],
				"AddRecipientsToList" => true,
				"ConsentToTrack"      => "Yes",
				'Attachments'         => [
					[
						"Type"    => "text/calendar",
						"Name"    => $_POST['post_id'] . '.ics',
						"Content" => base64_encode( $ical ),
					],
				],
			] ),
		] );


		$cm = new CampaignMonitor();
		if(!$cm->isSuccess($result)){
			$session->addToErrorBag( 'newsletter', 'default' );
			wp_safe_redirect( home_url( $_POST['_wp_http_referer'] ) );
		}


		if ( (int) $_POST['nlcheck'] == 1 ) {

			$result_subscriber = wp_remote_post( 'https://api.createsend.com/api/v3.2/subscribers/2b7035b40f7f88da47c1b2e703b2412b.json?email=' . $email, [
				'headers' => [
					'authorization' => 'Basic ' . base64_encode( 'fab3e169a5a467b38347a38dbfaaad6d' ),
				],
				'body'    => json_encode( [
					"EmailAddress"                           => $email,
					"Resubscribe"                            => true,
					"RestartSubscriptionBasedAutoresponders" => true,
					"ConsentToTrack"                         => "Yes",
					"CustomFields"                           => [
						[
							"Key"   => 'ZuletztAngefordertfürImmoliveID',
							"Value" => $_POST['post_id'],
						],
					],
				] ),
			] );
		}

		$session->set('newsletter', 'Wr haben Ihnen ein E-Mail mit der Termindatei gesendet.');
		wp_safe_redirect( home_url( $_POST['_wp_http_referer'] ) );



	}


}