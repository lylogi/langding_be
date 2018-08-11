<?php 
/*
	File Name: list_of_articles_by_category.php
	Descriptions: widget hiển danh sách phân loại post 
	version : 1.0
*/
add_action('widgets_init','gm_dich_vu_noi_bat');
function gm_dich_vu_noi_bat(){
	register_widget('Gm_dich_vu_noi_bat');
}

class Gm_dich_vu_noi_bat extends WP_Widget {
	function  __construct() {
		parent::__construct(
			'gemi_widget_dich_vu_noi_bat', // id of widget
			'Widget hiển thị dịch vụ nổi bật',
			array(
				'Description' => 'Hiển thị dịch vụ nổi bật'
			)
		);
	}

	function form($instance){
		$default = array(
			'id_post'			=>'',
			'position'			=> ''
		);
		$instance = wp_parse_args((array) $instance, $default);
		if($instance){
			$id_post 	 = esc_attr($instance['id_post']);
			$position 	 = esc_attr($instance['position']);

		}else{
			$id_post 	 = '';
			$position	 = '';

		}
		?>
			<label for="<?php echo $this->get_field_id('id_post') ?>"><?php _e('Chọn post:', 'gemi'); ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name('id_post') ?>" id="<?php echo $this->get_field_id('id_post') ?>">
				<?php 
					 $args = array( 'category' => 'cate', 'post_type' =>  'dich-vu' ); 
				    $postslist = get_posts( $args );    
				    foreach ($postslist as $post) :  setup_postdata($post); 
				    ?>  
				?>
					<option class="widefat" value="<?php echo $post->id?>" <?php if($post->id == $instance['id_post']) echo 'selected = "selected"' ?> > 
						<?php echo $post->post_title ?>
						
					</option>
				<?php 
					endforeach;
				?>
			</select>

			 <label for="<?php echo $this->get_field_id('position') ?>"><?php _e('Vị trí:', 'gemi'); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name('position') ?>" id="<?php echo $this->get_field_id('position') ?>">
                    <option class="widefat" value="1" <?php if("1" == $instance['position']) echo 'selected = "selected"' ?> >
                    	Ảnh bên trái
                    </option>
                    <option class="widefat" value="2" <?php if("2" == $instance['position']) echo 'selected = "selected"' ?> > 		Ảnh bên phải
                    </option>
            </select>

		<?php
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
        $instance['id_post'] = strip_tags($new_instance['id_post']);
        $instance['position'] = strip_tags($new_instance['position']);
       
		return $instance;
	}
	
	function widget($args, $instance){
		//global $id_category;
		extract($args);
		$id_post	 = esc_attr($instance['id_post']);
		$position = esc_attr($instance['position']);

		if(get_post($id_post)):
			if($position==1):
		?>
			<div class="old_home">
		        <div class="container">
		            <div class="row">
		                <div class="col-md-5 col-lg-5 col-xl-5">
		                    <img src="<?php echo get_the_post_thumbnail_url()?>" alt="<?php echo the_title()?>" class="img-fluid">
		                </div>
		                <div class="col-md-7 col-lg-7 col-xl-7">
		                    <div class="old_title">
		                        <h3><?php the_title()?> </h3>
		                        <p><?php echo wp_trim_words(get_the_content(), 60, '...');?></p>
		                        <span class="xemthem">
		                            <a href="<?php the_permalink()?>"><?php  _e( 'Read more', 'gemi' ) ?></a>
		                        </span>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		<?php elseif($position==2):?>
			 <div class="old_home">
		        <div class="container">
		            <div class="row">
		                <div class="col-md-7 col-lg-7 col-xl-7">
		                    <div class="old_title">
		                        <h3><?php the_title()?></h3>
		                        <p><?php echo wp_trim_words(get_the_content(), 60, '...');?></p>
		                        <span class="xemthem">
		                            <a href="<?php the_permalink()?>"><?php  _e( 'Read more', 'gemi' ) ?></a>
		                        </span>
		                    </div>
		                </div>
		                <div class="col-md-5 col-lg-5 col-xl-5">
		                    <img src="<?php echo get_the_post_thumbnail_url()?>" alt="<?php the_title()?>" class="img-fluid">
		                </div>
		            </div>
		        </div>
		    </div>
		 <?php endif;endif?>
    <!-- end old_home -->

			<?php
		echo $after_widget;

	}

}