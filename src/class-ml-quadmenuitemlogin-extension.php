<?php
/**
 *  Extension of QuadMenuItemLogin class
 */
class ML_QuadMenuItemLogin_Extension extends QuadMenuItemLogin {

	/**
	 * Login form's html which differs from base class method
	 */
	function login_form() {
		ob_start();
		?>
		<form class="quadmenu-login-form" role="form">
			<div class="quadmenu-login-inputs">
				<input type="text" name="quadmenu_username" value="" placeholder="<?php esc_html_e( 'Email address', 'quadmenu' ); ?>"/>
				<input type="password" name="quadmenu_pass" value="" placeholder="<?php esc_html_e( 'Password', 'quadmenu' ); ?>"/>
				<input type="hidden" name="action" value="quadmenu_login_user" />
				<?php wp_nonce_field( 'quadmenu-login-nonce', 'quadmenu_login_user' ); ?>
			</div>
			<div class="quadmenu-login-buttons">
				<input type="submit" class="button button-primary" value="<?php esc_html_e( 'Login', 'quadmenu' ); ?>" />
				<?php if ( $this->item->register ) : ?>
					<a class="button button-primary" href="<?php echo esc_url( $this->item->register ); ?>" title="<?php esc_html_e( 'Register', 'quadmenu' ); ?>"><?php esc_html_e( 'Register', 'quadmenu' ); ?></a>
				<?php else : ?>
					<a class="button button-primary" href="javascript:void(0)" data-toggle="form" data-target=".quadmenu-registration-form" data-current=".quadmenu-login-form" title="<?php esc_html_e( 'Register', 'quadmenu' ); ?>"><?php esc_html_e( 'Register', 'quadmenu' ); ?></a>
				<?php endif; ?>
			</div>
			<div class="quadmenu-result-message"></div>
			<?php if ( $this->item->password ) : ?>
				<a class="quadmenu-bottom-text" href="<?php echo esc_url( $this->item->password ); ?>" title="<?php esc_html_e( 'Lost Password', 'quadmenu' ); ?>"><?php esc_html_e( 'Lost Password', 'quadmenu' ); ?></a>
			<?php else : ?>
				<a class="quadmenu-bottom-text" href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="<?php esc_html_e( 'Lost Password', 'quadmenu' ); ?>"><?php esc_html_e( 'Lost Password', 'quadmenu' ); ?></a>
			<?php endif; ?>
		</form>
		<?php
		echo apply_filters( 'ml_qmpext_login_form_html', ob_get_clean(), $this );
	}

	/**
	 * Registration form's html which differs from base class method
	 */
	function registration_form() {

		if ( $this->item->register ) {
			return;
		}
		ob_start();
		?>
		<form class="hidden quadmenu-registration-form" role="form">
			<div class="quadmenu-login-inputs">
				<input type="email" name="quadmenu_email" value="" placeholder="<?php esc_html_e( 'Email address', 'quadmenu' ); ?>"/>
				<input type="password" name="quadmenu_pass" value="" placeholder="<?php esc_html_e( 'Password', 'quadmenu' ); ?>"/>
				<input type="hidden" name="action" value="aw_qmpext_quadmenu_register_user" />
				<?php wp_nonce_field( 'quadmenu-register-nonce', 'quadmenu_register_user' ); ?>
			</div>
			<div class="quadmenu-login-buttons">
				<input type="submit" class="button button-primary" value="<?php esc_html_e( 'Register', 'quadmenu' ); ?>" />
				<a class="button button-primary" href="javascript:void(0)" data-toggle="form" data-target=".quadmenu-login-form" data-current=".quadmenu-registration-form"><?php esc_html_e( 'Login', 'quadmenu' ); ?></a>
			</div>
			<div class="quadmenu-result-message"></div>
			<?php if ( $this->item->password ) : ?>
				<a class="quadmenu-bottom-text" href="<?php echo esc_url( $this->item->password ); ?>" title="<?php esc_html_e( 'Lost Password', 'quadmenu' ); ?>"><?php esc_html_e( 'Lost Password', 'quadmenu' ); ?></a>
			<?php else : ?>
				<a class="quadmenu-bottom-text" href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="<?php esc_html_e( 'Lost Password', 'quadmenu' ); ?>"><?php esc_html_e( 'Lost Password', 'quadmenu' ); ?></a>
			<?php endif; ?>
		</form>
		<?php
		echo apply_filters( 'ml_qmpext_registration_form_html', ob_get_clean(), $this );
	}
}
