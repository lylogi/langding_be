<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theme
 */
global $options;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="icon" href="<?= isset($option['favicon']) ? $option['favicon']['url']: ''; ?>" type="image/gif" sizes="16x16">

	<?php wp_head(); ?>
	<?= isset($option['gm_header_js']) ? $option['gm_header_js'] : ''; ?>
	 <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "WebSite",
      "name" : "<?php echo $option['gm_name']; ?>",
      "url": "<?php echo get_home_url(); ?>",
      "potentialAction": [{
        "@type": "SearchAction",
        "target": "<?php echo get_home_url(); ?>?s={search_term}",
        "query-input": "required name=search_term"
      }]
    }
    </script>

    <!-- Organization -->
    <script type="application/ld+json">
    { "@context" : "http://schema.org",
      "@type" : "Organization",
      "legalName" : "<?php echo $option['gm_name']; ?>",
      "url" : "<?php echo get_home_url(); ?>",
      "contactPoint" : [{
        "@type" : "ContactPoint",
        "telephone" : "+84 <?php echo $option['gm_phonenumber']; ?>",
        "contactType" : "customer service"
      }],
      "logo" : "<?php echo $option['header_logo']['url']; ?>",
      "sameAs" : [ 
        "<?php echo $option['gm_facebook']; ?>"
      ]
    }
    </script>
</head>


<body>
    <header>
        <div id="menu-mobile" class="menu-mobile d-block d-lg-none">
            <div class="nav_mobile">
                <h2>
                    <img src="<?php echo $options["header_logo"]["url"]?>" alt="<?php echo bloginfo["title"]?>">
                    <i class="fa fa-times" aria-hidden="true" onclick="closeNav()"></i>
                </h2>
                <?php
                    $gm_walker = new GM_Walker;
                    wp_nav_menu( array(
                        'theme_location' => 'menu-mobile',
                        'container' => 'ul',
                        'container_class' => '',
                        'menu_class' => '',
                        'menu_id' => '',
                        'depth' => 3,
                        'walker' => $gm_walker,
                    ));
                ?>
            </div>
        </div>
        <div class="top">
            <div class="container">
                <ul class="social social--top">
                    <?php if($options['gm_hotline']):?>
                        <li class="item--social">
                            <a href="<?php echo $options["gm_hotline"]?>"><i class="fa fa-phone" aria-hidden="true"></i></a>
                        </li>
                    <?php endif?>
                    <?php if($options['gm_email']):?>
                        <li class="item--social">
                            <a href="<?php echo $options["gm_email"]?>"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                        </li>
                    <?php endif;?>
                    <?php if($options['gm_facebook']): ?>
                        <li class="item--social">
                            <a href="<?php echo $options["gm_facebook"]?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                    <?php endif;?>
                    <?php if($options['gm_youtube']): ?>
                        <li class="item--social">
                            <a href="<?php echo $options["gm_youtube"]?>"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                        </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
        <?php if($options['banner1']):?>
            <div class="banner">
                <div class="img--banner">
                    <img src="<?php echo $options["gm_img_banner1"]["url"]?>" alt="<?php echo $options["gm_img_banner1"]["title"] ?>">
                </div>
                <div class="text--banner">
                    <h1 class="title--banner"><?php echo $options['gm_title_banner1']?></h1>
                    <p class="desc--banner"><?php echo $options['gm_slogan_banner1']?></p>
                </div>
            </div>
        <?php endif;?>
        <div class="menu--top">
            <div class="open-nav d-block d-lg-none" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <div class="container">
                <?php
                    $gm_walker = new GM_Walker;
                    wp_nav_menu( array(
                        'theme_location' => 'menu-primary',
                        'container' => 'ul',
                        'container_class' => '',
                        'menu_class' => 'navbar d-none d-lg-flex',
                        'menu_id' => '',
                        'depth' => 1,
                        'walker' => $gm_walker,
                    ));
                ?>
            </div>
        </div>
        <?php if($options['banner2']):?>
            <div class="banner">
                <div class="img--banner">
                    <img src="<?php echo $options["gm_img_banner2"]["url"]?>" alt="<?php echo $options["gm_img_banner2"]["title"] ?>">
                </div>
                <div class="text--banner">
                    <h1 class="title--banner"><?php echo $options['gm_title_banner2']?></h1>
                    <p class="desc--banner"><?php echo $options['gm_slogan_banner2']?></p>
                    <p class="hotline--banner"><?php echo $options['gm_hotline_banner2']?></p>
                </div>
            </div>
        <?php endif;?>
    </header>
