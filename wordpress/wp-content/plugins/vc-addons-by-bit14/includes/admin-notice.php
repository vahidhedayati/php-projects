<?php

defined( 'ABSPATH' ) || die( '-1' );

class  PB_Admin_Notices {
    
    /**
	 * Source of notifications content.
	 *
	 * @var string
	 */
	const SOURCE_URL = 'https://pagebuilderaddons.com/page-builder-addons/notification-free.json';

    /**
	 * The WP option key for storing the notification options.
	 *
	 * @var string
	 */
	const OPTION_KEY = 'pb_notifications_free';

	/**
	 * Option value.
	 *
	 * @var bool|array
	 */
	public $option = false;

	/**
	 * Initialize class.
	 *
	 */
	public function __construct() {

		add_action( 'pb_cron_time', array( $this, 'update' ) );

		add_action( 'pb_admin_pages_before_content', array( $this, 'output')  );

        add_action( 'wp_ajax_pb_notification_dismiss', array( $this, 'notification_dismiss') );

        add_action( 'wp_ajax_nopriv_pb_notification_dismiss' , array( $this,'notification_dismiss') );

	}

	/**
	 * Get option value.
	 *
	 * @param bool $cache Reference property cache if available.
	 *
	 * @return array
	 */
	public function get_option( $cache = true ) {

		if ( $this->option && $cache ) {
			return $this->option;
		}

		$option_data = get_option( self::OPTION_KEY, [] );
        
		$this->option = [
			'update'    => ! empty( $option_data['update'] ) ? $option_data['update'] : 0,
			'events'    => ! empty( $option_data['events'] ) ? $option_data['events'] : [],
			'feed'      => ! empty( $option_data['feed'] ) ? $option_data['feed'] : [],
			'dismissed' => ! empty( $option_data['dismissed'] ) ? $option_data['dismissed'] : [],
		];
	
		return $this->option;
	}

    /**
	 * Fetch notifications from feed.
	 *
	 * @return array
	 */
	public function fetch_feed() {

		$response = wp_remote_get( self::SOURCE_URL );

		if ( is_wp_error( $response ) ) {
			return [];
		}

		$body = wp_remote_retrieve_body( $response );

		if ( empty( $body ) ) {
			return [];
		}
		// var_dump($body);die;
		return $this->verify( json_decode( $body, true ) );
	}

    /**
	 * Verify notification data before it is saved.
	 *
	 * @param array $notifications Array of notification items to verify.
	 *
	 * @return array
	 */
	protected function verify( $notifications ) {

		$data = [];
		if ( ! is_array( $notifications ) || empty( $notifications ) ) {
			return $data;
		}

		$option = $this->get_option();

		foreach ( $notifications as $notification ) {

			// The message and license should never be empty, if they are, ignore.
			if ( empty( $notification['content'] ) ) {
				continue;
			}
			
			// Ignore if expired.
			if ( ! empty( $notification['end'] ) && time() > strtotime( $notification['end'] ) ) {
				continue;
			}
			
			// Ignore if notification has already been dismissed.
			if ( ! empty( $option['dismissed'] ) && in_array( $notification['id'], $option['dismissed'] ) ) {
				continue;
			}


			// Ignore if notification existed before installing WPForms.
			// Prevents bombarding the user with notifications after activation.
			$activated = get_option( 'pb_activated_time' );

			// var_dump( ! empty( $activated ) && ! empty( $notification['start'] ) && $activated > strtotime( $notification['start']));
			if (! empty( $activated ) && ! empty( $notification['start'] ) && $activated > strtotime( $notification['start'] )
			) {
				continue;
			}
			$data[] = $notification;
		}

		return $data;
	}
    
	/**
	 * Verify saved notification data for active notifications.
	 *
	 * @param array $notifications Array of notification items to verify.
	 *
	 * @return array
	 */
	protected function verify_active( $notifications ) {

		if ( ! is_array( $notifications ) || empty( $notifications ) ) {
			return [];
		}

		// Remove notifications that are not active.
		foreach ( $notifications as $key => $notification ) {
			if (
				( ! empty( $notification['start'] ) && time() < strtotime( $notification['start'] ) ) ||
				( ! empty( $notification['end'] ) && time() > strtotime( $notification['end'] ) )
			) {
				unset( $notifications[ $key ] );
			}
		}

		return $notifications;
	}

    /**
	 * Get notification data.
	 *
	 * @return array
	 */
	public function get() {

		$option = $this->get_option();

		// Schedule an action if it's not already scheduled
		if ( ! wp_next_scheduled( 'pb_cron_time' ) ) {
			wp_schedule_event( time(), 'twicedaily', 'pb_cron_time' );
		}

		$events = ! empty( $option['events'] ) ? $this->verify_active( $option['events'] ) : [];
		$feed   = ! empty( $option['feed'] ) ? $this->verify_active( $option['feed'] ) : [];

		return array_merge( $events, $feed );
	}

    /**
	 * Get notification count.
	 *
	 * @return int
	 */
	public function get_count() {

		return count( $this->get() );
	}

