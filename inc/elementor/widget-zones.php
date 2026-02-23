<?php
/**
 * NikaBeton Zones Grid Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Zones_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'nikabeton_zones_grid';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return 'Зони Обслуговування (NikaBeton)';
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-price-table';
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
				'label' => 'Налаштування Зон',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'posts_count',
			[
				'label' => 'Кількість зон',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 5,
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
        <section class="zones-section py-section" id="order">
            <div class="container">
                <div class="grid grid-2 align-start">
                    
                    <div class="zones-content">
                        <h2>Зони Обслуговування</h2>
                        <?php
                        $zone_query = new \WP_Query(array('post_type' => 'zone', 'posts_per_page' => $settings['posts_count']));
                        if ($zone_query->have_posts()) :
                            while ($zone_query->have_posts()) : $zone_query->the_post();
                                $address = get_post_meta(get_the_ID(), '_zone_address', true);
                                $map = get_post_meta(get_the_ID(), '_zone_map_iframe', true);
                        ?>
                        <div class="zone-block mb-4 p-4 border-radius shadow" style="background:var(--color-white); border-left: 4px solid var(--color-primary);">
                            <h3 class="text-primary mb-2"><i class="dashicons dashicons-location"></i> <?php the_title(); ?></h3>
                            <?php if($address): ?>
                                <p class="text-sm mb-2"><strong>Адреса:</strong> <?php echo esc_html($address); ?></p>
                            <?php endif; ?>
                            <div class="text-sm mt-2 text-muted">
                                <?php the_content(); ?>
                            </div>
                            <?php if($map): ?>
                                <div class="mt-3 zone-map-wrapper" style="border-radius:8px; overflow:hidden;">
                                    <?php echo wp_unslash($map); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php 
                            endwhile; wp_reset_postdata(); 
                        else:
                        ?>
                            <div class="zone-block mb-3 p-3 bg-white border-radius shadow">
                                <h3 class="text-primary">Київ та Область</h3>
                                <p>Додайте ваші зони обслуговування (меню "Зони Доставки" в адмінці), щоб вони відображалися на карті.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Replace hardcoded form with contact form widget placeholder or just keep simple version for now -->
                    <div class="contact-form-wrapper bg-white shadow p-4 border-radius">
                        <h2>Зв’яжіться з нами!</h2>
                        <form class="lead-form mt-4" action="mailto:vicara8@gmail.com" method="POST" enctype="text/plain">
                            <div class="form-row">
                                <label for="form-name">1. Ваше ім’я</label>
                                <input type="text" id="form-name" name="name" required class="form-control">
                            </div>
                            <div class="form-row">
                                <label for="form-phone">2. Номер телефону*</label>
                                <input type="tel" id="form-phone" name="phone" required class="form-control">
                            </div>
                            <div class="form-row">
                                <label for="form-message">3. Повідомлення</label>
                                <textarea id="form-message" name="message" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-primary btn-full">Надіслати</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
		<?php
	}
}
