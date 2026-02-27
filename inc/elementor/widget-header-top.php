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
        $this->add_control(
			'link_youtube',
			[
				'label' => 'YouTube посилання',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
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
                            <span class="logo-text">Ніка<span>Бетон</span></span>
                        </a>
                    </div>

                    <!-- Right Side Container -->
                    <div class="header-right-side">
                        
                        <!-- Addresses -->
                        <div class="header-pill header-address-area">
                            <div class="info-icon"><i class="dashicons dashicons-location"></i></div>
                            <div class="info-content">
                                <?php if(!empty($settings['address_1'])): ?>
                                    <div><a href="/#zones" class="header-text-link"><?php echo esc_html($settings['address_1']); ?></a></div>
                                <?php endif; ?>
                                <?php if(!empty($settings['address_2'])): ?>
                                    <div><a href="/#zones" class="header-text-link"><?php echo esc_html($settings['address_2']); ?></a></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Work Hours -->
                        <div class="header-pill header-hours-area">
                            <div class="info-icon"><i class="dashicons dashicons-clock"></i></div>
                            <div class="info-content">
                                <?php if(!empty($settings['hours_weekdays'])): ?>
                                    <div style="font-weight: 500; font-size:0.85rem;"><?php echo esc_html($settings['hours_weekdays']); ?></div>
                                <?php endif; ?>
                                <?php if(!empty($settings['hours_weekends'])): ?>
                                    <div style="color:var(--text-luxury-muted); font-size:0.75rem;"><?php echo esc_html($settings['hours_weekends']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Phone & Messengers -->
                        <div class="header-pill header-contact-area">
                            <div class="info-icon"><i class="dashicons dashicons-phone"></i></div>
                            <div class="info-content" style="display:flex; align-items:center;">
                                <a href="tel:<?php echo esc_attr($settings['phone_link']); ?>" class="header-phone">
                                    <?php echo esc_html($settings['phone_display']); ?>
                                </a>
                                <div class="header-messengers">
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
                                    <?php if(!empty($settings['link_youtube'])): ?>
                                        <a href="<?php echo esc_url($settings['link_youtube']); ?>" target="_blank" title="YouTube" class="messenger-pulse">
                                            <div class="msg-icon msg-youtube">
                                                <svg viewBox="0 0 576 512" style="width: 12px; height: 12px; fill: currentColor;"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>
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
                :root {
                    --bg-luxury-dark: #121212;
                    --bg-pill: rgba(255, 255, 255, 0.05);
                    --bg-pill-hover: rgba(255, 255, 255, 0.1);
                    --border-pill: rgba(255, 255, 255, 0.08);
                    --text-luxury-light: #e0e0e0;
                    --text-luxury-muted: #888888;
                }

                .nikabeton-header-top {
                    background: var(--bg-luxury-dark);
                    padding: 8px 0;
                    border-bottom: 1px solid rgba(255,255,255,0.05);
                    color: var(--text-luxury-light);
                    font-family: inherit;
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
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }

                .logo-text {
                    font-size: 1.6rem;
                    font-weight: 800;
                    line-height: 1;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    background: linear-gradient(135deg, #ffffff 0%, #aaaaaa 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                }

                .logo-text span {
                    color: var(--color-primary);
                    -webkit-text-fill-color: var(--color-primary);
                }

                .header-right-side {
                    display: flex;
                    align-items: center;
                    gap: 15px;
                }

                .header-pill {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    background: var(--bg-pill);
                    border: 1px solid var(--border-pill);
                    padding: 6px 16px;
                    border-radius: 50px;
                    backdrop-filter: blur(10px);
                    -webkit-backdrop-filter: blur(10px);
                    transition: all 0.3s ease;
                }

                .header-pill:hover {
                    background: var(--bg-pill-hover);
                    border-color: rgba(255,255,255,0.15);
                    transform: translateY(-1px);
                }

                .info-icon {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: var(--color-primary);
                }
                
                .info-icon .dashicons {
                    font-size: 1.1rem;
                    width: 1.1rem;
                    height: 1.1rem;
                }

                .info-content {
                    font-size: 0.8rem;
                    line-height: 1.3;
                    letter-spacing: 0.3px;
                }

                .info-content div {
                    white-space: nowrap;
                }

                .header-text-link {
                    color: var(--text-luxury-light);
                    text-decoration: none;
                    transition: color 0.2s ease;
                }
                
                .header-text-link:hover {
                    color: var(--color-primary);
                }

                .header-contact-area {
                    background: rgba(248, 126, 0, 0.08); /* slight primary tint */
                    border-color: rgba(248, 126, 0, 0.2);
                }

                .header-contact-area:hover {
                    background: rgba(248, 126, 0, 0.15);
                    border-color: rgba(248, 126, 0, 0.4);
                }

                .header-phone {
                    font-size: 1.1rem;
                    font-weight: 700;
                    color: #ffffff;
                    text-decoration: none;
                    transition: color 0.2s ease;
                    letter-spacing: 0.5px;
                    display: block;
                }

                .header-phone:hover {
                    color: var(--color-primary);
                }

                .header-messengers {
                    display: flex;
                    gap: 8px;
                    margin-left: 5px;
                    border-left: 1px solid rgba(255,255,255,0.1);
                    padding-left: 12px;
                }

                .messenger-pulse {
                    display: inline-block;
                    transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                }
                
                .messenger-pulse:hover {
                    transform: scale(1.2) translateY(-2px);
                }

                .msg-icon {
                    width: 22px;
                    height: 22px;
                    border-radius: 5px; /* slighly rounded squares for luxury look */
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #fff;
                    opacity: 0.85;
                    transition: opacity 0.2s ease;
                }

                .messenger-pulse:hover .msg-icon {
                    opacity: 1;
                }
                
                .msg-viber { background: linear-gradient(135deg, #8f5db7, #7360f2); }
                .msg-telegram { background: linear-gradient(135deg, #38c2ff, #2AABEE); }
                .msg-whatsapp { background: linear-gradient(135deg, #4aec7b, #25D366); }
                .msg-youtube { background: linear-gradient(135deg, #ff4b4b, #FF0000); }

                /* Responsiveness */
                @media (max-width: 1024px) {
                    .header-top-flex { gap: 10px; }
                    .header-address-area .info-content,
                    .header-hours-area .info-content { display: none; } /* Hide text, keep icons */
                    .header-pill { padding: 8px; border-radius: 50%; width: 36px; height: 36px; justify-content: center; cursor: pointer; }
                    .header-contact-area { border-radius: 50px; width: auto; justify-content: space-between; padding: 6px 12px 6px 16px; }
                    .header-contact-area .info-icon { display: none; }
                }

                @media (max-width: 576px) {
                    .header-top-flex {
                        flex-wrap: wrap;
                        justify-content: center;
                        gap: 10px;
                        padding-bottom: 5px;
                    }
                    .header-right-side {
                        width: 100%;
                        justify-content: center;
                    }
                    .header-contact-area {
                        width: 100%;
                        justify-content: center;
                    }
                    .header-pill.header-address-area,
                    .header-pill.header-hours-area {
                        display: none; /* Hide purely informational pills on tiny screens to save space */
                    }
                    .logo-text { font-size: 1.4rem; }
                    .header-phone { font-size: 1.05rem; }
                    .header-messengers { padding-left: 10px; gap: 8px; margin-left: 0; }
                    .msg-icon { width: 24px; height: 24px; border-radius: 4px; }
                }
            </style>
        </div>
		<?php
	}
}
