<?php
/**
 * NikaBeton Header Top Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Header_Top_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'nikabeton_header_top';
	}

	public function get_title() {
		return 'Шапка: Верхній блок (NikaBeton)';
	}

	public function get_icon() {
		return 'eicon-header';
	}

	public function get_categories() {
		return [ 'nikabeton-widgets' ];
	}

	protected function register_controls() {
		
        $this->start_controls_section(
			'content_section',
			[
				'label' => 'Налаштування Контактів',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        // Phone
        $this->add_control(
			'phone_display',
			[
				'label' => 'Телефон (для відображення)',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '050-382-4812',
			]
		);
        $this->add_control(
			'phone_link',
			[
				'label' => 'Телефон (для посилання)',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '+380503824812',
                'description' => 'Без пробілів та тире, наприклад: +380501234567'
			]
		);

        // Social Links
        $this->add_control(
			'link_viber',
			[
				'label' => 'Viber посилання',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'viber://chat?number=%2B380503824812',
			]
		);
        $this->add_control(
			'link_telegram',
			[
				'label' => 'Telegram посилання',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'https://t.me/NikaBeton',
			]
		);
        $this->add_control(
			'link_whatsapp',
			[
				'label' => 'WhatsApp посилання',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'https://wa.me/380503824812',
			]
		);

        // Work Hours
        $this->add_control(
			'hours_weekdays',
			[
				'label' => 'Години роботи (Пн-Пт)',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Пн-Пт: 8:00-20:00',
			]
		);
        $this->add_control(
			'hours_weekends',
			[
				'label' => 'Години роботи (Сб-Нд)',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Сб-Нд: 9:00-18:00',
			]
		);

        // Addresses
        $this->add_control(
			'address_1',
			[
				'label' => 'Адреса 1',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Вул. Набережна, 7Є, Вишгород',
			]
		);
        $this->add_control(
			'address_2',
			[
				'label' => 'Адреса 2',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Вул. Йорданська, 18, Київ',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();
		?>
        <div class="nikabeton-header-top">
            <div class="container pb-0">
                <div class="header-top-flex">
                    
                    <!-- Logo Area -->
                    <div class="header-logo-area">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
                            <span class="logo-text text-primary">Ніка<br>Бетон</span>
                        </a>
                        <div class="logo-alt-text text-muted text-xs mt-1">
                            Виробництво та<br>доставка бетону
                        </div>
                    </div>

                    <!-- Right Side Container -->
                    <div class="header-right-side">
                        
                        <!-- Addresses -->
                        <div class="header-info-block header-address-area">
                            <div class="info-icon text-primary"><i class="dashicons dashicons-location"></i></div>
                            <div class="info-content">
                                <?php if(!empty($settings['address_1'])): ?>
                                    <div><a href="/#zones" class="header-text-link"><?php echo esc_html($settings['address_1']); ?></a></div>
                                <?php endif; ?>
                                <?php if(!empty($settings['address_2'])): ?>
                                    <div><a href="/#zones" class="header-text-link"><?php echo esc_html($settings['address_2']); ?></a></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="header-divider"></div>

                        <!-- Work Hours -->
                        <div class="header-info-block header-hours-area">
                            <div class="info-icon text-primary"><i class="dashicons dashicons-clock"></i></div>
                            <div class="info-content">
                                <?php if(!empty($settings['hours_weekdays'])): ?>
                                    <div style="font-weight: 500;"><?php echo esc_html($settings['hours_weekdays']); ?></div>
                                <?php endif; ?>
                                <?php if(!empty($settings['hours_weekends'])): ?>
                                    <div style="font-weight: 500;"><?php echo esc_html($settings['hours_weekends']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="header-divider"></div>

                        <!-- Phone & Messengers -->
                        <div class="header-info-block header-contact-area">
                            <div class="info-icon text-primary" style="font-size: 1.4rem; padding-top:2px;">&#9990;</div>
                            <div class="info-content">
                                <a href="tel:<?php echo esc_attr($settings['phone_link']); ?>" class="header-phone">
                                    <?php echo esc_html($settings['phone_display']); ?>
                                </a>
                                <div class="header-messengers mt-1">
                                    <?php if(!empty($settings['link_viber'])): ?>
                                        <a href="<?php echo esc_url($settings['link_viber']); ?>" target="_blank" title="Viber" class="messenger-pulse">
                                            <div class="msg-icon msg-viber">
                                                <svg viewBox="0 0 512 512" style="width: 12px; height: 12px; fill: currentColor;"><path d="M436.4 135c-23.8-31.5-59.5-51.4-100.8-56-30.8-3.4-62.8-1.5-93.5 6.6-47.5 12.6-90 44-116.5 87-21.7 34.6-28.8 77.2-20.7 116.6 6 29 21.6 55.4 44 76 6.3 5.4 9 13.5 7.4 21.6l-10 50.8c-1.6 8.5 7.4 15.3 15.2 11.5l55.8-27.4c7.6-3.7 16.4-3.7 24 0 25 12.4 52.8 19 81.3 19 41.5 0 81-15 112.5-42.5 35.8-31 58.6-76 62.6-125C502.2 220.5 476 172 436.4 135zm-59 131.5c-4 12-19.6 19.3-31 16-11.4-3.3-15-18.7-11-30.7 4-12 19.6-19.3 31-16 11.4 3.3 14.8 18.7 11 30.7z"/></svg>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if(!empty($settings['link_telegram'])): ?>
                                        <a href="<?php echo esc_url($settings['link_telegram']); ?>" target="_blank" title="Telegram" class="messenger-pulse">
                                            <div class="msg-icon msg-telegram">
                                                <svg viewBox="0 0 512 512" style="width: 12px; height: 12px; fill: currentColor; margin-right:1px;"><path d="M473 70l-80 376c-6 26-21 32-43 20l-118-87-57 55c-6 6-12 12-24 12l8-120 219-198c9-8-2-12-14-4l-271 170-117-37c-25-8-26-25 5-37L448 45c21-8 39 5 25 25z"/></svg>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                    <?php if(!empty($settings['link_whatsapp'])): ?>
                                        <a href="<?php echo esc_url($settings['link_whatsapp']); ?>" target="_blank" title="WhatsApp" class="messenger-pulse">
                                            <div class="msg-icon msg-whatsapp">
                                                <svg viewBox="0 0 448 512" style="width: 12px; height: 12px; fill: currentColor;"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zM224 430.7h-.1c-33.1-.1-65.5-8.9-94-25.7l-6.7-4-69.9 18.3L72 351.1l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.1 0-101.9 82.9-184.8 184.8-184.8 49.3 0 95.7 19.2 130.6 54.1 34.9 34.9 54.1 81.3 54.1 130.7.1 101.9-82.8 184.7-184.8 184.7z"/></svg>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
            
            <style>
                .nikabeton-header-top {
                    background: var(--color-white);
                    padding: 12px 0;
                    border-bottom: 1px solid var(--color-border);
                }
                
                .header-top-flex {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .header-logo-area {
                    flex-shrink: 0;
                }
                
                .logo-link {
                    text-decoration: none;
                }

                .logo-text {
                    font-size: 2.2rem;
                    font-weight: 900;
                    line-height: 0.9;
                    text-transform: uppercase;
                    letter-spacing: -1px;
                }

                .logo-alt-text {
                    line-height: 1.2;
                    letter-spacing: 0.5px;
                }

                .header-right-side {
                    display: flex;
                    align-items: center;
                    gap: 25px;
                }

                .header-divider {
                    width: 1px;
                    height: 40px;
                    background-color: var(--color-border);
                }

                .header-info-block {
                    display: flex;
                    align-items: flex-start;
                    gap: 10px;
                }

                .info-icon {
                    margin-top: 3px;
                }
                
                .info-icon .dashicons {
                    font-size: 1.2rem;
                    width: 1.2rem;
                    height: 1.2rem;
                }

                .info-content {
                    font-size: 0.85rem;
                    line-height: 1.4;
                    color: var(--color-text-main);
                }

                .header-text-link {
                    color: var(--color-text-main);
                    text-decoration: none;
                    transition: color 0.2s ease;
                }
                
                .header-text-link:hover {
                    color: var(--color-primary);
                }

                .header-phone {
                    font-size: 1.3rem;
                    font-weight: 800;
                    color: var(--color-dark);
                    text-decoration: none;
                    transition: color 0.2s ease;
                    letter-spacing: 0.5px;
                    display: block;
                    line-height: 1;
                }

                .header-phone:hover {
                    color: var(--color-primary);
                }

                .header-messengers {
                    display: flex;
                    gap: 6px;
                }

                .messenger-pulse {
                    display: inline-block;
                    transition: transform 0.2s ease;
                }
                
                .messenger-pulse:hover {
                    transform: scale(1.15);
                }

                .msg-icon {
                    width: 24px;
                    height: 24px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #fff;
                }
                
                .msg-viber { background: #7360f2; }
                .msg-telegram { background: #2AABEE; }
                .msg-whatsapp { background: #25D366; }

                /* Responsiveness */
                @media (max-width: 1100px) {
                    .header-top-flex { flex-direction: column; gap: 15px; }
                    .header-logo-area { text-align: center; }
                    .header-right-side { flex-wrap: wrap; justify-content: center; }
                    .header-divider { display: none; }
                }

                @media (max-width: 576px) {
                    .nikabeton-header-top {
                        display: none; /* Mobile completely hides top bar, uses Main Menu instead */
                    }
                }
            </style>
        </div>
		<?php
	}
}
