<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 *
 * @package NIKABETON
 */

get_header();
?>

	<main id="primary" class="site-main">
        <div class="container py-content">
            <?php
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content', 'page' );
            endwhile; // End of the loop.
            ?>
        </div>
	</main><!-- #main -->

<?php
get_footer();
