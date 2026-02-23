<?php
/**
 * Elementor Custom Widgets Initialization
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register NikaBeton Elementor Widgets.
 *
 * Include widget file and register widget class.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function nikabeton_register_elementor_widgets( $widgets_manager ) {
	// Include Widget files
	require_once( __DIR__ . '/widget-concrete.php' );
	require_once( __DIR__ . '/widget-services.php' );
	require_once( __DIR__ . '/widget-materials.php' );
	require_once( __DIR__ . '/widget-calculator.php' );
	require_once( __DIR__ . '/widget-hero-slider.php' );
	require_once( __DIR__ . '/widget-promo.php' );
	require_once( __DIR__ . '/widget-zones.php' );
	require_once( __DIR__ . '/widget-portfolio.php' );
	require_once( __DIR__ . '/widget-reviews.php' );
	require_once( __DIR__ . '/widget-contact-form.php' );
	require_once( __DIR__ . '/widget-advantages-form.php' );
	require_once( __DIR__ . '/widget-projects.php' );
	require_once( __DIR__ . '/widget-header-top.php' );
	require_once( __DIR__ . '/widget-main-menu.php' );

	// Register widget
	$widgets_manager->register( new \Elementor_NikaBeton_Concrete_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Services_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Materials_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Calculator_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Hero_Slider_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Promo_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Zones_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Portfolio_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Reviews_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Contact_Form_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Advantages_Form_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Projects_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Header_Top_Widget() );
	$widgets_manager->register( new \Elementor_NikaBeton_Main_Menu_Widget() );
}
add_action( 'elementor/widgets/register', 'nikabeton_register_elementor_widgets' );

/**
 * Register Elementor Custom Category
 */
function nikabeton_elementor_category( $elements_manager ) {
	$elements_manager->add_category(
		'nikabeton-widgets',
		[
			'title' => 'NikaBeton Віджети',
			'icon' => 'fa fa-plug',
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'nikabeton_elementor_category' );

// Include Dynamic Tags
require_once( __DIR__ . '/dynamic-tags.php' );
