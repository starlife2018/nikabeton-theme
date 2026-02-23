<?php
/**
 * Custom Post Type for Portfolio
 *
 * @package NIKABETON
 */

function nikabeton_register_cpt_portfolio() {
	$labels = array(
		'name'                  => _x( 'Портфоліо', 'Post Type General Name', 'nikabeton' ),
		'singular_name'         => _x( 'Проєкт', 'Post Type Singular Name', 'nikabeton' ),
		'menu_name'             => __( 'Портфоліо робіт', 'nikabeton' ),
		'all_items'             => __( 'Всі Проєкти', 'nikabeton' ),
		'add_new_item'          => __( 'Додати Проєкт', 'nikabeton' ),
		'add_new'               => __( 'Додати новий', 'nikabeton' ),
		'new_item'              => __( 'Новий Проєкт', 'nikabeton' ),
		'edit_item'             => __( 'Редагувати Проєкт', 'nikabeton' ),
	);
	$args = array(
		'label'                 => __( 'Проєкт', 'nikabeton' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ), // Thumbnail is essential here
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 10,
		'menu_icon'             => 'dashicons-format-gallery',
		'has_archive'           => true,
		'rewrite'               => array( 'slug' => 'portfolio' ),
		'show_in_rest'          => true, 
	);
	register_post_type( 'portfolio', $args );
}
add_action( 'init', 'nikabeton_register_cpt_portfolio', 0 );

/**
 * Custom Taxonomy for Portfolio (Categories)
 */
function nikabeton_register_tax_portfolio_cat() {
	$labels = array(
		'name'                       => _x( 'Категорії портфоліо', 'Taxonomy General Name', 'nikabeton' ),
		'singular_name'              => _x( 'Категорія', 'Taxonomy Singular Name', 'nikabeton' ),
		'menu_name'                  => __( 'Категорії', 'nikabeton' ),
		'all_items'                  => __( 'Всі Категорії', 'nikabeton' ),
		'parent_item'                => __( 'Батьківська Категорія', 'nikabeton' ),
		'parent_item_colon'          => __( 'Батьківська Категорія:', 'nikabeton' ),
		'new_item_name'              => __( 'Нова Назва Категорії', 'nikabeton' ),
		'add_new_item'               => __( 'Додати Категорію', 'nikabeton' ),
		'edit_item'                  => __( 'Редагувати Категорію', 'nikabeton' ),
		'update_item'                => __( 'Оновити Категорію', 'nikabeton' ),
		'view_item'                  => __( 'Дивитись Категорію', 'nikabeton' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );
}
add_action( 'init', 'nikabeton_register_tax_portfolio_cat', 0 );

/**
 * Meta Boxes for Portfolio (Location, Used Materials)
 */
if( !class_exists('ACF') ) {
    function nikabeton_add_portfolio_metaboxes() {
        add_meta_box( 'nikabeton_portfolio_specs', 'Деталі Проєкту', 'nikabeton_portfolio_specs_callback', 'portfolio', 'normal', 'high' );
    }
    add_action('add_meta_boxes', 'nikabeton_add_portfolio_metaboxes');

    function nikabeton_portfolio_specs_callback($post) {
        wp_nonce_field('nikabeton_save_portfolio_specs', 'nikabeton_portfolio_meta_nonce');

        $location = get_post_meta($post->ID, '_portfolio_location', true);
        $year = get_post_meta($post->ID, '_portfolio_year', true); // Added year
        $volume = get_post_meta($post->ID, '_portfolio_volume', true);
        
        echo '<p><label for="portfolio_location"><strong>Місцезнаходження об\'єкту:</strong> наприклад "Київ, ЖК Софія"</label><br>';
        echo '<input type="text" id="portfolio_location" name="portfolio_location" value="' . esc_attr($location) . '" class="widefat" /></p>';

        echo '<p><label for="portfolio_year"><strong>Рік виконання об\'єкту:</strong> наприклад "2023"</label><br>';
        echo '<input type="text" id="portfolio_year" name="portfolio_year" value="' . esc_attr($year) . '" class="widefat" /></p>';

        echo '<p><label for="portfolio_volume"><strong>Використані матеріали / Об\'єм:</strong> наприклад "Бетон В20 - 1500 м3"</label><br>';
        echo '<input type="text" id="portfolio_volume" name="portfolio_volume" value="' . esc_attr($volume) . '" class="widefat" /></p>';
    }

    function nikabeton_save_portfolio_specs($post_id) {
        if (!isset($_POST['nikabeton_portfolio_meta_nonce']) || !wp_verify_nonce($_POST['nikabeton_portfolio_meta_nonce'], 'nikabeton_save_portfolio_specs')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST['portfolio_location'])) update_post_meta($post_id, '_portfolio_location', sanitize_text_field($_POST['portfolio_location']));
        if (isset($_POST['portfolio_year'])) update_post_meta($post_id, '_portfolio_year', sanitize_text_field($_POST['portfolio_year']));
        if (isset($_POST['portfolio_volume'])) update_post_meta($post_id, '_portfolio_volume', sanitize_text_field($_POST['portfolio_volume']));
    }
    add_action('save_post_portfolio', 'nikabeton_save_portfolio_specs');
}
