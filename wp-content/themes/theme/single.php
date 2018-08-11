<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package theme
 */
global $options;
get_header(); ?>
 <div class="service_banner">
        <div class="container">
            <h1><?php the_title()?></h1>
            <?php gm_breadcrumbs()?>
        </div>
    </div>

    <div class="news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-8">
                    <div class="news_left">
                        <article>
                            <h1><?php the_title()?></h1>
                            <span class="date">
                                <?php  _e( 'Date', 'gemi' ) ?><?php echo get_the_date('d-m-Y')?>
                            </span>
                            <?php
			                    while ( have_posts() ) : the_post();?>
			                    	<script type="application/ld+json">
                              	{
                                "@context": "http://schema.org",
                                "@type": "NewsArticle",
                                "name": "<?php the_title(); ?>",
                                "image" : "<?php echo get_the_post_thumbnail_url(); ?>",
                                "description" : "<?php echo wp_trim_words(get_the_content(), 20, '...'); ?>",
                                "headline":"<?php the_title();?>",
                                "author"    : "<?php the_author(); ?>",
                                "datePublished": "<?php echo get_the_date('Y-m-d'); ?>",
                                "dateModified": "<?php echo get_the_date('Y-m-d'); ?>",
                                "aggregateRating": {
                                  "@type": "AggregateRating",
                                  "ratingValue": "4.8",
                                  "reviewCount": "<?php echo get_the_ID(); ?>"
                                },
                                "publisher": {
                                  "@type": "Organization",
                                  "name": "<?php echo get_home_url(); ?>",
                                  "logo": {
                                  "@type": "ImageObject",
                                  "url": "<?= $options['header_logo']['url'] ?>",
                                  "width": 60,
                                  "height": 60
                                }

                                },
                                "mainEntityOfPage": {
                                    "@type": "WebPage",
                                    "@id"   : "<?php the_permalink(); ?>"
                                }
                              }
                              </script>

                              <script type="application/ld+json">
                              {
                               "@context": "http://schema.org",
                               "@type": "BreadcrumbList",
                               "itemListElement":
                               [
                                {
                                 "@type": "ListItem",
                                 "position": 1,
                                 "item":
                                 {
                                  "@id": "<?php echo get_home_url(); ?>",
                                  "name": "Trang chủ"
                                  }
                                },
                                {
                                  "@type": "ListItem",
                                  "position": 2,
                                  "item":
                                  <?php 
                                    $post_categories = get_the_category('');                                            
                                          
                                  ?>
                                   {
                                     "@id": "<?php echo esc_url(get_category_link($post_categories[0]->term_id)) ?>",
                                     "name":"<?php echo $post_categories[0]->name ?>" 
                                   }
                                 
                                },
                                {
                                  "@type": "ListItem",
                                  "position": 3,
                                  "item":
                                   {
                                     "@id": "<?php the_permalink(); ?>",
                                     "name": "<?php the_title(); ?>"
                                   }
                                  }
                               ]
                              }
                              </script>
                              <?php
			                    the_content();
			                    endwhile; // End of the loop.
		                    ?>
                        </article>
                    </div>
                     <?php
				        $categories = get_the_category();

				        $args_post = array(

				            'post_type' => 'post',

				            'posts_per_page' => 3,

				            'category_name' => esc_html($categories[0]->name));

				        $loop = new WP_Query($args_post);
				        if (!empty($loop->have_posts())): ?>
                    <div class="post_lq">
                        <h3><?php  _e( 'Posts Related', 'gemi' ) ?></h3>
                        <ul>
                        	 <?php while ($loop->have_posts()) :
                                $loop->the_post(); ?>
                            <li>
                                <a href="<?php the_permalink()?>"><?php the_title()?></a>
                            </li>
                            <?php endwhile?>
                        </ul>
                    </div>
                <?php endif?>
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
