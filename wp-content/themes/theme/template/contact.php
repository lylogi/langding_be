<?php 
/**Template Name:Liên hệ*/ 

global $option;
get_header(); ?>
 	<div class="service_banner">
        <div class="container">
            <h1><?php the_title()?></h1>
            <?php gm_breadcrumbs()?>
        </div>
    </div>


    <div class="model_contact">
        <div class="container">
            <div class="pd_center">
                <div class="ct_title">
                    <h2><?php the_title()?></h2>
                </div>
            </div>
            <div class="contact">
                <div class="row">
                    <div class="col-md-8 col-lg-8">
                        <div class="contact_form">
                            <?php echo do_shortcode('[contact-form-7 id="55" title="form trang liên hệ"]')?>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <div class="contact_address">
                            <h3><?php _e( 'Contact Info', 'gemi' )?></h3>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <?php echo $options['gm_address']?></a>
                                </li>
                                <li>
                                    <a href="tel:<?php echo $options['gm_hotline']?>"><i class="fa fa-headphones" aria-hidden="true"></i>
                                    	<?php echo $options['gm_hotline']?>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:<?php echo $options['gm_email']?>"><i class="fa fa-envelope" aria-hidden="true"></i>
                                    	<?php echo $options['gm_email']?>
                                    </a>
                                </li>
                            </ul>
                            <div class="border_bottom_details"></div>
                            <p><?php echo $options['gm_slogan']?></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end contact -->
        </div>
    </div>
    <!-- end model_contact -->
    <div class="google_map">
        <?php echo $options['gm_map']?>
    </div>
    <!-- end google_map -->
<?php
get_footer();