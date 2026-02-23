<?php
/**
 * NikaBeton Projects Grid Widget (Portfolio)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Projects_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'nikabeton_projects_grid';
	}

	public function get_title() {
		return 'Наші Проєкти (NikaBeton)';
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'nikabeton-widgets' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => 'Налаштування Проєктів',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'posts_count',
			[
				'label' => 'Кількість робіт',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 3,
				'max' => 18,
				'step' => 3,
				'default' => 6,
			]
		);

        $this->add_control(
			'widget_desc',
			[
				'label' => 'Опис секції',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Компанія Ніка Бетон готова надати послуги з оренди бетононасосів та доставки бетону й інших будівельних матеріалів по Києву та Вишгороду для будь-яких комерційних, державних чи приватних клієнтів!',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Fetch Categories First
		$categories = get_terms(array(
			'taxonomy' => 'portfolio_category',
			'hide_empty' => true,
		));
		?>
        <section class="projects-widget-section py-section">
            <div class="container text-center mb-4">
                <h2 style="font-weight: 700; margin-bottom: 15px;">НАШІ ПРОЕКТИ</h2>
                <?php if (!empty($settings['widget_desc'])) : ?>
                    <p style="max-width: 800px; margin: 0 auto 30px auto; line-height: 1.6;">
                        <?php echo esc_html($settings['widget_desc']); ?>
                    </p>
                <?php endif; ?>

                <!-- Filters -->
                <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
                <div class="projects-filters" style="display:flex; justify-content:center; gap:10px; flex-wrap:wrap; margin-bottom: 20px;">
                    <button class="project-filter-btn active" data-filter="all">Всі</button>
                    <?php foreach ($categories as $cat) : ?>
                        <button class="project-filter-btn" data-filter="cat-<?php echo esc_attr($cat->term_id); ?>">
                            <?php echo esc_html($cat->name); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Fullwidth Grid -->
            <div class="projects-full-grid" id="nikabeton-projects-grid">
                <?php
                $portfolio_query = new \WP_Query(array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => $settings['posts_count'],
                ));

                if ($portfolio_query->have_posts()) :
                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                        $location = get_post_meta(get_the_ID(), '_portfolio_location', true);
                        $year = get_post_meta(get_the_ID(), '_portfolio_year', true);
                        
                        // Get terms for filtering
                        $post_terms = wp_get_post_terms(get_the_ID(), 'portfolio_category', array('fields' => 'ids'));
                        $term_classes = '';
                        if (!empty($post_terms) && !is_wp_error($post_terms)) {
                            foreach ($post_terms as $term_id) {
                                $term_classes .= ' cat-' . $term_id;
                            }
                        }

                        $bg_image = '';
                        if (has_post_thumbnail()) {
                            $bg_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        } else {
                            $bg_image = get_template_directory_uri() . '/assets/images/placeholder.jpg'; // Basic fallback
                        }

                        $meta_text = array();
                        if ($location) $meta_text[] = $location;
                        if ($year) $meta_text[] = $year;
                        $meta_string = implode(' ', $meta_text);
                        ?>
                        <div class="project-tile project-filterable-item <?php echo esc_attr($term_classes); ?>" 
                             style="background-image: url('<?php echo esc_url($bg_image); ?>');">
                            <a href="<?php the_permalink(); ?>" class="project-tile-link">
                                <div class="project-tile-overlay"></div>
                                <div class="project-tile-content">
                                    <?php if($meta_string): ?>
                                        <div class="project-meta text-uppercase text-white text-sm mb-1"><?php echo esc_html($meta_string); ?></div>
                                    <?php endif; ?>
                                    <h3 class="project-title text-primary m-0"><?php the_title(); ?></h3>
                                </div>
                            </a>
                        </div>
                    <?php 
                    endwhile; wp_reset_postdata(); 
                else: 
                ?>
                    <p class="text-center" style="width:100%; grid-column:1/-1;">Проєкти ще не додані. Додайте їх в меню "Портфоліо робіт".</p>
                <?php endif; ?>
            </div>

            <style>
                .projects-widget-section {
                    padding-bottom: 0; /* Let grid touch the bottom if it's the last element */
                }
                .project-filter-btn {
                    padding: 10px 20px;
                    border: none;
                    background: transparent;
                    font-weight: 700;
                    text-transform: uppercase;
                    font-size: 0.9rem;
                    cursor: pointer;
                    color: var(--color-dark);
                    transition: all 0.3s ease;
                }
                .project-filter-btn:hover,
                .project-filter-btn.active {
                    background-color: var(--color-primary);
                    color: var(--color-dark);
                }
                
                .projects-full-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    width: 100%;
                    gap: 0;
                }
                .project-tile {
                    position: relative;
                    aspect-ratio: 4/3;
                    background-size: cover;
                    background-position: center;
                    overflow: hidden;
                    transition: all 0.4s ease;
                }
                .project-tile-link {
                    display: block;
                    width: 100%;
                    height: 100%;
                    text-decoration: none;
                }
                .project-tile-overlay {
                    position: absolute;
                    top: 0; left: 0; right: 0; bottom: 0;
                    background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0) 100%);
                    opacity: 0.8;
                    transition: opacity 0.3s ease;
                }
                .project-tile:hover .project-tile-overlay {
                    opacity: 0.95;
                }
                .project-tile-content {
                    position: absolute;
                    bottom: 30px;
                    left: 30px;
                    right: 30px;
                    z-index: 2;
                    text-align: left;
                    transform: translateY(10px);
                    transition: transform 0.3s ease;
                }
                .project-tile:hover .project-tile-content {
                    transform: translateY(0);
                }
                .project-title {
                    font-size: 1.5rem;
                    font-weight: 700;
                    text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
                }
                .project-meta {
                    letter-spacing: 1px;
                    font-weight: 600;
                }

                @media (max-width: 992px) {
                    .projects-full-grid { grid-template-columns: repeat(2, 1fr); }
                }
                @media (max-width: 576px) {
                    .projects-full-grid { grid-template-columns: 1fr; }
                    .project-tile { aspect-ratio: inherit; height: 300px; }
                }

                /* Hiding non-matching items */
                .project-filterable-item.filtered-out {
                    display: none;
                }
            </style>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const filterBtns = document.querySelectorAll('.project-filter-btn');
                const items = document.querySelectorAll('.project-filterable-item');

                filterBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        // Remove active class
                        filterBtns.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');

                        const filterValue = this.getAttribute('data-filter');

                        items.forEach(item => {
                            if (filterValue === 'all') {
                                item.classList.remove('filtered-out');
                            } else {
                                if (item.classList.contains(filterValue)) {
                                    item.classList.remove('filtered-out');
                                } else {
                                    item.classList.add('filtered-out');
                                }
                            }
                        });
                    });
                });
            });
            </script>
        </section>
		<?php
	}
}
