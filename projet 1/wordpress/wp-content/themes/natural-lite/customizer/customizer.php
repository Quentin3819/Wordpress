<?php
/**
 * Theme customizer with real-time update.
 *
 * Very helpful: http://ottopress.com/2012/theme-customizer-part-deux-getting-rid-of-options-pages/
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

function natural_lite_theme_customizer( $wp_customize ) {

	// Category Dropdown Control.
	class Natural_Category_Dropdown_Control extends WP_Customize_Control {
		public $type = 'dropdown-categories';

		public function render_content() {
			$dropdown = wp_dropdown_categories(
				array(
					'name'              => '_customize-dropdown-categories-' . $this->id,
					'echo'              => 0,
					'show_option_none'  => esc_html__( '&mdash; Select &mdash;', 'natural-lite' ),
					'option_none_value' => '0',
					'selected'          => $this->value(),
				)
			);

			// Hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

			printf( '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);
		}
	}

	// Numerical Control.
	class natural_lite_theme_options_Number_Control extends WP_Customize_Control {

		public $type = 'number';

		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
			</label>
			<?php
		}
	}

	function natural_lite_sanitize_transition_interval( $input ) {
		$valid = array(
			'2000' 		=> esc_html__( '2 Seconds', 'natural-lite' ),
			'4000' 		=> esc_html__( '4 Seconds', 'natural-lite' ),
			'6000' 		=> esc_html__( '6 Seconds', 'natural-lite' ),
			'8000' 		=> esc_html__( '8 Seconds', 'natural-lite' ),
			'10000' 	=> esc_html__( '10 Seconds', 'natural-lite' ),
			'12000' 	=> esc_html__( '12 Seconds', 'natural-lite' ),
			'20000' 	=> esc_html__( '20 Seconds', 'natural-lite' ),
			'30000' 	=> esc_html__( '30 Seconds', 'natural-lite' ),
			'60000' 	=> esc_html__( '1 Minute', 'natural-lite' ),
			'999999999'	=> esc_html__( 'Hold Frame', 'natural-lite' ),
		);

		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function natural_lite_sanitize_categories( $input ) {
		$categories = get_terms( 'category', array( 'fields' => 'ids', 'get' => 'all' ) );

		if ( in_array( $input, $categories ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function natural_lite_sanitize_pages( $input ) {
		$pages = get_all_page_ids();

		if ( in_array( $input, $pages ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function natural_lite_sanitize_align( $input ) {
		$valid = array(
			'left' 		=> esc_html__( 'Left Align', 'natural-lite' ),
			'center' 		=> esc_html__( 'Center Align', 'natural-lite' ),
			'right' 	=> esc_html__( 'Right Align', 'natural-lite' ),
		);

		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function natural_lite_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	function natural_lite_sanitize_text( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
	}

	// Set site name and description text to be previewed in real-time.
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @since Organic Origin 1.0
	 * @see natural_lite_customize_register()
	 *
	 * @return void
	 */
	function natural_lite_customize_partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @since Organic Origin 1.0
	 * @see natural_lite_customize_register()
	 *
	 * @return void
	 */
	function natural_lite_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'natural_lite_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'natural_lite_customize_partial_blogdescription',
		) );
	}

	/*
	-----------------------------------------------------------------------------------------------------
	Logo Section
	-----------------------------------------------------------------------------------------------------
	*/

	// Custom Display Site Title Option.
	$wp_customize->add_setting( 'natural_lite_site_title', array(
		'default'						=> '1',
		'sanitize_callback'	=> 'natural_lite_sanitize_checkbox',
		'transport'					=> 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'natural_lite_site_title', array(
		'label'			=> esc_html__( 'Display Site Title', 'natural-lite' ),
		'type'			=> 'checkbox',
		'section'		=> 'title_tagline',
		'settings'	=> 'natural_lite_site_title',
		'priority'	=> 10,
	) ) );

	// Custom Display Tagline Option.
	$wp_customize->add_setting( 'header_text', array(
		'default'						=> '1',
		'sanitize_callback'	=> 'natural_lite_sanitize_checkbox',
		'transport'					=> 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_text', array(
		'label'			=> esc_html__( 'Display Site Tagline', 'natural-lite' ),
		'type'			=> 'checkbox',
		'section'		=> 'title_tagline',
		'settings'	=> 'header_text',
		'priority'	=> 15,
	) ) );

		// Site Title Align.
		$wp_customize->add_setting( 'title_align', array(
			'default' => 'center',
			'sanitize_callback' => 'natural_lite_sanitize_align',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'title_align', array(
			'type' => 'radio',
			'label' => esc_html__( 'Logo & Nav Alignment', 'natural-lite' ),
			'section' => 'title_tagline',
			'choices' => array(
				'left' 		=> esc_html__( 'Left Align', 'natural-lite' ),
				'center' 	=> esc_html__( 'Center Align', 'natural-lite' ),
				'right' 	=> esc_html__( 'Right Align', 'natural-lite' ),
			),
			'priority' => 45,
		) ) );

		/*
		-----------------------------------------------------------------------------------------------------
		Theme Options Section
		-----------------------------------------------------------------------------------------------------
		*/

		$wp_customize->add_section( 'natural_lite_theme_section' , array(
			'title' => esc_html__( 'Theme Options', 'natural-lite' ),
			'description' 	=> esc_html__( 'Set and save options for the homepage and blog page template.', 'natural-lite' ),
			'priority' => 2,
		) );

		// Featured Slideshow Category.
		$wp_customize->add_setting( 'category_slideshow_home' , array(
			'default' 			=> '0',
			'sanitize_callback' => 'natural_lite_sanitize_categories',
		) );
		$wp_customize->add_control( new Natural_Category_Dropdown_Control( $wp_customize, 'category_slideshow_home', array(
			'priority' 	=> 20,
			'label'		=> esc_html__( 'Home Slideshow Category', 'natural-lite' ),
			'section'	=> 'natural_lite_theme_section',
			'settings'	=> 'category_slideshow_home',
			'type'		=> 'dropdown-categories',
		) ) );

		// Featured Page Left.
		$wp_customize->add_setting( 'natural_lite_page_left', array(
			'default' 			=> '0',
			'sanitize_callback' => 'natural_lite_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'natural_lite_page_left', array(
			'priority' 	=> 100,
			'label'		=> esc_html__( 'Home Featured Page Left', 'natural-lite' ),
			'section'	=> 'natural_lite_theme_section',
			'settings'	=> 'natural_lite_page_left',
			'type'		=> 'dropdown-pages',
		) ) );

		// Featured Page Middle.
		$wp_customize->add_setting( 'natural_lite_page_mid', array(
			'default' 			=> '0',
			'sanitize_callback' => 'natural_lite_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'natural_lite_page_mid', array(
			'priority' 	=> 120,
			'label'		=> esc_html__( 'Home Featured Page Middle', 'natural-lite' ),
			'section'	=> 'natural_lite_theme_section',
			'settings'	=> 'natural_lite_page_mid',
			'type'		=> 'dropdown-pages',
		) ) );

		// Featured Page Right.
		$wp_customize->add_setting( 'natural_lite_page_right', array(
			'default' 			=> '0',
			'sanitize_callback' => 'natural_lite_sanitize_pages',
		) );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'natural_lite_page_right', array(
			'priority' 	=> 140,
			'label'		=> esc_html__( 'Home Featured Page Right', 'natural-lite' ),
			'section'	=> 'natural_lite_theme_section',
			'settings'	=> 'natural_lite_page_right',
			'type'		=> 'dropdown-pages',
		) ) );

		// Featured News Category.
		$wp_customize->add_setting( 'natural_lite_category_news', array(
			'default' 			=> '0',
			'sanitize_callback' => 'natural_lite_sanitize_categories',
		) );
		$wp_customize->add_control( new Natural_Category_Dropdown_Control( $wp_customize, 'natural_lite_category_news', array(
			'priority' 	=> 160,
			'label'		=> esc_html__( 'Home News Category', 'natural-lite' ),
			'section'	=> 'natural_lite_theme_section',
			'settings'	=> 'natural_lite_category_news',
			'type'		=> 'dropdown-categories',
		) ) );

		// Featured News Posts Displayed.
		$wp_customize->add_setting( 'natural_lite_postnumber_news', array(
			'default' 			=> '3',
			'sanitize_callback' => 'natural_lite_sanitize_text',
		) );
		$wp_customize->add_control( new natural_lite_theme_options_Number_Control( $wp_customize, 'natural_lite_postnumber_news', array(
			'priority' 	=> 180,
			'label'		=> esc_html__( 'Home News Post Number', 'natural-lite' ),
			'section'	=> 'natural_lite_theme_section',
			'settings'	=> 'natural_lite_postnumber_news',
			'type'		=> 'number',
		) ) );

		// Blog Page Template Category.
		$wp_customize->add_setting( 'natural_lite_category_blog' , array(
			'default' 			=> '0',
			'sanitize_callback' => 'natural_lite_sanitize_categories',
		) );
		$wp_customize->add_control( new Natural_Category_Dropdown_Control( $wp_customize, 'natural_lite_category_blog', array(
			'priority' 	=> 200,
			'label'		=> esc_html__( 'Blog Page Template Category', 'natural-lite' ),
			'section'	=> 'natural_lite_theme_section',
			'settings'	=> 'natural_lite_category_blog',
			'type'		=> 'dropdown-categories',
		) ) );

}
add_action( 'customize_register', 'natural_lite_theme_customizer' );

/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 */
function natural_lite_customize_preview_js() {
	wp_enqueue_script( 'natural-customizer', get_template_directory_uri() . '/customizer/js/customizer.js', array( 'customize-preview' ) );
}
add_action( 'customize_preview_init', 'natural_lite_customize_preview_js' );

/**
 * Logo Resizer
 */
require get_template_directory() . '/customizer/logo-resizer.php';
