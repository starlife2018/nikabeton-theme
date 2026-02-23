<?php
/**
 * NikaBeton Contact Form Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Contact_Form_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'nikabeton_contact_form';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return 'Форма Зв\'язку (NikaBeton)';
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-form-horizontal';
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
				'label' => 'Налаштування Форми',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_title',
			[
				'label' => 'Заголовок форми',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Зв’яжіться з нами!',
			]
		);

        $this->add_control(
			'form_email',
			[
				'label' => 'Email для відправки (mailto fallback)',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'vicara8@gmail.com',
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
        <div class="contact-form-wrapper bg-white shadow p-4 border-radius" style="margin: 0 auto; max-width: 600px;">
            <?php if ( ! empty( $settings['form_title'] ) ) : ?>
                <h2 class="text-center" style="margin-bottom: 2rem;"><?php echo esc_html($settings['form_title']); ?></h2>
            <?php endif; ?>
            <form class="lead-form mt-4" action="mailto:<?php echo esc_attr($settings['form_email']); ?>" method="POST" enctype="text/plain">
                <div class="form-row">
                    <label for="form-name">Ваше ім’я</label>
                    <input type="text" id="form-name" name="name" required class="form-control" style="width:100%; border:1px solid #ddd; padding:10px; border-radius:4px; margin-bottom:15px;">
                </div>
                <div class="form-row">
                    <label for="form-phone">Номер телефону*</label>
                    <input type="tel" id="form-phone" name="phone" required class="form-control" style="width:100%; border:1px solid #ddd; padding:10px; border-radius:4px; margin-bottom:15px;">
                </div>
                <div class="form-row">
                    <label for="form-message">Повідомлення</label>
                    <textarea id="form-message" name="message" rows="4" class="form-control" style="width:100%; border:1px solid #ddd; padding:10px; border-radius:4px; margin-bottom:15px;"></textarea>
                </div>
                <div class="form-row text-center">
                    <button type="submit" class="btn btn-primary" style="width:100%; max-width: 300px;">Надіслати</button>
                    <div style="font-size:0.8rem; margin-top:10px; color:#999;">Відправляючи форму, ви погоджуєтеся на обробку персональних даних.</div>
                </div>
            </form>
        </div>
		<?php
	}
}
