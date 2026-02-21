<?php
/**
 * Template Name: Портфоліо
 *
 * @package NIKABETON
 */

get_header();
?>

	<main id="primary" class="site-main">
        
        <!-- Header banner -->
        <header class="page-header py-section text-center text-white" style="background: var(--gradient-primary); padding-top: 4rem; padding-bottom: 4rem;">
            <div class="container">
                <h1 class="page-title text-white" style="margin: 0;"><?php the_title(); ?></h1>
            </div>
        </header>

        <section class="portfolio-section py-section" style="background: var(--color-light);">
            <div class="container" style="padding-top: 3rem; padding-bottom: 3rem;">
                
                <?php
                // Display the page content (e.g. Intro text added via Editor)
                while ( have_posts() ) :
                    the_post();
                    if ( get_the_content() ) {
                        echo '<div class="page-content mb-5 text-center" style="font-size: 1.1rem; line-height: 1.6; max-width:800px; margin: 0 auto;">';
                        the_content();
                        echo '</div>';
                    }
                endwhile;
                ?>

                <!-- Portfolio Grid -->
                <div class="grid grid-3 portfolio-grid mt-4">
                    <?php
                    // Query Portfolio custom post type
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $portfolio_args = array(
                        'post_type'      => 'portfolio',
                        'posts_per_page' => 12,
                        'paged'          => $paged,
                    );
                    $portfolio_query = new WP_Query( $portfolio_args );

                    if ( $portfolio_query->have_posts() ) :
                        while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
                            $location = get_post_meta(get_the_ID(), '_portfolio_location', true);
                            ?>
                            <div class="portfolio-item hover-scale shadow border-radius overflow-hidden" style="position:relative; background:var(--color-white); transition: all 0.3s ease;">
                                <a href="<?php the_permalink(); ?>" style="display:block; text-decoration:none; color:inherit;">
                                    <div class="portfolio-image" style="height: 250px; overflow:hidden;">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('large', ['style' => 'width:100%; height:100%; object-fit:cover; display:block;']); ?>
                                        <?php else: ?>
                                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#eee; color:#aaa;">Немає фото</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="portfolio-content p-4">
                                        <h3 class="mb-2" style="font-size:1.25rem; font-weight: 700; color: var(--color-darker);"><?php the_title(); ?></h3>
                                        <?php if($location): ?>
                                            <div class="text-sm text-muted mb-3"><i class="dashicons dashicons-location"></i> <?php echo esc_html($location); ?></div>
                                        <?php endif; ?>
                                        <span class="btn-link text-sm" style="color:var(--color-primary); font-weight:bold; letter-spacing: 0.5px;">Переглянути проєкт &rarr;</span>
                                    </div>
                                </a>
                            </div>
                        <?php 
                        endwhile; 
                        ?>
                </div>

                <!-- Custom Pagination -->
                <div class="pagination mt-5 text-center">
                    <?php 
                        echo paginate_links( array(
                            'total'        => $portfolio_query->max_num_pages,
                            'current'      => max( 1, get_query_var( 'paged' ) ),
                            'prev_text'    => '&laquo; Попередня',
                            'next_text'    => 'Наступна &raquo;',
                        ) );
                    ?>
                </div>

                    <?php
                        wp_reset_postdata();
                    else :
                        echo '<p class="text-center w-100" style="grid-column: 1/-1; padding: 3rem; background: var(--color-white); border-radius: var(--border-radius);">Проєкти ще не додані. Скоро тут з’являться наші роботи.</p>';
                    endif; 
                    ?>

            </div>
        </section>

	</main><!-- #main -->

<?php
get_footer();
