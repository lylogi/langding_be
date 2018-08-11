<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package theme
 */

get_header(); ?>

	<div class="element-page">
        <main class="error-page">
            <div class="page-404">
                <img src="<?php echo ASSETS ?>/images/404.png" alt="404">
                <h2><?php  _e( 'Error, Content not found!', 'gemi' ) ?></h2>
                <a href="<?php echo get_home_url() ?>"><?php  _e( 'Back home', 'gemi' ) ?></a>
            </div>
        </main>
    </div>

<?php
get_footer();
