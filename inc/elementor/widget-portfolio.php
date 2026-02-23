<?php
/**
 * NikaBeton Portfolio Grid Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Portfolio_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'nikabeton_portfolio_grid';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return 'Портфоліо (NikaBeton)';
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-box';
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
				'label' => 'Налаштування Портфоліо',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'posts_count',
			[
				'label' => 'Кількість робіт',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 3,
				'max' => 12,
				'step' => 3,
				'default' => 3,
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
        <section class="portfolio-section py-section">
            <div class="container">
                <h2 class="section-title text-center mb-4">Наші Роботи</h2>
                <div class="grid grid-3 portfolio-grid mt-4">
                    <?php
                    $portfolio_query = new \WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $settings['posts_count']));
                    if ($portfolio_query->have_posts()) :
                        while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                            $location = get_post_meta(get_the_ID(), '_portfolio_location', true);
                            ?>
                            <div class="portfolio-item hover-scale shadow border-radius overflow-hidden" style="position:relative; background:var(--color-white);">
                                <a href="<?php the_permalink(); ?>" style="display:block; text-decoration:none; color:inherit;">
                                    <div class="portfolio-image" style="height: 250px; overflow:hidden;">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('large', ['style' => 'width:100%; height:100%; object-fit:cover; display:block;']); ?>
                                        <?php else: ?>
                                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#eee; color:#aaa;">Немає фото</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="portfolio-content p-3">
                                        <h3 class="mb-1" style="font-size:1.2rem;"><?php the_title(); ?></h3>
                                        <?php if($location): ?>
                                            <div class="text-sm text-muted mb-2"><i class="dashicons dashicons-location"></i> <?php echo esc_html($location); ?></div>
                                        <?php endif; ?>
                                        <span class="btn-link text-sm" style="color:var(--color-primary); font-weight:bold;">Детальніше &rarr;</span>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    <?php else: ?>
                        <p class="text-center w-100" style="grid-column: 1/-1;">Проєкти ще не додані...</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
		<?php
	}
}
