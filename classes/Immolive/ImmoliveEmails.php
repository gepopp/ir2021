<?php


namespace irclasses\Immolive;

use Carbon\Carbon;
use irclasses\CampaignMonitor;

trait ImmoliveEmails {


	public function send_subscription_email( $name, $email, $immolive_id ) {

		$ical_url = get_field( 'field_6143982f5f5f2', $immolive_id );


		wp_die(var_dump($ical_url));


		$ical     = file_get_contents( $ical_url );

		$result = wp_remote_post( sprintf( 'https://api.createsend.com/api/v3.2/transactional/smartEmail/%s/send', 'f681cc3f-299d-447c-8444-4b7fbec46082' ), [
			'headers' => CampaignMonitor::get_authorization_header(),
			'body'    => json_encode( [
				'To'                  => $email,
				"Data"                => [
					'title' => get_the_title( $immolive_id ),
					'link'  => home_url( 'live' ),
					'name'  => $name,
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

		return $cm->isSuccess( $result );

	}


	public function create_immolive_list( $immolive_id ) {


		if ( get_post_meta( $immolive_id, 'cm_list' ) ) {
			return;
		}

		$result = wp_remote_post( sprintf( 'https://api.createsend.com/api/v3.2/lists/%s.json', '5dc7a00de27aa7df766faac083551a60' ), [
			'headers' => CampaignMonitor::get_authorization_header(),
			'body'    => json_encode( [
				"Title"              => get_the_title( $immolive_id ) . ' ' . get_field( 'field_5ed527e9c2279', $immolive_id ),
				"UnsubscribeSetting" => "OnlyThisList",
				"ConfirmedOptIn"     => false,
			] ),
		] );

		$cm = new CampaignMonitor();

		if ( $cm->isSuccess( $result ) ) {
			$body = wp_remote_retrieve_body( $result );
			update_post_meta( $immolive_id, 'cm_list', trim( $body, '"' ) );
			$this->add_subscriber_to_list($immolive_id, get_user_by('email', 'gerhard@poppgerhard.at'));
		}
	}



	public function add_subscriber_to_list( $immolive_id, $user ) {


		$list_id = trim( get_post_meta( $immolive_id, 'cm_list', true ), '"' );

		wp_remote_post( sprintf( 'https://api.createsend.com/api/v3.2/subscribers/%s.json', $list_id ), [
			'headers' => CampaignMonitor::get_authorization_header(),
			'body'    => json_encode( [
				"EmailAddress"                           => $user->user_email,
				"Name"                                   => $user->display_name,
				"Resubscribe"                            => true,
				"RestartSubscriptionBasedAutoresponders" => true,
				"ConsentToTrack"                         => "Yes",
			] ),
		] );

	}




	public function create_reminder_campaign( $immolive_id, $immolive ) {

		if(get_post_status($immolive_id ) != 'publish' || !has_post_thumbnail($immolive_id)) return;

		$list_id = trim( get_post_meta( $immolive_id, 'cm_list', true ), '"' );
		if(empty($list_id)) return;

		$campaign = wp_remote_post( 'https://api.createsend.com/api/v3.2/campaigns/5dc7a00de27aa7df766faac083551a60/fromtemplate.json', [
			'headers' => CampaignMonitor::get_authorization_header(),
			'body'    => json_encode( [
				"Name"            => "Immolive Reminder: " . get_the_title( $immolive_id ),
				"Subject"         => get_the_title( $immolive_id ),
				"FromName"        => "Walter Senk",
				"FromEmail"       => "w.senk@immobilien-redaktion.at",
				"ReplyTo"         => "w.senk@immobilien-redaktion.at",
				"ListIDs"         => [
					trim( get_post_meta( $immolive_id, 'cm_list', true ), '"' ),
				],
				"TemplateID"      => "eb65278b73faad49e37616814eeb2a68",
				"TemplateContent" => [
					"Multilines" => [
						[
							"Content" => "<p>Ihr ImmoLive beginnt in k&uuml;rze</p>",
						],
						[
							"Content" => "<p style='font-weight: bold'>Beginn: " . get_field( 'field_5ed527e9c2279', $immolive_id ) . "</p>",
						],
						[
							"Content" => "<p>" . get_the_title( $immolive_id ) . "</p>",
						],
						[
							"Content" => "<p><strong>" . get_the_excerpt( $immolive_id ) . '</strong><br><br>' . get_the_content( $immolive_id ) . "</p>",
						],
					],
					"Images"     => [
						[
							"Content" => get_the_post_thumbnail_url($immolive_id, 'full'),
							"Alt"     => get_the_title($immolive_id),
							"Href"    => get_the_permalink($immolive_id),
						],
					],
				],
			] ),
		] );

		$cm = new CampaignMonitor();

		if($cm->isSuccess($campaign)){

			$campaign = trim(wp_remote_retrieve_body( $campaign ), '"');
			$termin   = get_field('field_5ed527e9c2279', $immolive_id);
			$sent_at = new Carbon($termin);
			$sent_at->subHours(1);

			$sent = wp_remote_post('https://api.createsend.com/api/v3.2/campaigns/'.$campaign.'/send.json',[
				'headers' => CampaignMonitor::get_authorization_header(),
				'body' => json_encode([
					"ConfirmationEmail" => "w.senk@immobilien-redaktion.at, gerhard@poppgerhard.at",
					"SendDate" => $sent_at->format('Y-m-d H:i')
				])
			]);
		}
	}
}