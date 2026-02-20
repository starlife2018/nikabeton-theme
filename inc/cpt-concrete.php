<?php
/**
 * Custom Post Type for Concrete Products
 * Field requirements mapped from nikabeton.com/beton
 *
 * @package NIKABETON
 */

/**
 * Register Custom Post Type for Concrete
 */
function nikabeton_register_cpt_concrete() {
	$labels = array(
		'name'                  => _x( 'Бетон', 'Post Type General Name', 'nikabeton' ),
		'singular_name'         => _x( 'Бетон', 'Post Type Singular Name', 'nikabeton' ),
		'menu_name'             => __( 'Бетон', 'nikabeton' ),
		'name_admin_bar'        => __( 'Бетон', 'nikabeton' ),
		'archives'              => __( 'Архів Бетону', 'nikabeton' ),
		'all_items'             => __( 'Всі Марки Бетону', 'nikabeton' ),
		'add_new_item'          => __( 'Додати Марку Бетону', 'nikabeton' ),
		'add_new'               => __( 'Додати новий', 'nikabeton' ),
		'new_item'              => __( 'Нова Марка Бетону', 'nikabeton' ),
		'edit_item'             => __( 'Редагувати Бетон', 'nikabeton' ),
		'update_item'           => __( 'Оновити Бетон', 'nikabeton' ),
		'view_item'             => __( 'Дивитись Бетон', 'nikabeton' ),
		'search_items'          => __( 'Шукати Бетон', 'nikabeton' ),
		'not_found'             => __( 'Не знайдено', 'nikabeton' ),
		'not_found_in_trash'    => __( 'Не знайдено в кошику', 'nikabeton' ),
	);
	$args = array(
		'label'                 => __( 'Бетон', 'nikabeton' ),
		'description'           => __( 'Каталог марок бетону', 'nikabeton' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ), // Removed excerpt as attributes define it
		'taxonomies'            => array( 'concrete_type' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-grid-view',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true, 
	);
	register_post_type( 'concrete', $args );
}
add_action( 'init', 'nikabeton_register_cpt_concrete', 0 );

/**
 * Register Taxonomy for Concrete Types
 */
function nikabeton_register_taxonomy_concrete_type() {
	$labels = array(
		'name'                       => _x( 'Типи Бетону', 'Taxonomy General Name', 'nikabeton' ),
		'singular_name'              => _x( 'Тип Бетону', 'Taxonomy Singular Name', 'nikabeton' ),
		'menu_name'                  => __( 'Типи Бетону', 'nikabeton' ),
		'all_items'                  => __( 'Всі Типи Бетону', 'nikabeton' ),
		'add_new_item'               => __( 'Додати Тип', 'nikabeton' ),
		'new_item_name'              => __( 'Нова назва типу', 'nikabeton' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'concrete_type', array( 'concrete' ), $args );
}
add_action( 'init', 'nikabeton_register_taxonomy_concrete_type', 0 );

/**
 * Meta Boxes for Concrete Characteristics
 */
if( !class_exists('ACF') ) {
    function nikabeton_add_concrete_metaboxes() {
        add_meta_box(
            'nikabeton_concrete_specs',
            'Характеристики Бетону',
            'nikabeton_concrete_specs_callback',
            'concrete',
            'normal',
            'high'
        );
    }
    add_action('add_meta_boxes', 'nikabeton_add_concrete_metaboxes');

    function nikabeton_concrete_specs_callback($post) {
        wp_nonce_field('nikabeton_save_concrete_specs', 'nikabeton_concrete_meta_nonce');

        $price = get_post_meta($post->ID, '_concrete_price', true);
        $class = get_post_meta($post->ID, '_concrete_class', true);
        $mark = get_post_meta($post->ID, '_concrete_mark', true);
        $frost = get_post_meta($post->ID, '_concrete_frost', true);
        $water = get_post_meta($post->ID, '_concrete_water', true);
        $plasticity = get_post_meta($post->ID, '_concrete_plasticity', true);
        
        echo '<div style="display:grid; grid-template-columns: 1fr 1fr; gap: 1rem;">';
        
        echo '<p><label for="concrete_price"><strong>Ціна (грн/м3):</strong></label><br>';
        echo '<input type="text" id="concrete_price" name="concrete_price" value="' . esc_attr($price) . '" class="widefat" /></p>';

        echo '<p><label for="concrete_class"><strong>Клас (B):</strong> наприклад B15, В20</label><br>';
        echo '<input type="text" id="concrete_class" name="concrete_class" value="' . esc_attr($class) . '" class="widefat" /></p>';

        echo '<p><label for="concrete_mark"><strong>Марка (M):</strong> наприклад M200, М250</label><br>';
        echo '<input type="text" id="concrete_mark" name="concrete_mark" value="' . esc_attr($mark) . '" class="widefat" /></p>';

        echo '<p><label for="concrete_frost"><strong>Морозостійкість (F):</strong> наприклад F50</label><br>';
        echo '<input type="text" id="concrete_frost" name="concrete_frost" value="' . esc_attr($frost) . '" class="widefat" /></p>';

        echo '<p><label for="concrete_water"><strong>Водонепроникність (W):</strong> наприклад W6</label><br>';
        echo '<input type="text" id="concrete_water" name="concrete_water" value="' . esc_attr($water) . '" class="widefat" /></p>';

        echo '<p><label for="concrete_plasticity"><strong>Рухливість (П):</strong> наприклад П3 (Опціонально)</label><br>';
        echo '<input type="text" id="concrete_plasticity" name="concrete_plasticity" value="' . esc_attr($plasticity) . '" class="widefat" /></p>';

        echo '</div>';
    }

    function nikabeton_save_concrete_specs($post_id) {
        if (!isset($_POST['nikabeton_concrete_meta_nonce']) || !wp_verify_nonce($_POST['nikabeton_concrete_meta_nonce'], 'nikabeton_save_concrete_specs')) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $fields = ['price', 'class', 'mark', 'frost', 'water', 'plasticity'];
        foreach($fields as $field) {
            $key = 'concrete_' . $field;
            if (isset($_POST[$key])) {
                update_post_meta($post_id, '_concrete_' . $field, sanitize_text_field($_POST[$key]));
            }
        }
    }
    add_action('save_post_concrete', 'nikabeton_save_concrete_specs');
}
