<?php
/**
 * NIKABETON theme functions and definitions
 *
 * @package NIKABETON
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function nikabeton_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Add proper support for custom logo in Customizer
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nikabeton' ),
			'menu-footer' => esc_html__( 'Footer Menu', 'nikabeton' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'nikabeton_setup' );

/**
 * Enqueue scripts and styles.
 */
function nikabeton_scripts() {
	wp_enqueue_style( 'nikabeton-style', get_stylesheet_uri(), array(), _S_VERSION );      
	wp_enqueue_style( 'nikabeton-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), _S_VERSION );

	wp_enqueue_script( 'nikabeton-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );
	wp_localize_script( 'nikabeton-main-js', 'nikabetonAjax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	) );
}
add_action( 'wp_enqueue_scripts', 'nikabeton_scripts' );

/**
 * Load Custom Post Types and Functionality
 */
require get_template_directory() . '/inc/cpt-product.php';
require get_template_directory() . '/inc/cpt-concrete.php';
require get_template_directory() . '/inc/cpt-service.php';
require get_template_directory() . '/inc/cpt-zone.php';
require get_template_directory() . '/inc/cpt-review.php';
require get_template_directory() . '/inc/cpt-portfolio.php';

/**
 * Handle AJAX Forms
 */
require get_template_directory() . '/inc/ajax-form.php';

/**
 * Register Elementor Shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Register Native Elementor Widgets
 */
if ( did_action( 'elementor/loaded' ) ) {
    require get_template_directory() . '/inc/elementor/elementor-init.php';
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

if ( ! function_exists( 'nikabeton_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 */
	function nikabeton_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->
		<?php else : ?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>
			<?php
		endif; // End is_singular().
	}
endif;

/**
 * ------------------------------------------------------------------
 * DEMO CONTENT INSTALLER (Self-disabling)
 * ------------------------------------------------------------------
 */
function nikabeton_install_demo_content() {
    if ( get_option( 'nikabeton_demo_installed' ) ) {
        return;
    }

    // --- Concrete 1 ---
    $c1 = wp_insert_post([
        'post_title' => 'Бетон В20 (М250)',
        'post_status' => 'publish',
        'post_type' => 'concrete'
    ]);
    if($c1 && !is_wp_error($c1)) {
        update_post_meta($c1, '_concrete_price', '2600');
        update_post_meta($c1, '_concrete_class', 'В20');
        update_post_meta($c1, '_concrete_mark', 'М250');
        update_post_meta($c1, '_concrete_frost', 'F200');
        update_post_meta($c1, '_concrete_water', 'W6');
        update_post_meta($c1, '_concrete_plasticity', 'P3');
    }

    // --- Concrete 2 ---
    $c2 = wp_insert_post([
        'post_title' => 'Бетон В25 (М350)',
        'post_status' => 'publish',
        'post_type' => 'concrete'
    ]);
    if($c2 && !is_wp_error($c2)) {
        update_post_meta($c2, '_concrete_price', '3100');
        update_post_meta($c2, '_concrete_class', 'В25');
        update_post_meta($c2, '_concrete_mark', 'М350');
        update_post_meta($c2, '_concrete_frost', 'F200');
        update_post_meta($c2, '_concrete_water', 'W6');
        update_post_meta($c2, '_concrete_plasticity', 'P3');
    }

    // --- Service 1 ---
    $s1 = wp_insert_post([
        'post_title' => 'Доставка Бетону (Автоміксер)',
        'post_status' => 'publish',
        'post_type' => 'service',
        'post_content' => 'Швидка доставка бетону автоміксерами об\'ємом від 5 до 12 кубів безпосередньо на ваш будівельний майданчик. Власний автопарк гарантує своєчасність.',
        'post_excerpt' => 'Швидка доставка бетону автоміксерами по Києву та області.'
    ]);
    if($s1) {
        update_post_meta($s1, '_service_price', 'від 400 грн/м³');
        update_post_meta($s1, '_service_icon', '🚚');
    }

    // --- Service 2 ---
    $s2 = wp_insert_post([
        'post_title' => 'Оренда Бетононасосу',
        'post_status' => 'publish',
        'post_type' => 'service',
        'post_content' => 'Надаємо в оренду автобетононасоси зі стрілою від 16 до 52 метрів для заливки бетону у важкодоступних місцях.',
        'post_excerpt' => 'Автобетононасоси від 16 до 52 метрів.'
    ]);
    if($s2) {
        update_post_meta($s2, '_service_price', 'від 8000 грн/зміна');
        update_post_meta($s2, '_service_icon', '🏗️');
    }

    // --- Zone 1 ---
    $z1 = wp_insert_post([
        'post_title' => 'Київ (Правий берег)',
        'post_status' => 'publish',
        'post_type' => 'zone',
        'post_content' => 'Обслуговуємо Оболонський, Подільський, Шевченківський та Святошинський райони з гарантією своєчасної подачі.'
    ]);
    if($z1) {
        update_post_meta($z1, '_zone_address', 'м. Київ');
        update_post_meta($z1, '_zone_map_iframe', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d162758.1729451991!2d30.410313596918882!3d50.40186981143896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cf4ee15a4505%3A0x764931d2170146fe!2sKyiv%2C%20Ukraine%2C%2002000!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>');
    }

    // --- Zone 2 ---
    $z2 = wp_insert_post([
        'post_title' => 'Вишгород та Район',
        'post_status' => 'publish',
        'post_type' => 'zone',
        'post_content' => 'Швидка доставка бетону та розчинів по Вишгороду, Новим Петрівцям, Осещині та прилеглих селах.'
    ]);
    if($z2) {
        update_post_meta($z2, '_zone_address', 'м. Вишгород, Київська область');
        update_post_meta($z2, '_zone_map_iframe', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d162235.48514589417!2d30.344449015923906!3d50.60196238384242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4d12eefc91c33%3A0x892a7e7cb3f23a85!2sVyshhorod%2C%20Kyiv%20Oblast%2C%20Ukraine!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>');
    }

    // --- Review 1 ---
    $r1 = wp_insert_post([
        'post_title' => 'Олександр Коваль',
        'post_status' => 'publish',
        'post_type' => 'review',
        'post_content' => 'Замовляли бетон для фундаменту будинку. Привезли вчасно, якість бетону відмінна. Водій міксера був дуже професійним, допоміг залити у важкодоступне місце.'
    ]);
    if($r1) {
        update_post_meta($r1, '_review_rating', '5');
        update_post_meta($r1, '_review_source', 'Google Maps');
    }

    // --- Review 2 ---
    $r2 = wp_insert_post([
        'post_title' => 'Марія Іваненко',
        'post_status' => 'publish',
        'post_type' => 'review',
        'post_content' => 'Брали бетононасос в оренду на зміну. Техніка нова, оператор знає свою справу. Все пройшло швидко і без затримок. Рекомендую!'
    ]);
    if($r2) {
        update_post_meta($r2, '_review_rating', '5');
        update_post_meta($r2, '_review_source', 'Facebook');
    }

    // --- Review 3 ---
    $r3 = wp_insert_post([
        'post_title' => 'Ігор Петренко',
        'post_status' => 'publish',
        'post_type' => 'review',
        'post_content' => 'Дякую за гарну роботу. Замовляли гарцовку та пісок. Ціни приємні, доставили того ж дня.'
    ]);
    if($r3) {
        update_post_meta($r3, '_review_rating', '4');
        update_post_meta($r3, '_review_source', 'Сайт');
    }

    update_option( 'nikabeton_demo_installed', true );
}
add_action( 'init', 'nikabeton_install_demo_content' );
