<?php
/**
 * Custom Post Type for Services
 *
 * @package NIKABETON
 */

function nikabeton_register_cpt_service() {
	$labels = array(
		'name'                  => _x( 'Послуги', 'Post Type General Name', 'nikabeton' ),
		'singular_name'         => _x( 'Послуга', 'Post Type Singular Name', 'nikabeton' ),
		'menu_name'             => __( 'Послуги', 'nikabeton' ),
		'all_items'             => __( 'Всі Послуги', 'nikabeton' ),
		'add_new_item'          => __( 'Додати Послугу', 'nikabeton' ),
		'add_new'               => __( 'Додати нову', 'nikabeton' ),
		'new_item'              => __( 'Нова Послуга', 'nikabeton' ),
		'edit_item'             => __( 'Редагувати Послугу', 'nikabeton' ),
		'update_item'           => __( 'Оновити Послугу', 'nikabeton' ),
		'view_item'             => __( 'Дивитись Послугу', 'nikabeton' ),
		'search_items'          => __( 'Шукати Послуги', 'nikabeton' ),
	);
	$args = array(
		'label'                 => __( 'Послуга', 'nikabeton' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 7,
		'menu_icon'             => 'dashicons-admin-tools',
		'show_in_nav_menus'     => true,
		'has_archive'           => true,
		'rewrite'               => array( 'slug' => 'service' ),
		'show_in_rest'          => true, 
	);
	register_post_type( 'service', $args );
}
add_action( 'init', 'nikabeton_register_cpt_service', 0 );

/**
 * Meta Boxes for Service
 */
if( !class_exists('ACF') ) {
    function nikabeton_add_service_metaboxes() {
        add_meta_box( 'nikabeton_service_specs', 'Деталі Послуги', 'nikabeton_service_specs_callback', 'service', 'normal', 'high' );
    }
    add_action('add_meta_boxes', 'nikabeton_add_service_metaboxes');

    function nikabeton_service_specs_callback($post) {
        wp_nonce_field('nikabeton_save_service_specs', 'nikabeton_service_meta_nonce');

        $price = get_post_meta($post->ID, '_service_price', true);
        $icon = get_post_meta($post->ID, '_service_icon', true); // E.g., FontAwesome class or SVG code
        
        echo '<p><label for="service_price"><strong>Ціна (від):</strong> наприклад "від 1500 грн/год"</label><br>';
        echo '<input type="text" id="service_price" name="service_price" value="' . esc_attr($price) . '" class="widefat" /></p>';

        echo '<p><label for="service_icon"><strong>Іконка (SVG код або клас):</strong></label><br>';
        echo '<textarea id="service_icon" name="service_icon" class="widefat" rows="4">' . esc_textarea($icon) . '</textarea></p>';
    }

    function nikabeton_save_service_specs($post_id) {
        if (!isset($_POST['nikabeton_service_meta_nonce']) || !wp_verify_nonce($_POST['nikabeton_service_meta_nonce'], 'nikabeton_save_service_specs')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST['service_price'])) update_post_meta($post_id, '_service_price', sanitize_text_field($_POST['service_price']));
        if (isset($_POST['service_icon'])) update_post_meta($post_id, '_service_icon', $_POST['service_icon']); // Allow JS/SVG
    }
    add_action('save_post_service', 'nikabeton_save_service_specs');
}
