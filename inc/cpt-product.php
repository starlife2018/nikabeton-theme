<?php
/**
 * Custom Post Types and Taxonomies for NIKABETON
 *
 * @package NIKABETON
 */

/**
 * Register Custom Post Type for Products/Services
 */
function nikabeton_register_cpt_product() {
	$labels = array(
		'name'                  => _x( 'Товары и Услуги', 'Post Type General Name', 'nikabeton' ),
		'singular_name'         => _x( 'Товар/Услуга', 'Post Type Singular Name', 'nikabeton' ),
		'menu_name'             => __( 'Каталог', 'nikabeton' ),
		'name_admin_bar'        => __( 'Каталог', 'nikabeton' ),
		'archives'              => __( 'Архив Каталога', 'nikabeton' ),
		'all_items'             => __( 'Все Товары', 'nikabeton' ),
		'add_new_item'          => __( 'Добавить Товар', 'nikabeton' ),
		'add_new'               => __( 'Добавить новый', 'nikabeton' ),
		'new_item'              => __( 'Новый Товар', 'nikabeton' ),
		'edit_item'             => __( 'Редактировать Товар', 'nikabeton' ),
		'update_item'           => __( 'Обновить Товар', 'nikabeton' ),
		'view_item'             => __( 'Смотреть Товар', 'nikabeton' ),
		'search_items'          => __( 'Искать Товар', 'nikabeton' ),
		'not_found'             => __( 'Не найдено', 'nikabeton' ),
		'not_found_in_trash'    => __( 'Не найдено в корзине', 'nikabeton' ),
	);
	$args = array(
		'label'                 => __( 'Товар/Услуга', 'nikabeton' ),
		'description'           => __( 'Каталог бетона, растворов и ЖБИ', 'nikabeton' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'taxonomies'            => array( 'product_category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-cart',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true, // Enable Gutenberg editor
	);
	register_post_type( 'product', $args );
}
add_action( 'init', 'nikabeton_register_cpt_product', 0 );

/**
 * Register Custom Taxonomy for Products
 */
function nikabeton_register_taxonomy_product_category() {
	$labels = array(
		'name'                       => _x( 'Категории Каталога', 'Taxonomy General Name', 'nikabeton' ),
		'singular_name'              => _x( 'Категория', 'Taxonomy Singular Name', 'nikabeton' ),
		'menu_name'                  => __( 'Категории', 'nikabeton' ),
		'all_items'                  => __( 'Все Категории', 'nikabeton' ),
		'add_new_item'               => __( 'Добавить Категорию', 'nikabeton' ),
		'new_item_name'              => __( 'Новое название категории', 'nikabeton' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'product_category', array( 'product' ), $args );
}
add_action( 'init', 'nikabeton_register_taxonomy_product_category', 0 );

/**
 * ACF Field Integration Fallback (in case ACF is not active)
 * Define custom fields using standard WordPress meta if ACF is missing.
 */
if( !class_exists('ACF') ) {
    function nikabeton_add_product_metaboxes() {
        add_meta_box(
            'nikabeton_product_details',
            'Детали Товара (Цена, Применение)',
            'nikabeton_product_details_callback',
            'product',
            'normal',
            'high'
        );
    }
    add_action('add_meta_boxes', 'nikabeton_add_product_metaboxes');

    function nikabeton_product_details_callback($post) {
        wp_nonce_field('nikabeton_save_product_details', 'nikabeton_product_meta_nonce');

        $price = get_post_meta($post->ID, '_product_price', true);
        $application = get_post_meta($post->ID, '_product_application', true);
        
        echo '<p><label for="product_price">Цена (грн/м3 или грн/шт):</label>';
        echo '<input type="text" id="product_price" name="product_price" value="' . esc_attr($price) . '" size="25" class="widefat" /></p>';
        
        echo '<p><label for="product_application">Сфера применения:</label>';
        echo '<input type="text" id="product_application" name="product_application" value="' . esc_attr($application) . '" class="widefat" /></p>';
    }

    function nikabeton_save_product_details($post_id) {
        if (!isset($_POST['nikabeton_product_meta_nonce']) || !wp_verify_nonce($_POST['nikabeton_product_meta_nonce'], 'nikabeton_save_product_details')) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['product_price'])) {
            update_post_meta($post_id, '_product_price', sanitize_text_field($_POST['product_price']));
        }
        if (isset($_POST['product_application'])) {
            update_post_meta($post_id, '_product_application', sanitize_text_field($_POST['product_application']));
        }
    }
    add_action('save_post_product', 'nikabeton_save_product_details');
}
