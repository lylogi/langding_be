<?php 
/*
	File Name: list_of_articles_by_category.php
	Descriptions: widget hiển danh sách phân loại post 
	version : 1.0
*/
add_action('widgets_init','gm_list_post_danh_muc');
function gm_list_post_danh_muc(){
	register_widget('Gm_list_post_danh_muc');
}

class Gm_list_post_danh_muc extends WP_Widget {
	function  __construct() {
		parent::__construct(
			'gemi_widget_list_post_danh_muc', // id of widget
			'Widget hiển thị danh sách post dịch vụ',
			array(
				'Description' => 'Danh sách post dịch vụ'
			)
		);
	}

	function form($instance){
		$default = array(
			'number'		=> '3',
			'title'			=>'',
			'intro'			=>''
		);
		$instance = wp_parse_args((array) $instance, $default);
		if($instance){
			$number 	 = esc_attr($instance['number']);
			$title = esc_attr($instance['title']);
			$intro	 = esc_attr($instance['intro']);
		}else{
			$number 	 = '';
			$title = '';
			$intro 	 = '';
		}
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title') ?>"><?php _e('The Title','gemi') ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" value="<?php echo esc_attr($instance['title']); ?>">
			</p>
			<!-- chỉnh sửa giới thiệu -->
			<p>
			    <label for="<?php echo $this->get_field_id('intro') ?>"><?php _e('Giới thiệu:', 'wp_widget_plugin'); ?></label>
			    <textarea type="text" class="widefat" id="<?php echo $this->get_field_id('intro'); ?>"
			    name="<?php echo $this->get_field_name('intro'); ?>"><?php echo esc_attr($instance['intro']); ?></textarea>
			</p>

			<label for="<?php echo $this->get_field_id('number');?>"><?php _e('số bài hiển thị:', 'gemi')?></label>
			<input class="widefat" type="number" name="<?php echo $this->get_field_name('number');?>" id="<?php echo $this->get_field_id('number');?>" value="<?php echo esc_attr($instance['number']); ?>">

		<?php
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
        $instance['number'] = strip_tags($new_instance['number']);
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['intro'] = strip_tags($new_instance['intro']);
		return $instance;
	}
	
	function widget($args, $instance){
		//global $id_category;
		extract($args);
		$number 	 = esc_attr($instance['number']);
		$title = esc_attr($instance['title']);
		$intro	 = esc_attr($instance['intro']);

		$args_query = array(
            'post_type'=>'dich-vu',
            'post_status'=>'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $number,

        );
		$query = new WP_Query($args_query);
		echo $before_widget;
			?>
		<?php
    		if($query ->have_posts()) :
		?>
        <div class="service_home">
	        <div class="container">
	            <div class="sh_title">
	                <h4><?php echo $title?></h4>
	                <p><?php echo $intro?></p>
	                <span class="b_after"><i class="fas fa-chess-queen"></i></span>
	            </div>
	            <div class="row">
	                <?php
						while($query ->have_posts()) : $query ->the_post();
					?>
	                <div class="col-lg-4 col-xl-4">
	                    <div class="sh_pro">
	                        <div class="sh_thumb">
	                            <a href="<?php the_permalink()?>">
	                                <img src="<?php echo get_the_post_thumbnail_url()?>" alt="<?php the_title()?>">
	                            </a>
	                        </div>
	                        <div class="sh_ct">
	                            <h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
	                            <p><?php echo wp_trim_words(get_the_content(), 15, '...');?></p>
	                            <span class="sh_xemthem">
	                                <a href="<?php the_permalink()?>"><?php  _e( 'Read more', 'gemi' ) ?></a>
	                            </span>
	                        </div>
	                    </div>
	                </div>
	            <?php endwhile;?>

	            </div>
	        </div>
	    </div>
		<?php endif;?>
    <!-- end service_home -->
			<?php
		echo $after_widget;

	}

}