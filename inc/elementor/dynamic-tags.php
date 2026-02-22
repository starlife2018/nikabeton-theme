<?php
/**
 * NikaBeton Custom Elementor Dynamic Tags
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Dynamic_Tag extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'nikabeton-post-meta';
	}

	public function get_title() {
		return 'NikaBeton Meta (Ціна, Марка...)';
	}

	public function get_group() {
		return 'post';
	}

	public function get_categories() {
		return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
	}

	protected function register_controls() {
		$this->add_control(
			'meta_key',
			[
				'label' => 'Поле NikaBeton',
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'_concrete_price' => 'Бетон - Ціна',
					'_concrete_class' => 'Бетон - Клас',
					'_concrete_mark' => 'Бетон - Марка',
					'_concrete_frost' => 'Бетон - Морозостійкість (F)',
					'_concrete_water' => 'Бетон - Водонепроникність (W)',
					'_concrete_plasticity' => 'Бетон - Пластичність (P)',
					'_service_price' => 'Послуга - Ціна',
				],
				'default' => '_concrete_price',
			]
		);
	}

	public function render() {
		$meta_key = $this->get_settings( 'meta_key' );
		if ( empty( $meta_key ) ) {
			return;
		}
		
		$value = get_post_meta( get_the_ID(), $meta_key, true );
		echo wp_kses_post( $value );
	}
}

function nikabeton_register_elementor_dynamic_tag( $dynamic_tags_manager ) {
	$dynamic_tags_manager->register( new Elementor_NikaBeton_Dynamic_Tag() );
}
add_action( 'elementor/dynamic_tags/register', 'nikabeton_register_elementor_dynamic_tag' );