    /**
	 * Add a manual notification event.
	 *
	 * @param array $notification Notification data.
	 */
	public function add( $notification ) {

		if ( empty( $notification['id'] ) ) {
			return;
		}

		$option = $this->get_option();

		if ( in_array( $notification['id'], $option['dismissed'] ) ) { // phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
			return;
		}

		foreach ( $option['events'] as $item ) {
			if ( $item['id'] === $notification['id'] ) {
				return;
			}
		}

		$notification = $this->verify( [ $notification ] );

		update_option(
			self::OPTION_KEY,
			[
				'update'    => $option['update'],
				'feed'      => $option['feed'],
				'events'    => array_merge( $notification, $option['events'] ),
				'dismissed' => $option['dismissed'],
			]
		);
	}

	/**
	 * Update notification data from feed.
	 *
	 */
	public function update() {

		$feed   = $this->fetch_feed();
		$option = $this->get_option();

		update_option(
			self::OPTION_KEY,
			[
				'update'    => time(),
				'feed'      => $feed,
				'events'    => $option['events'],
				'dismissed' => $option['dismissed'],
			]
		);
	}

	/**
	 * Output notifications.
	 *
	 */
	public function output() {
      
		$notifications = $this->get();

		if ( empty( $notifications ) ) {
			return;
		}

		$notifications_html   = '';
		$current_class        = ' current';
		$content_allowed_tags = [
			'em'     => [],
			'i'      => [],
			'strong' => [],
			'span'   => [
				'style' => [],
			],
			'a'      => [
				'href'   => [],
				'target' => [],
				'rel'    => [],
			],
		];

		foreach ( $notifications as $notification ) {
			// Buttons HTML.
			$buttons_html = '';
			if ( ! empty( $notification['btns'] ) && is_array( $notification['btns'] ) ) {
				foreach ( $notification['btns'] as $btn_type => $btn ) {
					if ( empty( $btn['text'] ) ) {
						continue;
					}
					$buttons_html .= sprintf(
						'<a href="%1$s" class="button button-%2$s"%3$s>%4$s</a>',
						! empty( $btn['url'] ) ? esc_url( $btn['url'] ) : '',
						$btn_type === 'main' ? 'primary' : 'secondary',
						! empty( $btn['target'] ) && $btn['target'] === '_blank' ? ' target="_blank" rel="noopener noreferrer"' : '',
						sanitize_text_field( $btn['text'] )
					);
				}
				$buttons_html = ! empty( $buttons_html ) ? '<div class="pb-notifications-buttons">' . $buttons_html . '</div>' : '';
			}

			// Notification HTML.
			$notifications_html .= sprintf(
				'<div class="pb-notifications-message%5$s" data-message-id="%4$s">
					<h3 class="pb-notifications-title">%1$s</h3>
					<p class="pb-notifications-content">%2$s</p>
					%3$s
				</div>',
				! empty( $notification['title'] ) ? sanitize_text_field( $notification['title'] ) : '',
				! empty( $notification['content'] ) ? wp_kses( $notification['content'], $content_allowed_tags ) : '',
				$buttons_html,
				! empty( $notification['id'] ) ? esc_attr( sanitize_text_field( $notification['id'] ) ) : 0,
				$current_class
			);
			

			// Only first notification is current.
			$current_class = '';
		}
		?>

		<div id="pb-notifications">

			<div class="pb-notifications-body">
				<a class="dismiss" title="<?php echo esc_attr__( 'Dismiss this message', 'bit14' ); ?>"><i class="dashicons dashicons-dismiss" aria-hidden="true"></i></a>

				<?php if ( count( $notifications ) > 1 ) : ?>
					<div class="navigation">
						<a class="prev">
							<span class="screen-reader-text"><?php esc_attr_e( 'Previous message', 'bit14' ); ?></span>
							<span aria-hidden="true">‹</span>
						</a>
						<a class="next">
							<span class="screen-reader-text"><?php esc_attr_e( 'Next message', 'bit14' ); ?>"></span>
							<span aria-hidden="true">›</span>
						</a>
					</div>
				<?php endif; ?>

				<div class="pb-notifications-messages">
					<?php echo $notifications_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>
		</div>
		<?php
	}

    /**
	 * Notifications Dismiss.
	 *
	 */
    public function notification_dismiss() {

        // Run a security check.
        check_ajax_referer( 'pb-admin', 'nonce' );
    
        // Check for access and required param.
        if ( ! current_user_can( 'manage_options' ) || empty( $_POST['id'] ) ) {
            wp_send_json_error();
        }
    
        $id     = sanitize_text_field( wp_unslash( $_POST['id'] ) );
        $option = $this->get_option();
        $type   = is_numeric( $id ) ? 'feed' : 'events';
    
        $option['dismissed'][] = $id;
        $option['dismissed']   = array_unique( $option['dismissed'] );
    
        // Remove notification.
        if ( is_array( $option[ $type ] ) && ! empty( $option[ $type ] ) ) {
            foreach ( $option[ $type ] as $key => $notification ) {
                if ( $notification['id'] == $id ) { 
                    unset( $option[ $type ][ $key ] );
                    break;
                }
            }
        }
    
        update_option( self::OPTION_KEY, $option );
    
        wp_send_json_success();
    }
}