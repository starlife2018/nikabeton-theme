<?php
/**
 * NIKABETON Theme Customizer
 *
 * @package NIKABETON
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nikabeton_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'nikabeton_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'nikabeton_customize_partial_blogdescription',
			)
		);
	}

    // ==========================================
    // 1. GLOBAL STYLES (Colors)
    // ==========================================
    $wp_customize->add_section( 'nikabeton_global_styles', array(
        'title'      => __( 'Глобальні Стилі (Кольори)', 'nikabeton' ),
        'priority'   => 30,
    ) );

    // Primary Color
    $wp_customize->add_setting( 'nikabeton_primary_color', array(
        'default'           => '#f87e00',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nikabeton_primary_color', array(
        'label'    => __( 'Основний Колір (Primary)', 'nikabeton' ),
        'section'  => 'nikabeton_global_styles',
        'settings' => 'nikabeton_primary_color',
    ) ) );

    // Dark Background Color
    $wp_customize->add_setting( 'nikabeton_dark_color', array(
        'default'           => '#1f1f1f',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nikabeton_dark_color', array(
        'label'    => __( 'Темний Колір (Backgrounds/Footers)', 'nikabeton' ),
        'section'  => 'nikabeton_global_styles',
        'settings' => 'nikabeton_dark_color',
    ) ) );


    // ==========================================
    // 2. CONTACT INFORMATION
    // ==========================================
    $wp_customize->add_section( 'nikabeton_contacts', array(
        'title'      => __( 'Контактна Інформація', 'nikabeton' ),
        'priority'   => 31,
    ) );

    // Main Phone
    $wp_customize->add_setting( 'nikabeton_phone_main', array(
        'default'           => '+38(050)382-48-12',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'nikabeton_phone_main', array(
        'label'    => __( 'Головний Телефон', 'nikabeton' ),
        'section'  => 'nikabeton_contacts',
        'type'     => 'text',
    ) );

    // Second Phone
    $wp_customize->add_setting( 'nikabeton_phone_second', array(
        'default'           => '+38(050)382-48-13',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'nikabeton_phone_second', array(
        'label'    => __( 'Додатковий Телефон', 'nikabeton' ),
        'section'  => 'nikabeton_contacts',
        'type'     => 'text',
    ) );

    // Email
    $wp_customize->add_setting( 'nikabeton_email', array(
        'default'           => 'hello@nikabeton.com',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'nikabeton_email', array(
        'label'    => __( 'Електронна пошта', 'nikabeton' ),
        'section'  => 'nikabeton_contacts',
        'type'     => 'email',
    ) );

    // Schedule Line 1
    $wp_customize->add_setting( 'nikabeton_schedule_1', array(
        'default'           => 'Пн-Пт: 8:00-20:00',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'nikabeton_schedule_1', array(
        'label'    => __( 'Графік Роботи (Будні)', 'nikabeton' ),
        'section'  => 'nikabeton_contacts',
        'type'     => 'text',
    ) );

    // Schedule Line 2
    $wp_customize->add_setting( 'nikabeton_schedule_2', array(
        'default'           => 'Сб-Нд: 9:00-18:00',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'nikabeton_schedule_2', array(
        'label'    => __( 'Графік Роботи (Вихідні)', 'nikabeton' ),
        'section'  => 'nikabeton_contacts',
        'type'     => 'text',
    ) );

    // Socials
    $wp_customize->add_setting( 'nikabeton_social_viber', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'nikabeton_social_viber', array(
        'label'    => __( 'Посилання на Viber', 'nikabeton' ),
        'section'  => 'nikabeton_contacts',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'nikabeton_social_telegram', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'nikabeton_social_telegram', array(
        'label'    => __( 'Посилання на Telegram', 'nikabeton' ),
        'section'  => 'nikabeton_contacts',
        'type'     => 'url',
    ) );

    $wp_customize->add_setting( 'nikabeton_social_whatsapp', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'nikabeton_social_whatsapp', array(
        'label'    => __( 'Посилання на WhatsApp', 'nikabeton' ),
        'section'  => 'nikabeton_contacts',
        'type'     => 'url',
    ) );
}
add_action( 'customize_register', 'nikabeton_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function nikabeton_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function nikabeton_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Inject Customizer CSS into wp_head
 */
function nikabeton_customizer_css() {
    $primary_color = get_theme_mod( 'nikabeton_primary_color', '#f87e00' );
    $dark_color = get_theme_mod( 'nikabeton_dark_color', '#1f1f1f' );

    $css = "
        :root {
            --color-primary: {$primary_color};
            --color-dark: {$dark_color};
        }
    ";

    wp_add_inline_style( 'nikabeton-main-style', $css );
}
add_action( 'wp_enqueue_scripts', 'nikabeton_customizer_css', 100 );
