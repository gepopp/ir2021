<?php


namespace irclasses\Boot;


use irclasses\Immolive\ImmoliveEmails;

class ImmoliveSubscription {

	use ImmoliveEmails;

	public function __construct() {
		add_action( 'wp_ajax_immolive_subscription', [ $this, 'subscribe' ] );
		add_action( 'wp_ajax_immolive_is_subscribed', [ $this, 'is_subscribed' ] );
		add_action('publish_immolive', [$this, 'create_immolive_list']);
		add_action('save_post_immolive', [$this, 'create_reminder_campaign'], 20,2);
	}




	public function is_subscribed(){

		if ( ! wp_verify_nonce( sanitize_text_field( $_POST['nonce'] ), 'wp_rest' ) ) {
			wp_die( 'Spamschutz', 400 );
		}

		$subscribers = get_field('field_601451bb66bc3', $_POST['id']);
		$user = wp_get_current_user();
		foreach ( $subscribers as $subscriber ) {
			if($subscriber['user_email'] ==  $user->user_email){
				wp_die(true);
			}
		}
		wp_die(false);

	}






	public function subscribe() {

		if ( ! wp_verify_nonce( sanitize_text_field( $_POST['nonce'] ), 'wp_rest' ) ) {
			wp_die( 'Spamschutz', 400 );
		}

		$immolive_id = (int) $_POST['id'];

		if ( get_post_type( $immolive_id ) !== 'immolive' ) {
			wp_die( 'Datenfehler', 400 );
		}

		$user = wp_get_current_user();

		$this->add_subscriber_to_list($immolive_id, $user);

		$registrants = get_field( 'field_601451bb66bc3', $immolive_id );
		foreach ( $registrants as $registrant ) {
			if ( $registrant['user_email'] == $user->user_email ) {
				wp_die( 'Anemldung erfolgreich!' );
			}
		}

		$added = add_row( 'field_601451bb66bc3', [
			'user_name'        => $user->display_name,
			'user_email'       => $user->user_email,
			'frage_ans_podium' => sanitize_text_field( $_POST['question'] ),
		], $immolive_id );



		if ( $added ) {
			$this->send_subscription_email( $user->display_name, $user->user_email, $immolive_id );
			wp_die( 'Anemldung erfolgreich!' );

		} else {
			wp_die( 'Datenfehler', 400 );
		}

	}

}