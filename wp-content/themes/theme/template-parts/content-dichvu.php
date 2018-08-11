<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme
 */

?>

 <div class="col-md-6 col-lg-4 col-xl-4 no_pd color_nth">
    <div class="cate_pro">
        <div class="cate_thumb">
            <img src="<?php echo get_the_post_thumbnail_url()?>" alt="<?php the_title()?>" class="img-fluid">
            <div class="cate_title">
                <div class="cate_icon">
                </div>
                <h5 class="heading"><?php the_title()?></h5>
                <p><?php echo wp_trim_words(get_the_content(), 15, '...');?></p>
                <span class="sh_xemthem">
                    <a href="<?php the_permalink()?>">Xem thêm</a>
                </span>
            </div>
        </div>
    </div>
</div>