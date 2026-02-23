<?php
/**
 * NikaBeton Reviews Grid Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Reviews_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'nikabeton_reviews_grid';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return 'Відгуки (NikaBeton)';
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-testimonial-carousel';
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
				'label' => 'Налаштування Відгуків',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'posts_count',
			[
				'label' => 'Кількість відгуків',
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
        <section class="reviews-section py-section bg-dark text-white">
            <div class="container">
                <h2 class="section-title text-center text-white">Відгуки наших клієнтів</h2>
                <div class="grid grid-3 reviews-grid mt-4">
                    <?php
                    $review_query = new \WP_Query(array('post_type' => 'review', 'posts_per_page' => $settings['posts_count'], 'orderby' => 'date', 'order' => 'DESC'));
                    if ($review_query->have_posts()) :
                        while ($review_query->have_posts()) : $review_query->the_post();
                            $rating = get_post_meta(get_the_ID(), '_review_rating', true);
                            $source = get_post_meta(get_the_ID(), '_review_source', true);
                            
                            $stars_html = '';
                            for($i=1; $i<=5; $i++) {
                                $stars_html .= ($i <= $rating) ? '★' : '☆';
                            }
                    ?>
                    <div class="review-card p-4 border-radius shadow text-center" style="background:#2a2a2a; border-top:3px solid var(--color-primary);">
                        <div class="review-stars mb-3" style="color:#FFD700; font-size:1.5rem; letter-spacing:2px;"><?php echo $stars_html; ?></div>
                        <div class="review-text text-sm mb-4" style="font-style:italic;">"<?php echo wp_strip_all_tags(get_the_content()); ?>"</div>
                        <h4 class="review-author m-0" style="color:var(--color-white);"><?php the_title(); ?></h4>
                        <?php if($source): ?>
                            <div class="review-source text-xs mt-2" style="color:#aaa;">через <?php echo esc_html($source); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php 
                        endwhile; wp_reset_postdata(); 
                    else:
                        echo '<p class="text-center w-100" style="grid-column: 1/-1; color:#aaa;">Відгуки поки що відсутні. Додайте їх в меню "Відгуки".</p>';
                    endif; 
                    ?>
                </div>
            </div>
        </section>
		<?php
	}
}
