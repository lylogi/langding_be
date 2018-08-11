<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme
 */

?>

 <div class="new_pro">
    <div class="new_thumb">
        <a href="<?php the_permalink()?>">
            <img src="<?php echo get_the_post_thumbnail_url()?>" alt="<?php the_title()?>" class="img-fluid">
        </a>
    </div>
    <div class="new_title">
        <h3>
            <a href="<?php the_title()?>"><?php the_title()?></a>
        </h3>
        <span class="date">
            ngày <?php echo get_the_date('d-m-Y')?>
        </span>
        <p><?php echo wp_trim_words(get_the_content(), 15, '...');?></p>
        <span class="xemthem">
            <a href="<?php the_permalink()?>"><span>Xem thêm</span></a>
        </span>
    </div>
</div>