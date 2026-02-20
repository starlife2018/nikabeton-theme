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
    // 1. GLOBAL STYLES (Colors & Logo)
    // ==========================================
    $wp_customize->add_section( 'nikabeton_global_styles', array(
        'title'      => __( 'Глобальні Стилі (Кольори)', 'nikabeton' ),
        'priority'   => 30,
    ) );

    // Logo Width (added to native Site Identity section)
    $wp_customize->add_setting( 'nikabeton_logo_width', array(
        'default'           => 200,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'nikabeton_logo_width', array(
        'type'        => 'range',
        'section'     => 'title_tagline',
        'label'       => __( 'Ширина логотипу (px)', 'nikabeton' ),
        'description' => __( 'Налаштуйте ширину логотипу для ПК (на мобільному він адаптується).', 'nikabeton' ),
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 400,
            'step' => 5,
        ),
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
    // ==========================================
    // 3. HERO SLIDER SETTINGS
    // ==========================================
    $wp_customize->add_section( 'nikabeton_hero_slider', array(
        'title'      => __( 'Головний Слайдер (Hero)', 'nikabeton' ),
        'priority'   => 32,
        'description'=> __( 'Налаштування першого екрану на головній сторінці.', 'nikabeton' ),
    ) );

    // Hero Background Image
    $wp_customize->add_setting( 'nikabeton_hero_bg', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'nikabeton_hero_bg', array(
        'label'    => __( 'Фонове Зображення', 'nikabeton' ),
        'section'  => 'nikabeton_hero_slider',
        'settings' => 'nikabeton_hero_bg',
    ) ) );

    // Hero Title
    $wp_customize->add_setting( 'nikabeton_hero_title', array(
        'default'           => "ДОСТАВКА БЕТОНУ<br>ОРЕНДА БЕТОНОНАСОСУ",
        'sanitize_callback' => 'wp_kses_post', // Allows basic HTML like <br>
    ) );
    $wp_customize->add_control( 'nikabeton_hero_title', array(
        'label'       => __( 'Заголовок (H1)', 'nikabeton' ),
        'description' => __( 'Можна використовувати тег &lt;br&gt; для переносу рядка.', 'nikabeton' ),
        'section'     => 'nikabeton_hero_slider',
        'type'        => 'textarea',
    ) );

    // Hero Subtitle
    $wp_customize->add_setting( 'nikabeton_hero_subtitle', array(
        'default'           => 'В КИЄВІ ТА ВИШГОРОДСЬКОМУ РАЙОНІ',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'nikabeton_hero_subtitle', array(
        'label'    => __( 'Підзаголовок', 'nikabeton' ),
        'section'  => 'nikabeton_hero_slider',
        'type'     => 'text',
    ) );

    // Hero Features (List)
    $wp_customize->add_setting( 'nikabeton_hero_features', array(
        'default'           => "<li>✓ Без Вихідних</li>\n<li>✓ Доставка за 2 години</li>\n<li>✓ Сертифікати якості</li>",
        'sanitize_callback' => 'wp_kses_post', 
    ) );
    $wp_customize->add_control( 'nikabeton_hero_features', array(
        'label'       => __( 'Список Переваг', 'nikabeton' ),
        'description' => __( 'Використовуйте теги &lt;li&gt; Текст &lt;/li&gt; для кожного пункту.', 'nikabeton' ),
        'section'     => 'nikabeton_hero_slider',
        'type'        => 'textarea',
    ) );

    // Hero Button Text
    $wp_customize->add_setting( 'nikabeton_hero_btn_text', array(
        'default'           => 'Замовити',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'nikabeton_hero_btn_text', array(
        'label'    => __( 'Текст Кнопки', 'nikabeton' ),
        'section'  => 'nikabeton_hero_slider',
        'type'     => 'text',
    ) );

    // Hero Button Link
    $wp_customize->add_setting( 'nikabeton_hero_btn_link', array(
        'default'           => '#order',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'nikabeton_hero_btn_link', array(
        'label'    => __( 'Посилання Кнопки', 'nikabeton' ),
        'section'  => 'nikabeton_hero_slider',
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
    $logo_width = get_theme_mod( 'nikabeton_logo_width', 200 );

    $css = "
        :root {
            --color-primary: {$primary_color};
            --color-dark: {$dark_color};
        }
        .site-logo img.custom-logo {
            width: {$logo_width}px;
            max-width: 100%;
            height: auto;
        }
    ";

    wp_add_inline_style( 'nikabeton-main-style', $css );
}
add_action( 'wp_enqueue_scripts', 'nikabeton_customizer_css', 100 );
