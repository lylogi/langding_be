<?php 
/*
 *
*/

// include theme support
include GM_THEME_URL.'/core/ThemeOption/GemiOption.php';

// include menu
include GM_THEME_URL.'/core/menu.php';

// include theme support
include GM_THEME_URL.'/core/theme-support.php';

// include widget image
include GM_THEME_URL.'/core/widget/image/upload_image.php';
include GM_THEME_URL.'/core/widget/image/image_library.php';

// include widget post
include GM_THEME_URL.'/core/widget/post/list_of_articles_by_category.php';
include GM_THEME_URL.'/core/widget/post/list_posts_new.php';
/*include GM_THEME_URL.'/core/widget/post/parent_categories_post.php';*/
include GM_THEME_URL.'/core/widget/post/list_post_danh_muc.php';
include GM_THEME_URL.'/core/widget/post/dich-vu-noi-bat.php';


include GM_THEME_URL.'/core/widget/widget_price_list.php';
include GM_THEME_URL.'/core/widget/business-hours.php';




//include widget woocommerce
/*include GM_THEME_URL.'/core/widget/woocommerce/woo_list_categories.php';
include GM_THEME_URL.'/core/widget/woocommerce/woo_list_of_products_by_category.php';
include GM_THEME_URL.'/core/widget/woocommerce/woo_product_type.php';
*/

// include admin.php
include GM_THEME_URL.'/core/admin/admin.php';

//include post_type
/*include GM_THEME_URL.'/core/widget/post_type/get_post_by_categories.php';*/

// include file woocommerce
/*include GM_THEME_URL.'/core/woocommerce/woo.php';*/


// require class-tgm-plugin-activation.php
require_once GM_THEME_URL.'/core/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'gemi_plugin_activation' );
function gemi_plugin_activation() {

    // Khai bao plugin can cai dat
    $plugins = array(
       array(
            'name' => 'Contact Form 7', //tên plugin
            'slug' => 'contact-form-7', //đường dẫn dến plugin trên www.wordpress.org/plugin
            'required' => true //có bắt buộc hay không
        ),
        array(
            'name' => 'Redux Framework', //tên plugin
            'slug' => 'redux-framework', //đường dẫn dến plugin trên www.wordpress.org/plugin
            'required' => true //có bắt buộc hay không
        ),
        array(
            'name' => 'Yoast SEO', //tên plugin
            'slug' => 'wordpress-seo', //đường dẫn dến plugin trên www.wordpress.org/plugin
            'required' => true //có bắt buộc hay không
        ),
        array(
            'name' => 'TinyMCE Advanced', //tên plugin
            'slug' => 'tinymce-advanced', //đường dẫn dến plugin trên www.wordpress.org/plugin
            'required' => true //có bắt buộc hay không
        )
    );

    // Thiet lap TGM
    $configs = array(
        'menu' => 'tgmpa-install-plugins',
        'has_notice' => true,
        'dismissable' => false,
        'is_automatic' => true
    );
    tgmpa( $plugins, $configs );

}
add_action('tgmpa_register', 'gemi_plugin_activation');
?>
