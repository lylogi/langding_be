<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme
 */

get_header(); ?>

	<div class="service_banner" >
        <div class="container">
        	<h1><?php the_archive_title()?></h1>
            <?php gm_breadcrumbs() ?>
        </div>
    </div>

    <div class="category_main">
        <div class="container">
            <div class="row">
                <?php
					if ( have_posts() ) : ?>

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'dichvu' );

						endwhile;

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>
            </div>
        </div>
    </div>
    <!-- end category_main -->

   <?php dynamic_sidebar('sidebar-dichvu')?>

<?php
get_footer();
