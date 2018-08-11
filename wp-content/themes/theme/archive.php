<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme
 */

get_header(); ?>

 <div class="service_banner">
        <div class="container">
            <h1><?php the_archive_title()?></h1>
            <?php gm_breadcrumbs() ?>
        </div>
    </div>

    <div class="news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-8">
                    <div class="news_left">
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
                                    get_template_part( 'template-parts/content', get_post_format() );

                                endwhile;

                            else :

                                get_template_part( 'template-parts/content', 'none' );

                            endif; ?>
                    </div>
                    <div class="phantrang">
                        <?php gm_pagination()?>
                    </div>
                </div>

                <div class="col-lg-4 col-xl-4">
                    <div class="news_right">
                        <div class="news_title">
                            <h4><?php  _e( 'Search', 'gemi' ) ?></h4>
                        </div>
                        <div class="new_form">
                            <form action="<?php  echo esc_url( home_url( '/' ) );?>" method="get">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="" placeholder="<?php  _e( 'Search', 'gemi' ) ?>" name="s" value="<?php echo get_search_query()?>">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="news_right">
                        <?php create_cat_posts()?>
                    </div>

                    <?php dynamic_sidebar('sidebar-news')?>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- end news -->
<?php
get_footer();
