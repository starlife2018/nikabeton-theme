<?php
/**
 * Custom Post Type for Reviews
 *
 * @package NIKABETON
 */

function nikabeton_register_cpt_review() {
	$labels = array(
		'name'                  => _x( 'Відгуки', 'Post Type General Name', 'nikabeton' ),
		'singular_name'         => _x( 'Відгук', 'Post Type Singular Name', 'nikabeton' ),
		'menu_name'             => __( 'Відгуки Клієнтів', 'nikabeton' ),
		'all_items'             => __( 'Всі Відгуки', 'nikabeton' ),
		'add_new_item'          => __( 'Додати Відгук', 'nikabeton' ),
		'add_new'               => __( 'Додати новий', 'nikabeton' ),
		'new_item'              => __( 'Новий Відгук', 'nikabeton' ),
		'edit_item'             => __( 'Редагувати Відгук', 'nikabeton' ),
	);
	$args = array(
		'label'                 => __( 'Відгук', 'nikabeton' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ), // Title = Author, Editor = Review Text
		'hierarchical'          => false,
		'public'                => false, // Usually reviews don't need their own single page, just integrated
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 9,
		'menu_icon'             => 'dashicons-star-filled',
		'show_in_rest'          => true, 
	);
	register_post_type( 'review', $args );
}
add_action( 'init', 'nikabeton_register_cpt_review', 0 );

/**
 * Meta Boxes for Reviews (Rating)
 */
if( !class_exists('ACF') ) {
    function nikabeton_add_review_metaboxes() {
        add_meta_box( 'nikabeton_review_specs', 'Рейтинг Відгуку', 'nikabeton_review_specs_callback', 'review', 'side', 'default' );
    }
    add_action('add_meta_boxes', 'nikabeton_add_review_metaboxes');

    function nikabeton_review_specs_callback($post) {
        wp_nonce_field('nikabeton_save_review_specs', 'nikabeton_review_meta_nonce');

        $rating = get_post_meta($post->ID, '_review_rating', true);
        if(empty($rating)) $rating = '5'; // default 5 stars
        
        echo '<p><label for="review_rating"><strong>Кількість зірок (1-5):</strong></label><br>';
        echo '<select id="review_rating" name="review_rating" style="width:100%">';
        for($i=1; $i<=5; $i++) {
            echo '<option value="'.$i.'" '.selected($rating, $i, false).'>'.$i.' Зірок</option>';
        }
        echo '</select></p>';

        $source = get_post_meta($post->ID, '_review_source', true);
        echo '<p><label for="review_source"><strong>Джерело (напр. Google):</strong></label><br>';
        echo '<input type="text" id="review_source" name="review_source" value="' . esc_attr($source) . '" class="widefat" /></p>';
    }

    function nikabeton_save_review_specs($post_id) {
        if (!isset($_POST['nikabeton_review_meta_nonce']) || !wp_verify_nonce($_POST['nikabeton_review_meta_nonce'], 'nikabeton_save_review_specs')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST['review_rating'])) update_post_meta($post_id, '_review_rating', sanitize_text_field($_POST['review_rating']));
        if (isset($_POST['review_source'])) update_post_meta($post_id, '_review_source', sanitize_text_field($_POST['review_source']));
    }
    add_action('save_post_review', 'nikabeton_save_review_specs');
}
