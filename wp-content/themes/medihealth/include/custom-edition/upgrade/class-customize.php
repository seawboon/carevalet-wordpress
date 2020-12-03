<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Medihealth_Exchange_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->medihealth_setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function medihealth_setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . '/include/custom-edition/upgrade/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Medihealth_Exchange_Customize_Section_Pro' );

		// doc sections.
		$manager->add_section(
			new Medihealth_Exchange_Customize_Section_Pro(
				$manager,
				'medihealth',
				array(
					'title'    => esc_html__( 'Theme Documentation', 'medihealth' ),
					'pro_text' => esc_html__( 'Read Docs', 'medihealth' ),
					'pro_url'  => 'https://awplife.com/medihealth-free-wordpress-theme-setup/',
					'priority'  => 450
				)
			)
		);
	 
		// upgrade sections.
		$manager->add_section(
			new Medihealth_Exchange_Customize_Section_Pro(
				$manager,
				'upgrade-pro',
				array(
					'title'    => esc_html__( 'Upgrade To Pro', 'medihealth'),
					'pro_text' => esc_html__( 'Buy Pro', 'medihealth'),
					'pro_url'  => 'https://awplife.com/wordpress-themes/medihealth-premium/',
					'priority'  => 1
				)
			)
		);
		
		/* // upgrade sections.
		$manager->add_section(
			new Medihealth_Exchange_Customize_Section_Pro(
				$manager,
				'upgrade-pross',
				array(
					'title'    => esc_html__( 'Other Features', 'medihealth'),
					'pro_text' => esc_html__( 'View', 'medihealth'),
					'pro_url'  => '',
					'priority'  => 30
				)
			)
		); */
	}


	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'medihealth-customize-controls', trailingslashit( get_template_directory_uri() ) . '/include/custom-edition/upgrade/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'medihealth-customize-controls', trailingslashit( get_template_directory_uri() ) . '/include/custom-edition/upgrade/customize-controls.css' );
	}
}

// Doing this customizer
Medihealth_Exchange_Customize::get_instance();