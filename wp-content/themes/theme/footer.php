<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theme
 */
global $options;
?>      
	  <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 col-xl-3">
                    <div class="ft_content">
                        <h3> <?= _e( 'Address', 'gemi' ) ?></h3>
                        <div class="ft_link">
                            <ul>
                                <li><i class="fas fa-map-marker-alt"></i><?php echo $options['gm_address']?></li>
                                <li>
                                    <a href="tel:<?php echo $options['gm_hotline']?>"><i class="fas fa-phone"></i> <?php echo $options['gm_hotline']?></a>
                                </li>
                                <li>
                                    <a href="mailto:<?php echo $options['gm_email']?>"><i class="fas fa-envelope"></i><?php echo $options['gm_email']?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3">
                    <div class="ft_content">
                        <?php dynamic_sidebar('footer-1')?>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3">
                    <div class="ft_content">
                        <h3><?= _e( 'New Posts', 'gemi' ) ?></h3>
                        <div class="ft_link">
                            <ul>
                                <?php $args_query = array(
                                    'post_type'=>'post',
                                    'post_status'=>'publish',
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'cat'=> 'tin-tuc',
                                    'posts_per_page' => 4,

                                    );
                                    $query = new WP_Query($args_query);
                                    if($query ->have_posts()) :
                                    while($query ->have_posts()) : $query ->the_post();
                                ?>
                                 <li>
                                    <a href="<?php the_permalink()?>"><?php the_title()?></a>
                                </li>
                            <?php endwhile; endif;?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3">
                    <div class="ft_content">
                        <h3><?= _e( 'Contact', 'gemi' ) ?></h3>
                        <div class="ft_form">
                            <?php echo do_shortcode('[contact-form-7 id="4" title="Form liên hệ footer"]')?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ft_title">
                <h2>Hotline: <?php echo $options['gm_hotline']?></h2>
                <p><?php echo $options['gm_slogan']?></p>
                <ul>
                    <?php if($options['gm_facebook']):?>
                    <li>
                        <a href="<?php echo $option['gm_facebook']?>"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <?php endif?>
                    <?php if($options['gm_twitter']):?>
                    <li>
                        <a href="<?php echo $option['gm_twitter']?>"><i class="fab fa-twitter"></i></a>
                    </li>
                    <?php endif?>
                    <?php if($options['gm_youtube']):?>
                    <li>
                        <a href="<?php echo $option['gm_youtube']?>"><i class="fab fa-youtube"></i></a>
                    </li>
                    <?php endif?>
                    <?php if($options['gm_google']):?>
                    <li>
                        <a href="<?php echo $option['gm_google']?>"><i class="fab fa-google-plus-g"></i></a>
                    </li>
                    <?php endif?>
                </ul>
            </div>
        </div>
    </footer>

    <div class="copy_right">
        <p>
            &copy Được làm bởi đội ngũ hùng hậu <a href="https://gemisoft.com.vn/">Gemisoft.com.vn</a>
        </p>
    </div>

    <div class="phone_center">
        <a href="tel:<?php echo $options['gm_hotline']?>" id="alo-phoneIcon" class="alo-phone alo-green alo-show">
            <div class="alo-ph-circle"></div>
            <div class="alo-ph-circle-fill"></div>
            <div class="alo-ph-img-circle"><i class="fa fa-phone"></i></div><span class="alo-ph-text"><?php echo $options['gm_hotline']?></span>
        </a>
    </div>

    <div class="scrollup">
        <a href="" class="fa fa-angle-up scrollup"></a>
    </div>
   
<?php wp_footer(); ?>
 <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11&appId=111177263003189';
                    fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
</script> 
<?= 
	isset($option['gm_footer_js']) ? $option['gm_footer_js'] : '';
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.1/tinymce.min.js"></script>
</body>
</html>
