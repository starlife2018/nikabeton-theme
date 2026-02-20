<?php
/**
 * The template for displaying portfolio archives
 *
 * @package NIKABETON
 */

get_header();
?>

	<main id="primary" class="site-main">
        <header class="page-header bg-dark text-white py-section text-center">
            <div class="container">
                <h1 class="page-title">Наші Роботи</h1>
                <p class="mt-2 text-muted">Приклади виконаних об'єктів та заливок</p>
            </div>
        </header>

        <div class="container py-content" style="min-height:50vh;">
            <?php if ( have_posts() ) : ?>
                <div class="grid grid-3 portfolio-grid mt-4">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        
                        $location = get_post_meta(get_the_ID(), '_portfolio_location', true);
                        ?>
                        <div class="portfolio-item hover-scale shadow border-radius overflow-hidden" style="position:relative; background:var(--color-white);">
                            <a href="<?php the_permalink(); ?>" style="display:block; text-decoration:none; color:inherit;">
                                <div class="portfolio-image" style="height: 250px; overflow:hidden;">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('large', ['style' => 'width:100%; height:100%; object-fit:cover; display:block;']); ?>
                                    <?php else: ?>
                                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#eee; color:#aaa;">Немає фото</div>
                                    <?php endif; ?>
                                </div>
                                <div class="portfolio-content p-3">
                                    <h3 class="mb-1" style="font-size:1.2rem;"><?php the_title(); ?></h3>
                                    <?php if($location): ?>
                                        <div class="text-sm text-muted mb-2"><i class="dashicons dashicons-location"></i> <?php echo esc_html($location); ?></div>
                                    <?php endif; ?>
                                    <span class="btn-link text-sm" style="color:var(--color-primary); font-weight:bold;">Детальніше &rarr;</span>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="pagination mt-5 text-center">
                    <?php the_posts_pagination( array('prev_text' => '←', 'next_text' => '→') ); ?>
                </div>

            <?php else : ?>
                <p class="text-center mt-5">Проєкти ще не додані...</p>
            <?php endif; ?>
        </div>
	</main><!-- #main -->

<?php
get_footer();
