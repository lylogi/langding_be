<?php 
/*
	File Name: list_of_articles_by_category.php
	Descriptions: widget hiển danh sách phân loại post 
	version : 1.0
*/
add_action('widgets_init','gm_library_image');
function gm_library_image(){
	register_widget('Gm_library_image');
}

class Gm_library_image extends WP_Widget {
	function  __construct() {
		parent::__construct(
			'gemi_widget_library_image', // id of widget
			'Widget hiển thị thư viện ảnh',
			array(
				'Description' => 'Hiển thị thư viện ảnh'
			)
		);
	}

	function form($instance){
		$default = array(
			'number'		=> '3',
			'title'			=>'',
			'intro'			=>'',
			'position'		=> ''
		);
		$instance = wp_parse_args((array) $instance, $default);
		if($instance){
			$number 	 = esc_attr($instance['number']);
			$title = esc_attr($instance['title']);
			$intro	 = esc_attr($instance['intro']);
			$position	 = esc_attr($instance['position']);

		}else{
			$number 	 = '';
			$title = '';
			$intro 	 = '';
			$position 	 = '';

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

			<label for="<?php echo $this->get_field_id('number');?>"><?php _e('số ảnh hiển thị:', 'gemi')?></label>
			<input class="widefat" type="number" name="<?php echo $this->get_field_name('number');?>" id="<?php echo $this->get_field_id('number');?>" value="<?php echo esc_attr($instance['number']); ?>">

			 <label for="<?php echo $this->get_field_id('position') ?>"><?php _e('Vị trí:', 'gemi'); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name('position') ?>" id="<?php echo $this->get_field_id('position') ?>">
                    <option class="widefat" value="1" <?php if("1" == $instance['position']) echo 'selected = "selected"' ?> >
                    	Trang chủ
                    </option>
                    <option class="widefat" value="2" <?php if("2" == $instance['position']) echo 'selected = "selected"' ?> > 			Sidebar
                    </option>
            </select>

		<?php
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
        $instance['number'] = strip_tags($new_instance['number']);
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['intro'] = strip_tags($new_instance['intro']);
        $instance['position'] = strip_tags($new_instance['position']);

		return $instance;
	}
	
	function widget($args, $instance){
		//global $id_category;
		extract($args);
		$number 	 = esc_attr($instance['number']);
		$title = esc_attr($instance['title']);
		$intro	 = esc_attr($instance['intro']);
		$position	 = esc_attr($instance['position']);


		global $options;
		?>

		<?php if($options['library-img']):
			if($position==1):
		?>
		<div class="gallery">
        <div class="container-fluid">
            <div class="sh_title">
                <h4><?php echo $title ?></h4>
                <p><?php echo $intro ?></p>
                <span class="b_after"><i class="fas fa-chess-queen"></i></span>
            </div>
            <div class="images_gl">
                <div class="row">
                	<?php $i=0;
                	foreach ($options['library-img'] as $val) : 
                		if($i==$number): break;endif;
                	?>
                    <div class="col-md-6 col-lg-3 col-xl-3 no_pd">
                        <a href="<?php echo $val['image']?>" data-group="1" class="galleryItem">
                            <div class="gl_thumb">
                                <img src="<?php echo $val['image']?>" alt="<?php echo $val['title']?>" class="img-fluid">
                                <div class="gl_icon">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="gl_title">
                                    <h5><?php echo $val['title']?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php $i++; endforeach;?>
                </div>
            </div>
        </div>
    </div>
	<?php elseif($position==2):?>
		<div class="news_right">
            <div class="news_title">
                <h4><?php echo $title?></h4>
            </div>
            <div class="new_images">
                <ul>
                	<?php foreach ($options['library-img'] as $val) : 
                		if($i==$number): break;endif;
                	?>
                	<li>
                        <a href="<?php echo $val['image']?>" data-group="1" class="galleryItem">
                            <img src="<?php echo $val['image']?>" alt="<?php $val['title']?>" class="img-fluid">
                        </a>
                    </li>
       
        			<?php $i++; endforeach;?>
                </ul>
            </div>
        </div>
		<?php
	endif;endif;
		echo $after_widget;

	}

}