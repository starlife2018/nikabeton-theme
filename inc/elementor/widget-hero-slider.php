<?php
/**
 * NikaBeton Hero Slider Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Hero_Slider_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'nikabeton_hero_slider';
	}

	public function get_title() {
		return 'Головний Слайдер (NikaBeton)';
	}

	public function get_icon() {
		return 'eicon-slides';
	}

	public function get_categories() {
		return [ 'nikabeton-widgets' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => 'Слайди',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => 'Головний Заголовок',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'ДОСТАВКА БЕТОНУ',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'subtitle',
			[
				'label' => 'Підзаголовок (або Ціна)',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'В КИЄВІ ТА ВИШГОРОДСЬКОМУ РАЙОНІ',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'features',
			[
				'label' => 'Особливості (кожна з нового рядка)',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => "Без Вихідних\nДоставка за 2 години\nСертифікати якості",
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' => 'Текст кнопки',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Замовити',
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label' => 'Посилання кнопки',
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#order',
				],
			]
		);

		$repeater->add_control(
			'background_image',
			[
				'label' => 'Фонове зображення',
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'slides',
			[
				'label' => 'Додати слайди',
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => "ДОСТАВКА БЕТОНУ\nОРЕНДА БЕТОНОНАСОСУ",
						'subtitle' => 'В КИЄВІ ТА ВИШГОРОДСЬКОМУ РАЙОНІ',
						'features' => "Без Вихідних\nДоставка за 2 години\nСертифікати якості",
						'button_text' => 'Замовити',
					],
					[
						'title' => 'ТОП Продаж',
						'subtitle' => 'Бетон В20 М250 F200 W6 - 2600 грн/м3',
						'features' => "Найвигідніше співвідношення ціна/якість\nБез Вихідних\nДоставка за 2 години\nСертифікати якості",
						'button_text' => 'Замовити',
					],
					[
						'title' => 'Доставка Бетона по Місту - 400 грн/м3',
						'subtitle' => '',
						'features' => "Без Вихідних\nДоставка за 2 години\nСертифікати якості",
						'button_text' => 'Контакти',
					],
					[
						'title' => 'Оренда Бетононасоса',
						'subtitle' => 'Подача і дві години роботи - 8000 грн',
						'features' => "Подача за 2 години\nБез Вихідних",
						'button_text' => 'Орендувати',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => 'Стиль',
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'height',
			[
				'label' => 'Висота Слайдера (px)',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 600,
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$slides = $settings['slides'];
		$height = !empty($settings['height']) ? $settings['height'] : 600;

		$slider_id = 'nikabeton-slider-' . $this->get_id();

		if ( empty( $slides ) ) {
			return;
		}
		?>
		<style>
			#<?php echo esc_attr( $slider_id ); ?> {
				position: relative;
				overflow: hidden;
				width: 100%;
				height: <?php echo esc_attr( $height ); ?>px;
				display: flex;
				align-items: center;
				justify-content: center;
				background: #111;
			}
			#<?php echo esc_attr( $slider_id ); ?> .hero-slide {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				opacity: 0;
				transition: opacity 1s ease-in-out;
				display: flex;
				align-items: center;
				justify-content: center;
				text-align: center;
				z-index: 0;
			}
			#<?php echo esc_attr( $slider_id ); ?> .hero-slide.active {
				opacity: 1;
				z-index: 1;
			}
			.hero-slide-bg {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				object-fit: cover;
				z-index: -2;
			}
			.hero-slide-overlay {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background: rgba(0,0,0,0.65);
				z-index: -1;
			}
			.hero-slide-content {
				z-index: 2;
				padding: 20px;
				max-width: 1000px;
			}
			.hero-slide-title {
				color: #fff;
				font-size: clamp(2rem, 5vw, 4rem);
				font-weight: 900;
				margin-bottom: 1rem;
				line-height: 1.2;
				text-transform: uppercase;
				text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
			}
			.hero-slide-subtitle {
				color: var(--color-primary);
				font-size: clamp(1.2rem, 3vw, 2rem);
				font-weight: 700;
				margin-bottom: 1.5rem;
				text-shadow: 1px 1px 5px rgba(0,0,0,0.5);
			}
			.hero-slide-features {
				list-style: none;
				padding: 0;
				margin: 0 0 2.5rem 0;
				color: #fff;
				font-size: 1.2rem;
				display: flex;
				flex-wrap: wrap;
				justify-content: center;
				gap: 15px;
			}
			.hero-slide-features li {
				display: inline-flex;
				align-items: center;
				background: rgba(255, 255, 255, 0.1);
				padding: 8px 15px;
				border-radius: 5px;
				backdrop-filter: blur(5px);
			}
			.hero-slide-features li::before {
				content: '✓';
				color: var(--color-primary);
				font-weight: bold;
				margin-right: 8px;
			}
			.hero-slide-btn {
				display: inline-block;
				background: var(--color-primary);
				color: #fff;
				padding: 15px 40px;
				border-radius: 50px;
				text-decoration: none;
				font-size: 1.1rem;
				font-weight: bold;
				text-transform: uppercase;
				transition: transform 0.3s, background 0.3s, box-shadow 0.3s;
				box-shadow: 0 4px 15px rgba(224, 98, 13, 0.4);
			}
			.hero-slide-btn:hover {
				background: #d05a06;
				color: #fff;
				transform: translateY(-3px);
				box-shadow: 0 8px 25px rgba(224, 98, 13, 0.6);
			}
			
			/* Controls */
			.slider-controls {
				position: absolute;
				top: 50%;
				left: 0;
				width: 100%;
				display: flex;
				justify-content: space-between;
				padding: 0 20px;
				transform: translateY(-50%);
				z-index: 5;
				pointer-events: none;
			}
			.slider-btn {
				background: rgba(255,255,255,0.1);
				border: 1px solid rgba(255,255,255,0.3);
				color: #fff;
				width: 50px;
				height: 50px;
				border-radius: 50%;
				display: flex;
				align-items: center;
				justify-content: center;
				cursor: pointer;
				pointer-events: auto;
				transition: background 0.3s;
				backdrop-filter: blur(5px);
			}
			.slider-btn:hover {
				background: var(--color-primary);
				border-color: var(--color-primary);
			}
		</style>

		<div id="<?php echo esc_attr( $slider_id ); ?>" class="nikabeton-hero-slider">
			<?php foreach ( $slides as $index => $slide ) : ?>
				<div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>">
					<?php 
					$bg_url = !empty($slide['background_image']['url']) ? $slide['background_image']['url'] : ''; 
					if ($bg_url): 
					?>
						<img src="<?php echo esc_url($bg_url); ?>" class="hero-slide-bg" alt="Банер" />
					<?php else: ?>
						<!-- Fallback pattern background if no image is uploaded -->
						<div class="hero-slide-bg" style="background: radial-gradient(circle, #333, #111);"></div>
					<?php endif; ?>
					
					<div class="hero-slide-overlay"></div>
					
					<div class="hero-slide-content">
						<?php if ( ! empty( $slide['title'] ) ) : ?>
							<h1 class="hero-slide-title"><?php echo nl2br( esc_html( $slide['title'] ) ); ?></h1>
						<?php endif; ?>
						
						<?php if ( ! empty( $slide['subtitle'] ) ) : ?>
							<div class="hero-slide-subtitle"><?php echo esc_html( $slide['subtitle'] ); ?></div>
						<?php endif; ?>
						
						<?php if ( ! empty( $slide['features'] ) ) : 
							$features = explode( "\n", $slide['features'] );
						?>
							<ul class="hero-slide-features">
								<?php foreach ( $features as $feature ) : 
									$feature = trim($feature);
									if ( ! empty( $feature ) ) :
								?>
									<li><?php echo esc_html( $feature ); ?></li>
								<?php 
									endif;
								endforeach; ?>
							</ul>
						<?php endif; ?>
						
						<?php if ( ! empty( $slide['button_text'] ) && ! empty( $slide['button_link']['url'] ) ) : ?>
							<a href="<?php echo esc_url( $slide['button_link']['url'] ); ?>" class="hero-slide-btn">
								<?php echo esc_html( $slide['button_text'] ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>

			<?php if ( count($slides) > 1 ): ?>
			<div class="slider-controls">
				<div class="slider-btn prev-btn">❮</div>
				<div class="slider-btn next-btn">❯</div>
			</div>
			<?php endif; ?>
		</div>

		<?php if ( count($slides) > 1 ): ?>
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			var sliderWrapper = document.getElementById('<?php echo esc_js( $slider_id ); ?>');
			if (!sliderWrapper) return;
			
			var slides = sliderWrapper.querySelectorAll('.hero-slide');
			var currentSlide = 0;
			var interval;

			function showSlide(index) {
				slides[currentSlide].classList.remove('active');
				currentSlide = (index + slides.length) % slides.length;
				slides[currentSlide].classList.add('active');
			}

			function nextSlide() { showSlide(currentSlide + 1); }
			function prevSlide() { showSlide(currentSlide - 1); }

			function startAutoplay() {
				interval = setInterval(nextSlide, 5000);
			}
			function stopAutoplay() {
				clearInterval(interval);
			}

			var nextBtn = sliderWrapper.querySelector('.next-btn');
			var prevBtn = sliderWrapper.querySelector('.prev-btn');
			
			if (nextBtn) {
				nextBtn.addEventListener('click', function() {
					nextSlide();
					stopAutoplay();
					startAutoplay();
				});
			}
			if (prevBtn) {
				prevBtn.addEventListener('click', function() {
					prevSlide();
					stopAutoplay();
					startAutoplay();
				});
			}

			// Elementor popup compatibility block
			startAutoplay();
			
			// Optional: Stop autoplay on hover
			sliderWrapper.addEventListener('mouseenter', stopAutoplay);
			sliderWrapper.addEventListener('mouseleave', startAutoplay);
		});
		</script>
		<?php endif; ?>
		<?php
	}
}
