<?php
/**
 * Base class of plugin
 */
class ML_QuadMenu_Pro_Extension {

	/**
	 * Add nessessary hooks
	 */
	public function __construct() {

		add_filter( 'quadmenu_item_object_class', array( $this, 'set_item_object_class' ), 20, 4 );

		// Registers user registration ajax actions (overwrites default QuadMenu PRO behaviour).
		add_action( 'wp_ajax_ml_qmpext_quadmenu_register_user', array( $this, 'register_user' ) );
		add_action( 'wp_ajax_nopriv_ml_qmpext_quadmenu_register_user', array( $this, 'register_user' ) );

		// Deregisters default QuadMenu PRO user registration ajax actions.
		remove_action( 'wp_ajax_quadmenu_register_user', array( 'QuadMenu_Advanced', 'register_user' ), 10 );
		remove_action( 'wp_ajax_nopriv_quadmenu_register_user', array( 'QuadMenu_Advanced', 'register_user' ), 10 );
	}

	/**
	 * Find and overwrite default class name to use
	 * For more detailed information of params and return values refer to QuadMenu PRO
	 */
	function set_item_object_class( $class, $item, $id, $auto_child = '' ) {
		if ( class_exists( 'QuadMenuItemLogin' ) && class_exists( 'ML_QuadMenuItemLogin_Extension' ) ) {
			if ( 'login' === $item->quadmenu ) {
				$class = 'ML_QuadMenuItemLogin_Extension';
			}
		}
		return apply_filters( 'ml_qmpext_set_item_object_class', $class, $item, $id, $auto_child );
	}

	/**
	 * Validates input values and registers user
	 * Modified version of class's QuadMenu_Advanced > register_user method
	 * Based on original register_user method from QuadMenu_Advanced class
	 */
	function register_user() {

		if ( ! class_exists( 'QuadMenu' ) ) {
			wp_die();
		}

		if ( ! check_ajax_referer( 'quadmenu', 'nonce', false ) ) {
			QuadMenu::send_json_error( esc_html__( 'Please reload page.', 'quadmenu' ) );
		}

		$mail = isset( $_POST['mail'] ) ? $_POST['mail'] : false;
		$pass = isset( $_POST['pass'] ) ? $_POST['pass'] : false;

		if ( empty( $mail ) || ! is_email( $mail ) ) {
			QuadMenu::send_json_error( sprintf( '<div class="quadmenu-alert alert-danger">%s</div>', esc_html__( 'Please provide a valid email address.', 'quadmenu' ) ) );
		}

		if ( empty( $pass ) ) {
			QuadMenu::send_json_error( sprintf( '<div class="quadmenu-alert alert-danger">%s</div>', esc_html__( 'Please provide a password.', 'quadmenu' ) ) );
		}

		$userdata = array(
			'user_login' => $mail,
			'user_email' => $mail,
			'user_pass' => $pass,
		);

		$user_id = wp_insert_user( apply_filter( 'ml_qmpext_register_user_userdata', $userdata )  );

		if ( ! is_wp_error( $user_id ) ) {

			$user = get_user_by( 'id', $user_id );

			if ( $user ) {
				wp_set_current_user( $user_id, $user->user_login );
				wp_set_auth_cookie( $user_id );
				do_action( 'wp_login', $user->user_login, $user );
			}

			QuadMenu::send_json_success( sprintf( '<div class="quadmenu-alert alert-success">%s</div>', esc_html__( 'Welcome! Your user have been created.', 'quadmenu' ) ) );
		} else {
			QuadMenu::send_json_error( sprintf( '<div class="quadmenu-alert alert-danger">%s</div>', $user_id->get_error_message() ) );
		}
		wp_die();
	}
}
