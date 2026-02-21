<?php
/**
 * NikaBeton Services Grid Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Services_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'nikabeton_services_grid';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return 'Послуги (NikaBeton)';
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-settings';
	}

	/**
	 * Get widget categories.
	 */
	public function get_categories() {
		return [ 'nikabeton-widgets' ];
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => 'Налаштування Послуг',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'posts_count',
			[
				'label' => 'Кількість послуг',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 2,
				'max' => 8,
				'step' => 2,
				'default' => 4,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="services-overview py-section bg-light">
			<div class="container">
				<div class="grid grid-2">
					<?php
					$service_query = new \WP_Query(array('post_type' => 'service', 'posts_per_page' => $settings['posts_count']));
					if ($service_query->have_posts()) :
						while ($service_query->have_posts()) : $service_query->the_post();
							$price = get_post_meta(get_the_ID(), '_service_price', true);
							$icon = get_post_meta(get_the_ID(), '_service_icon', true);
					?>
					<div class="service-block bg-white border-radius p-4 shadow">
						<div style="font-size:2rem; color:var(--color-primary); margin-bottom:1rem; text-align:center;"><?php echo $icon ? $icon : '⚙️'; ?></div>
						<h2 style="text-align:center; font-size:1.5rem; margin-bottom:0.5rem;"><?php the_title(); ?></h2>
						<div class="mt-3 text-sm text-muted" style="text-align:center;">
							<?php the_excerpt(); ?>
						</div>
						<?php if($price): ?>
							<div class="mt-3 p-2 border-radius text-center" style="background:var(--color-light); font-weight:bold; color:var(--color-dark);">
								<?php echo esc_html($price); ?>
							</div>
						<?php endif; ?>
						<div class="text-center mt-4">
							<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-full">Детальніше</a>
						</div>
					</div>
					<?php 
						endwhile; wp_reset_postdata(); 
					else:
						echo '<p class="text-center" style="grid-column:1/-1;">Послуги ще не додано. Налаштуйте їх в адмінці.</p>';
					endif; 
					?>
				</div>
			</div>
		</section>
		<?php
	}
}
