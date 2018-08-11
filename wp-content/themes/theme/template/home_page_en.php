<?php 
/**Template Name: Home page*/ 
get_header(); global $options?>
<?php if($options['slider_en']):?>
<div class="slider">
    <div class="owl-carousel owl-theme slide-adv">
        <?php foreach ($options['slider_en'] as $val) : ?>
        <div class="item">
            <img src="<?php echo $val['image'];?>" alt="<?php echo $val['title'];?>">
        </div>
    	<?php endforeach;?>
    </div>
</div>
<?php endif;?>
    <!-- end slider -->
<?php dynamic_sidebar('content-home')?>
<?php if(is_active_sidebar('list-price')):?>
	<div class="price_list">
        <div class="container">
            <div class="sh_title">
                <h4><?php _e( 'Pricing', 'gemi' )?></h4>
                <span class="b_after"><i class="fas fa-chess-queen"></i></span>
            </div>
            <div class="row">
				<?php dynamic_sidebar('list-price')?>
			</div>
		</div>
	</div>
<?php endif?>

<?php if($options['partner_en']):?>
    <div class="custom_home">
        <div class="container">
            <div class="owl-carousel owl-theme custom_slider">
            	<?php foreach ($options['partner_en'] as $val) : ?>
                <div class="item">
                    <div class="cus_content">
                        <div class="cus_icon">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <div class="cus_title">
                            <p><?php echo $val['description']?></p>
                        </div>
                    </div>
                    <h5 class="heading"><?php echo $val['title']?> <span><?php _e( 'From', 'gemi' )?><?php echo $val['url']?></span> </h5>
                    <div class="cus_thumb">
                        <img src="<?php echo $val['image']?>" alt="<?php echo $val['title']?>">
                    </div>
                </div>
            <?php endforeach;?>
            </div>
        </div>
    </div>
<?php endif;?>
    <!-- end custom_home -->
<?php if($options['expert_en']):?>
	<div class="expert_home">
        <div class="container">
            <div class="sh_title">
                <h4><?php echo $options['title_expert_en']?></h4>
                <p><?php echo $options['desc_expert_en']?></p>
                <span class="b_after"><i class="fas fa-chess-queen"></i></span>
            </div>
            <div class="ex_carou">
                <div class="owl-carousel owl-theme expert_slider">
                	<?php foreach ($options['expert_en'] as $val) : ?>
                    <div class="item">
                        <div class="row">
                            <div class="col-md-7 col-lg-7 col-xl-7">
                                <div class="ex_title">
                                    <h3>
                                        <?php echo $val['title']?>
                                        <span><?php echo $val['url']?></span>
                                    </h3>
                                    <p><?php echo $val['description']?></p>
                                </div>
                            </div>
                            <div class="col-md-5 col-lg-5 col-xl-5">
                                <div class="ex_thumb">
                                    <span>
                                        <img src="<?php echo $val['image']?>" alt="" class="img-fluid">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php endforeach?>
                </div>
            </div>
        </div>
    </div>
    <!-- end expert_home -->
<?php endif?>

<?php 
	$args_query = array(
        'post_type'=>'post',
        'post_status'=>'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'cat'=> 'tin-tuc',
        'posts_per_page' => 3,

    );
	$query = new WP_Query($args_query);
	if($query ->have_posts()) :
?>
    <div class="post_news">
        <div class="container">
            <div class="sh_title">
                <h4><?php _e( 'New Posts', 'gemi' )?></h4>
                <p><?php _e( 'Updated information from the latest products, services and promotions from us.', 'gemi' )?></p>
                <span class="b_after"><i class="fas fa-chess-queen"></i></span>
            </div>
            <div class="row">
            	 <?php
            	 	$i=0;
					while($query ->have_posts()) : $query ->the_post();
				?>
				<?php if($i==0):?>
					<?php $i++;?>
                <div class="col-lg-6 col-xl-6">
                    <div class="post_main">
                        <div class="post_thumb">
                            <a href="<?php the_permalink()?>">
                                <img src="<?php echo get_the_post_thumbnail_url()?>" alt="<?php the_title()?>" class="img-fluid">
                            </a>
                        </div>
                        <div class="post_title">
                            <h3>
                                <a href="<?php the_permalink()?>"><?php the_title()?></a>
                            </h3>
                            <span class="date"><?php _e( 'Date', 'gemi' )?> <?php get_the_date('d-m-Y')?></span>
                            <p><?php echo wp_trim_words(get_the_content(), 20, '...');?></p>
                            <span class="xemthem">
                                <a href="<?php the_permalink()?>"><?php _e( 'Read more', 'gemi' )?></a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6">
           		<?php else: ?>
           			<?php $i++;?>
                    <div class="product">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="thumb">
                                    <a href="<?php the_permalink()?>">
                                        <img src="<?php echo get_the_post_thumbnail_url()?>" alt="<?php the_title()?>" class="img-fluid">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="title">
                                    <h3>
                                        <a href="<?php the_permalink()?>"><?php the_title()?></a>
                                    </h3>
                                    <p><?php echo wp_trim_words(get_the_content(), 20, '...');?></p>
                                    <span class="xemthem">
                                        <a href="<?php the_permalink()?>"><?php _e( 'Read more', 'gemi' )?></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;endwhile?>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
    <!-- end post_news -->

<?php
get_footer();
