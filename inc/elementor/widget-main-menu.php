<?php
/**
 * NikaBeton Main Menu Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Main_Menu_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'nikabeton_main_menu';
	}

	public function get_title() {
		return 'Шапка: Головне Меню (NikaBeton)';
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return [ 'nikabeton-widgets' ];
	}

	protected function register_controls() {
        // Option to select WordPress Menu could be added here.
        // For this implementation, we will use the theme's primary menu location if available,
        // or fallback to the hardcoded structure from the design doc.
	}

	protected function render() {
		?>
        <div class="nikabeton-header-menu-widget" id="nikabeton-sticky-menu">
            <div class="container">
                <nav class="main-navigation-elementor">
                    
                    <!-- Mobile Header (Logo + Hamburger) -->
                    <div class="mobile-menu-header d-none" style="display: none;">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-logo" style="text-decoration:none;">
                            <span class="text-primary" style="font-size: 1.5rem; font-weight: 900;">НікаБетон</span>
                        </a>
                        
                        <div class="mobile-header-actions">
                            <a href="tel:+380503824812" class="mobile-phone-link">
                                <i class="dashicons dashicons-phone"></i> 050-382-48-12
                            </a>   
                            <button class="menu-toggle-btn" id="elementor-menu-toggle" aria-label="Toggle Menu">
                                <span></span><span></span><span></span>
                            </button>
                        </div>
                    </div>

                    <!-- Main Menu -->
                    <div class="nav-menu-container" id="elementor-nav-container">
                        <ul class="main-menu-list">
                            <li class="menu-item"><a href="/beton/">Бетон</a></li>
                            <li class="menu-item"><a href="/service/">Послуги</a></li>
                            <li class="menu-item has-dropdown">
                                <a href="/zone/">Зони обслуговування <span class="dropdown-icon">▼</span></a>
                                <ul class="submenu shadow">
                                    <li><a href="/zone/kyiv/">Київ</a></li>
                                    <li><a href="/zone/vyshhorod/">Вишгород</a></li>
                                </ul>
                            </li>
                            <li class="menu-item"><a href="/portfolio/">Портфоліо</a></li>
                            <li class="menu-item"><a href="/about/">Історія компанії</a></li>
                            <li class="menu-item"><a href="/blog/">Блог</a></li>
                            <li class="menu-item"><a href="/contact/">Контакти</a></li>
                            <!--<li class="menu-item has-dropdown">
                                <a href="/contact/">Контакти <span class="dropdown-icon">▼</span></a>
                                <ul class="submenu shadow">
                                    <li><a href="/contact/kyiv/">Київ</a></li>
                                    <li><a href="/contact/vyshhorod/">Вишгород</a></li>
                                </ul>
                            </li>-->
                        </ul>
                    </div>

                </nav>
            </div>
        </div>

        <style>
            :root {
                --menu-text-color: #333333;
                --menu-hover-color: var(--color-primary);
                --menu-bg-color: #ffffff;
                --dropdown-bg: #ffffff;
                --shadow-soft: 0 10px 30px rgba(0, 0, 0, 0.08);
                --shadow-sticky: 0 4px 20px rgba(0, 0, 0, 0.05);
            }

            /* Base menu styles */
            .nikabeton-header-menu-widget {
                background-color: var(--menu-bg-color);
                width: 100%;
                z-index: 999;
                transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
                border-bottom: 1px solid rgba(0,0,0,0.05);
            }

            /* Sticky functionality */
            .nikabeton-header-menu-widget.is-sticky {
                position: fixed;
                top: 0;
                left: 0;
                box-shadow: var(--shadow-sticky);
                animation: slideDown 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
                background-color: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }
            
            @keyframes slideDown {
                from { transform: translateY(-100%); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            .main-navigation-elementor {
                position: relative;
            }

            .main-menu-list {
                list-style: none;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                gap: 40px; /* increased gap for premium feel */
            }

            .menu-item {
                position: relative;
            }

            .menu-item > a {
                display: block;
                padding: 24px 0;
                color: var(--menu-text-color);
                text-decoration: none;
                font-weight: 600;
                font-size: 0.95rem;
                text-transform: uppercase;
                letter-spacing: 1px;
                transition: color 0.3s ease;
                position: relative;
            }

            /* Underline Hover Effect */
            .menu-item > a::after {
                content: '';
                position: absolute;
                width: 0;
                height: 2px;
                display: block;
                margin-top: 5px;
                right: 0;
                background: var(--color-primary);
                transition: width 0.3s ease;
                -webkit-transition: width 0.3s ease;
            }

            .menu-item:hover > a {
                color: var(--menu-hover-color);
            }
            
            .menu-item:hover > a::after {
                width: 100%;
                left: 0;
                background: var(--color-primary);
            }

            .dropdown-icon {
                font-size: 0.6em;
                margin-left: 6px;
                vertical-align: middle;
                transition: transform 0.3s ease;
                display: inline-block;
                line-height: 1; /* prevent height shift on rotation */
            }
            
            .menu-item.has-dropdown:hover .dropdown-icon {
                transform: rotate(180deg);
                color: var(--color-primary);
            }

            /* Submenu Dropdown */
            .submenu {
                position: absolute;
                top: 100%;
                left: 50%;
                transform: translateX(-50%) translateY(15px);
                background: var(--dropdown-bg);
                min-width: 240px;
                list-style: none;
                margin: 0;
                padding: 15px 0;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
                z-index: 100;
                border-radius: 8px;
                box-shadow: var(--shadow-soft);
                border: 1px solid rgba(0,0,0,0.03);
            }

            /* Invisible bridge to prevent hover loss */
            .menu-item.has-dropdown::before {
                content: '';
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                height: 20px;
                background: transparent;
                z-index: 99;
            }

            .menu-item.has-dropdown:hover .submenu {
                opacity: 1;
                visibility: visible;
                transform: translateX(-50%) translateY(0);
            }

            .submenu li {
                padding: 0 10px;
            }

            .submenu li a {
                display: block;
                padding: 12px 20px;
                color: #555555;
                text-decoration: none;
                transition: all 0.2s ease;
                font-size: 0.95rem;
                font-weight: 500;
                border-radius: 6px;
            }

            .submenu li a:hover {
                background: rgba(248, 126, 0, 0.05); /* very light primary */
                color: var(--color-primary);
                padding-left: 25px; /* Alternative to transform for safe slight indentation, removing 5px from right if needed, but padding-left override works */
            }

            /* Mobile Menu Styles */
            @media (max-width: 991px) {
                .nikabeton-header-menu-widget {
                    padding: 12px 0;
                    border-bottom: 0;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                }
                
                .mobile-menu-header {
                    display: flex !important;
                    justify-content: space-between;
                    align-items: center;
                }

                .mobile-header-actions {
                    display: flex;
                    align-items: center;
                    gap: 15px;
                }

                .mobile-phone-link {
                    color: var(--color-primary, #f87e00);
                    text-decoration: none;
                    font-size: 1.05rem;
                    font-weight: 700;
                    display: flex;
                    align-items: center;
                    gap: 4px;
                }

                .mobile-phone-link i {
                    font-size: 1.1rem;
                    width: 1.1rem;
                    height: 1.1rem;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .mobile-logo span {
                    background: linear-gradient(135deg, #333 0%, #111 100%);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    letter-spacing: 0.5px;
                }
                
                .mobile-logo span span {
                    color: var(--color-primary);
                    -webkit-text-fill-color: var(--color-primary);
                }

                /* Animated Hamburger */
                .menu-toggle-btn {
                    background: transparent;
                    border: none;
                    cursor: pointer;
                    width: 30px;
                    height: 22px;
                    position: relative;
                    padding: 0;
                    z-index: 1001; /* Above mobile menu */
                }

                .menu-toggle-btn span {
                    display: block;
                    position: absolute;
                    height: 2px;
                    width: 100%;
                    background-color: var(--color-dark);
                    border-radius: 2px;
                    opacity: 1;
                    left: 0;
                    transform: rotate(0deg);
                    transition: .25s ease-in-out;
                }

                .menu-toggle-btn span:nth-child(1) { top: 0px; }
                .menu-toggle-btn span:nth-child(2) { top: 10px; }
                .menu-toggle-btn span:nth-child(3) { top: 20px; }

                /* Hamburger active state (X) */
                .menu-toggle-btn.open span:nth-child(1) {
                    top: 10px;
                    transform: rotate(135deg);
                }
                .menu-toggle-btn.open span:nth-child(2) {
                    opacity: 0;
                    left: -60px;
                }
                .menu-toggle-btn.open span:nth-child(3) {
                    top: 10px;
                    transform: rotate(-135deg);
                }

                .nav-menu-container {
                    display: block; /* Setup for slide animation */
                    position: absolute;
                    top: 100%;
                    left: 0;
                    width: 100%;
                    background: var(--color-white);
                    padding: 0;
                    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
                    border-top: 1px solid rgba(0,0,0,0.05);
                    /* Slide down animation setup */
                    max-height: 0;
                    overflow: hidden;
                    transition: max-height 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
                }

                .nav-menu-container.active {
                    max-height: 800px; /* arbitrary large max-height for transition */
                }

                .main-menu-list {
                    flex-direction: column;
                    gap: 0;
                    padding: 10px 0 20px 0;
                }

                .menu-item > a {
                    padding: 16px 20px;
                    font-size: 1.1rem;
                    border-bottom: 1px solid rgba(0,0,0,0.03);
                }
                
                .menu-item > a::after { display: none; } /* NO underline on mobile */

                .submenu {
                    position: static;
                    opacity: 1;
                    visibility: visible;
                    transform: none;
                    box-shadow: none !important;
                    border: none;
                    background: #fafafa;
                    display: none; /* simple toggle for mobile */
                    padding: 0;
                    width: 100%;
                }

                .menu-item.has-dropdown.active .submenu {
                    display: block;
                }
                
                .submenu li a { 
                    padding: 14px 20px 14px 40px; 
                    font-size: 1rem;
                    border-bottom: 1px solid rgba(0,0,0,0.02);
                    border-radius: 0;
                }
                .submenu li a:hover { transform: none; }
            }

            @media (max-width: 480px) {
                .mobile-logo span { font-size: 1.3rem !important; }
                .mobile-phone-link { font-size: 0.95rem; }
                .mobile-header-actions { gap: 10px; }
            }

            @media (max-width: 360px) {
                .mobile-logo span { font-size: 1.1rem !important; }
                .mobile-phone-link { font-size: 0.85rem; }
                .mobile-phone-link i { font-size: 0.9rem; width: 0.9rem; height: 0.9rem; }
                .mobile-header-actions { gap: 8px; }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Sticky Header Logic
                const menuWidget = document.getElementById('nikabeton-sticky-menu');
                if (menuWidget) {
                    const stickyOffset = menuWidget.offsetTop;

                    window.addEventListener('scroll', function() {
                        if (window.pageYOffset > stickyOffset + 50) {
                            menuWidget.classList.add('is-sticky');
                            // To prevent jumping content, add padding to body equal to menu height
                            document.body.style.paddingTop = menuWidget.offsetHeight + 'px';
                        } else {
                            menuWidget.classList.remove('is-sticky');
                            document.body.style.paddingTop = 0;
                        }
                    });
                }

                // Mobile Menu Toggle
                const toggleBtn = document.getElementById('elementor-menu-toggle');
                const navContainer = document.getElementById('elementor-nav-container');

                if (toggleBtn && navContainer) {
                    toggleBtn.addEventListener('click', function() {
                        this.classList.toggle('open'); // triggers X animation
                        navContainer.classList.toggle('active'); // triggers slide down
                    });
                }

                // Mobile Submenu Toggle
                if (window.innerWidth <= 991) {
                    const dropdownItems = document.querySelectorAll('.menu-item.has-dropdown > a');
                    dropdownItems.forEach(item => {
                        item.addEventListener('click', function(e) {
                            e.preventDefault();
                            this.parentElement.classList.toggle('active');
                            
                            // Rotate chevron for mobile
                            const icon = this.querySelector('.dropdown-icon');
                            if(icon) {
                                if(this.parentElement.classList.contains('active')) {
                                    icon.style.transform = 'rotate(180deg)';
                                    icon.style.color = 'var(--color-primary)';
                                } else {
                                    icon.style.transform = 'rotate(0deg)';
                                    icon.style.color = 'inherit';
                                }
                            }
                        });
                    });
                }
            });
        </script>
		<?php
	}
}
