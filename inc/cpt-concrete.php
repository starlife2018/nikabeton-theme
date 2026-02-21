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
        
        ?>
        <style>
        .nb-concrete-meta-box {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            padding: 15px;
            background: #f0f0f1;
            border: 1px solid #c3c4c7;
            border-radius: 8px;
        }
        .nb-form-group {
            display: flex;
            flex-direction: column;
            background: #fff;
            padding: 18px;
            border: 1px solid #dcdcde;
            border-radius: 6px;
            box-shadow: 0 1px 2px rgba(0,0,0,.04);
            transition: all 0.2s ease-in-out;
        }
        .nb-form-group:hover {
            border-color: #2271b1;
            box-shadow: 0 2px 6px rgba(34,113,177,.15);
        }
        .nb-form-label {
            font-size: 14px;
            font-weight: 600;
            color: #1d2327;
            margin-bottom: 12px;
            display: block;
        }
        .nb-form-hint {
            font-size: 12px;
            color: #646970;
            margin-top: 8px;
            line-height: 1.4;
            font-style: italic;
        }
        .nb-form-control {
            width: 100%;
            padding: 6px 12px;
            border: 1px solid #8c8f94;
            border-radius: 4px;
            font-size: 14px;
            line-height: 1.5;
            min-height: 36px;
            box-shadow: 0 0 0 transparent;
            transition: box-shadow .1s linear;
        }
        .nb-form-control:focus {
            border-color: #2271b1;
            box-shadow: 0 0 0 1px #2271b1;
            outline: 2px solid transparent;
        }
        .nb-price-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .nb-price-wrapper input {
            padding-right: 60px;
        }
        .nb-price-suffix {
            position: absolute;
            right: 12px;
            color: #50575e;
            font-weight: 600;
            pointer-events: none;
            font-size: 14px;
        }
        </style>

        <div class="nb-concrete-meta-box">

            <div class="nb-form-group">
                <label class="nb-form-label" for="concrete_price">Ціна</label>
                <div class="nb-price-wrapper">
                    <input type="number" id="concrete_price" name="concrete_price" value="<?php echo esc_attr($price); ?>" class="nb-form-control" step="0.01" placeholder="0.00" />
                    <span class="nb-price-suffix">грн/м<sup>3</sup></span>
                </div>
                <div class="nb-form-hint">Вкажіть актуальну вартість за кубічний метр продукції.</div>
            </div>

            <div class="nb-form-group">
                <label class="nb-form-label" for="concrete_mark">Марка бетону (M)</label>
                <select id="concrete_mark" name="concrete_mark" class="nb-form-control">
                    <option value="">--Виберіть марку--</option>
                    <?php 
                    $marks = ['M50','M75','M100','M150','M200','M250','M300','M350','M400','M450','M500','M550','M600','M650','M700','M750','M800','M850','M900','M950','M1000'];
                    foreach($marks as $m): ?>
                        <option value="<?php echo esc_attr($m); ?>" <?php selected($mark, $m); ?>><?php echo esc_html($m); ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="nb-form-hint">Міцність бетону. Величина межі міцності на стиск у кг/см<sup>2</sup>.</div>
            </div>

            <div class="nb-form-group">
                <label class="nb-form-label" for="concrete_class">Клас міцності (B)</label>
                <select id="concrete_class" name="concrete_class" class="nb-form-control">
                    <option value="">--Виберіть клас--</option>
                    <?php 
                    $classes = ['B3.5', 'B5', 'B7.5', 'B10', 'B12.5', 'B15','B20','B25','B30','B35','B40','B45','B50','B55','B60','B65','B70','B75','B80','B85','B90','B95','B100'];
                    foreach($classes as $c): ?>
                        <option value="<?php echo esc_attr($c); ?>" <?php selected($class, $c); ?>><?php echo esc_html($c); ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="nb-form-hint">Гарантована міцність бетону (основний показник).</div>
            </div>

            <div class="nb-form-group">
                <label class="nb-form-label" for="concrete_frost">Морозостійкість (F)</label>
                <div class="nb-price-wrapper">
                    <input type="number" id="concrete_frost" name="concrete_frost" value="<?php echo esc_attr($frost); ?>" class="nb-form-control" placeholder="Наприклад: 50" min="50" max="1000" />
                    <span class="nb-price-suffix">F</span>
                </div>
                <div class="nb-form-hint">Кількість циклів замерзання-відтавання (від 50 до 1000).</div>
            </div>

            <div class="nb-form-group">
                <label class="nb-form-label" for="concrete_water">Водонепроникність (W)</label>
                <div class="nb-price-wrapper">
                    <input type="number" max="20" min="2" id="concrete_water" name="concrete_water" value="<?php echo esc_attr($water); ?>" class="nb-form-control" placeholder="Наприклад: 6" />
                    <span class="nb-price-suffix">W</span>
                </div>
                <div class="nb-form-hint">Тиск води, який витримує суміш (від 2 до 20).</div>
            </div>

            <div class="nb-form-group">
                <label class="nb-form-label" for="concrete_plasticity">Пластичність (P)</label>
                <select id="concrete_plasticity" name="concrete_plasticity" class="nb-form-control">
                    <option value="">--Виберіть пластичність--</option>
                    <?php 
                    $classes = ['P1', 'P2', 'P3', 'P4', 'P5'];
                    foreach($classes as $c): ?>
                        <option value="<?php echo esc_attr($c); ?>" <?php selected($plasticity, $c); ?>><?php echo esc_html($c); ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="nb-form-hint">Доставка: самоскиди (Р1-Р3), міксери (Р3-Р5), подача бетононасосом (Р3-Р5).</div>
            </div>

        </div>
        <?php
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
