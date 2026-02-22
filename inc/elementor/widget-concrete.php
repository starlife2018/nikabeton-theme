<?php
/**
 * NikaBeton Concrete Grid Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Concrete_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'nikabeton_concrete_grid';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return 'Сітка Бетону (NikaBeton)';
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-apps';
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
				'label' => 'Налаштування Блоку',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'widget_title',
			[
				'label' => 'Заголовок секції',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'ВИРОБНИЦТВО БЕТОНУ',
				'placeholder' => 'Введіть заголовок',
			]
		);

		$this->add_control(
			'posts_count',
			[
				'label' => 'Кількість товарів',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 3,
				'max' => 99,
				'step' => 3,
				'default' => 6,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => 'Текст нижньої кнопки',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Прайс-лист',
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => 'Посилання для кнопки',
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://ваш-сайт.com',
				'default' => [
					'url' => '#',
				],
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
		<section class="products-section py-section" id="concrete">
			<div class="container">
				<?php if ( ! empty( $settings['widget_title'] ) ) : ?>
					<h2 class="section-title text-center"><?php echo esc_html( $settings['widget_title'] ); ?></h2>
					<h2 class="section-title text-center" style="color: #fff; background-color: #e0620dff; padding: 10px; border-radius: 10px;">Від 400 грн/м³</h2>
                <?php endif; ?>

				<div class="grid grid-3 products-grid mt-4">
					<?php
					$args = array(
						'post_type'      => 'concrete',
						'posts_per_page' => $settings['posts_count'],
						'orderby'        => 'title',
						'order'          => 'ASC'
					);
					$concrete_query = new \WP_Query($args);
					
					if ($concrete_query->have_posts()) :
						while ($concrete_query->have_posts()) : $concrete_query->the_post();
							$price = get_post_meta(get_the_ID(), '_concrete_price', true);
							$class = get_post_meta(get_the_ID(), '_concrete_class', true);
							$mark  = get_post_meta(get_the_ID(), '_concrete_mark', true);
							$frost = get_post_meta(get_the_ID(), '_concrete_frost', true);
							$water = get_post_meta(get_the_ID(), '_concrete_water', true);
							$plasticity = get_post_meta(get_the_ID(), '_concrete_plasticity', true);
							
							$display_title = get_the_title();
							//if ($mark) $display_title .= ' - ' . $mark;
							//if ($frost) $display_title .= ' ' . $frost;
					?>
					<div class="product-card">
						<?php if (has_post_thumbnail()) : ?>
							<div class="product-image">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('medium'); ?>
								</a>
							</div>
						<?php else: ?>
							<div class="product-image placeholder-image text-center">
								<a href="<?php the_permalink(); ?>" style="color:inherit; text-decoration:none; display:flex; width:100%; height:100%; align-items:center; justify-content:center;">Фото</a>
							</div>
						<?php endif; ?>
						
						<div class="product-content">
							<a href="<?php the_permalink(); ?>"><h3 class="product-title"><?php echo esc_html($display_title); ?></h3></a>
							
							<div class="product-desc">
								<div style="display:flex; flex-wrap:wrap; gap:8px;">
									<?php if ($mark) : ?><span class="product-badge">Марка: <strong><?php echo esc_html($mark); ?></strong></span><?php endif; ?>
									<?php if ($class) : ?><span class="product-badge">Клас: <strong><?php echo esc_html($class); ?></strong></span><?php endif; ?>
									<?php if ($water) : ?><span class="product-badge">Водонепроникність: <strong>W<?php echo esc_html($water); ?></strong></span><?php endif; ?>
									<?php if ($plasticity) : ?><span class="product-badge">Пластичність: <strong>P<?php echo esc_html($plasticity); ?></strong></span><?php endif; ?>
									<?php if ($frost) : ?><span class="product-badge">Морозостійкість: <strong>F<?php echo esc_html($frost); ?></strong></span><?php endif; ?>
								</div>
							</div>
							
							<?php if ($price) : ?>
								<div class="product-price">
									<strong><?php echo esc_html($price); ?></strong> <span class="unit">грн/м³</span>
								</div>
							<?php endif; ?>
							
							<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-full mt-2">КУПИТИ</a>
						</div>
					</div>
					<?php 
						endwhile;
						wp_reset_postdata();
					else :
						echo '<p class="text-center" style="grid-column: 1/-1;">Бетон ще не додано. Будь ласка, заповніть каталог в адмін-панелі.</p>';
					endif;
					?>
				</div>

				<!--<?php if ( ! empty( $settings['button_text'] ) ) : ?>
					<div class="text-center mt-4">
						<a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" class="btn btn-outline" style="color:var(--color-dark); border-color:var(--color-dark);">
							<?php echo esc_html( $settings['button_text'] ); ?>
						</a>
					</div>
				<?php endif; ?>-->

			</div>
		</section>
		<?php
	}
}
