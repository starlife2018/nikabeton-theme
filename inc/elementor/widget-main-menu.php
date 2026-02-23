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
                        <button class="menu-toggle-btn" id="elementor-menu-toggle" aria-label="Toggle Menu">
                            <span></span><span></span><span></span>
                        </button>
                    </div>

                    <!-- Main Menu -->
                    <div class="nav-menu-container" id="elementor-nav-container">
                        <ul class="main-menu-list">
                            <li class="menu-item"><a href="/#services">Послуги</a></li>
                            <li class="menu-item has-dropdown">
                                <a href="/#zones">Зони обслуговування <span class="dropdown-icon">▼</span></a>
                                <ul class="submenu shadow">
                                    <li><a href="/zone/kyiv/">Київ</a></li>
                                    <li><a href="/zone/vyshhorod/">Вишгород</a></li>
                                </ul>
                            </li>
                            <li class="menu-item"><a href="/portfolio/">Портфоліо</a></li>
                            <li class="menu-item"><a href="/#about">Історія компанії</a></li>
                            <li class="menu-item"><a href="/blog/">Блог</a></li>
                            <li class="menu-item has-dropdown">
                                <a href="/#contacts">Контакти <span class="dropdown-icon">▼</span></a>
                                <ul class="submenu shadow">
                                    <li><a href="/contact/kyiv/">Київ</a></li>
                                    <li><a href="/contact/vyshhorod/">Вишгород</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </nav>
            </div>
        </div>

        <style>
            /* Base menu styles */
            .nikabeton-header-menu-widget {
                background-color: var(--color-white);
                border-bottom: 2px solid var(--color-primary);
                width: 100%;
                z-index: 999;
                transition: all 0.3s ease;
            }

            /* Sticky functionality */
            .nikabeton-header-menu-widget.is-sticky {
                position: fixed;
                top: 0;
                left: 0;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                animation: slideDown 0.3s ease-out forwards;
            }
            @keyframes slideDown {
                from { transform: translateY(-100%); }
                to { transform: translateY(0); }
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
                gap: 30px;
            }

            .menu-item {
                position: relative;
            }

            .menu-item > a {
                display: block;
                padding: 20px 0;
                color: var(--color-dark);
                text-decoration: none;
                font-weight: 500;
                font-size: 1.05rem;
                transition: color 0.2s ease;
            }

            .menu-item:hover > a {
                color: var(--color-primary);
            }

            .dropdown-icon {
                font-size: 0.7em;
                margin-left: 4px;
                vertical-align: middle;
            }

            /* Submenu Dropdown */
            .submenu {
                position: absolute;
                top: 100%;
                left: 0;
                background: var(--color-white);
                min-width: 220px;
                list-style: none;
                margin: 0;
                padding: 10px 0;
                opacity: 0;
                visibility: hidden;
                transform: translateY(10px);
                transition: all 0.3s ease;
                z-index: 100;
                border-top: 3px solid var(--color-primary);
            }

            .menu-item.has-dropdown:hover .submenu {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .submenu li a {
                display: block;
                padding: 10px 20px;
                color: var(--color-dark);
                text-decoration: none;
                transition: background 0.2s;
            }

            .submenu li a:hover {
                background: rgba(42, 172, 86, 0.1);
                color: var(--color-primary);
            }

            /* Mobile Menu Styles */
            @media (max-width: 991px) {
                .nikabeton-header-menu-widget {
                    padding: 15px 0;
                }
                
                .mobile-menu-header {
                    display: flex !important;
                    justify-content: space-between;
                    align-items: center;
                }

                .menu-toggle-btn {
                    background: transparent;
                    border: none;
                    cursor: pointer;
                    width: 30px;
                    height: 24px;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    padding: 0;
                }

                .menu-toggle-btn span {
                    display: block;
                    height: 3px;
                    width: 100%;
                    background-color: var(--color-dark);
                    border-radius: 2px;
                    transition: all 0.3s ease;
                }

                .nav-menu-container {
                    display: none;
                    width: 100%;
                    position: absolute;
                    top: 100%;
                    left: 0;
                    background: var(--color-white);
                    padding: 20px 0;
                    box-shadow: 0 10px 15px rgba(0,0,0,0.1); border-top: 1px solid #ebebeb;
                }

                .nav-menu-container.active {
                    display: block;
                }

                .main-menu-list {
                    flex-direction: column;
                    gap: 0;
                }

                .menu-item { border-bottom: 1px solid #f5f5f5; }
                .menu-item:last-child { border-bottom: none; }

                .menu-item > a {
                    padding: 12px 20px;
                }

                .submenu {
                    position: static;
                    opacity: 1;
                    visibility: visible;
                    transform: none;
                    box-shadow: none !important;
                    border-top: none;
                    background: #f9f9f9;
                    display: none;
                }

                .menu-item.has-dropdown.active .submenu {
                    display: block;
                }
                
                .submenu li a { padding-left: 40px; }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Sticky Header Logic
                const menuWidget = document.getElementById('nikabeton-sticky-menu');
                if (menuWidget) {
                    const stickyOffset = menuWidget.offsetTop;

                    window.addEventListener('scroll', function() {
                        if (window.pageYOffset > stickyOffset + 100) {
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
                        navContainer.classList.toggle('active');
                        // Transform hamburger into X (optional visual enhancement)
                        const spans = this.querySelectorAll('span');
                        if (navContainer.classList.contains('active')) {
                            spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                            spans[1].style.opacity = '0';
                            spans[2].style.transform = 'rotate(-45deg) translate(8px, -8px)';
                        } else {
                            spans[0].style.transform = 'none';
                            spans[1].style.opacity = '1';
                            spans[2].style.transform = 'none';
                        }
                    });
                }

                // Mobile Submenu Toggle
                if (window.innerWidth <= 991) {
                    const dropdownItems = document.querySelectorAll('.menu-item.has-dropdown > a');
                    dropdownItems.forEach(item => {
                        item.addEventListener('click', function(e) {
                            e.preventDefault();
                            this.parentElement.classList.toggle('active');
                        });
                    });
                }
            });
        </script>
		<?php
	}
}
