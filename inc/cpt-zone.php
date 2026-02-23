<?php
/**
 * Custom Post Type for Service Zones
 *
 * @package NIKABETON
 */

function nikabeton_register_cpt_zone() {
	$labels = array(
		'name'                  => _x( 'Зони обслуговування', 'Post Type General Name', 'nikabeton' ),
		'singular_name'         => _x( 'Зона', 'Post Type Singular Name', 'nikabeton' ),
		'menu_name'             => __( 'Зони обслуговування', 'nikabeton' ),
		'all_items'             => __( 'Всі зони', 'nikabeton' ),
		'add_new_item'          => __( 'Додати зону', 'nikabeton' ),
		'add_new'               => __( 'Додати нову', 'nikabeton' ),
		'new_item'              => __( 'Нова зона', 'nikabeton' ),
		'edit_item'             => __( 'Редагувати зону', 'nikabeton' ),
	);
	$args = array(
		'label'                 => __( 'Зона', 'nikabeton' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ), // Editor for detailed desc
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 8,
		'menu_icon'             => 'dashicons-location',
		'show_in_rest'          => true, 
	);
	register_post_type( 'zone', $args );
}
add_action( 'init', 'nikabeton_register_cpt_zone', 0 );

/**
 * Meta Boxes for Zones (Google Map)
 */
if( !class_exists('ACF') ) {
    function nikabeton_add_zone_metaboxes() {
        add_meta_box( 'nikabeton_zone_specs', 'Деталі зони (локація)', 'nikabeton_zone_specs_callback', 'zone', 'normal', 'high' );
    }
    add_action('add_meta_boxes', 'nikabeton_add_zone_metaboxes');

    function nikabeton_zone_specs_callback($post) {
        wp_nonce_field('nikabeton_save_zone_specs', 'nikabeton_zone_meta_nonce');

        $map_iframe = get_post_meta($post->ID, '_zone_map_iframe', true);
        $address = get_post_meta($post->ID, '_zone_address', true);
        
        echo '<p><label for="zone_address"><strong>Адреса або точне місце:</strong></label><br>';
        echo '<input type="text" id="zone_address" name="zone_address" value="' . esc_attr($address) . '" class="widefat" /></p>';

        echo '<p><label for="zone_map_iframe"><strong>Код Google Карти (iframe):</strong> Вставте HTML код з Google Maps</label><br>';
        echo '<textarea id="zone_map_iframe" name="zone_map_iframe" class="widefat" rows="5">' . esc_textarea($map_iframe) . '</textarea></p>';
    }

    function nikabeton_save_zone_specs($post_id) {
        if (!isset($_POST['nikabeton_zone_meta_nonce']) || !wp_verify_nonce($_POST['nikabeton_zone_meta_nonce'], 'nikabeton_save_zone_specs')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST['zone_address'])) update_post_meta($post_id, '_zone_address', sanitize_text_field($_POST['zone_address']));
        if (isset($_POST['zone_map_iframe'])) update_post_meta($post_id, '_zone_map_iframe', $_POST['zone_map_iframe']); // Keep iframe HTML
    }
    add_action('save_post_zone', 'nikabeton_save_zone_specs');
}
