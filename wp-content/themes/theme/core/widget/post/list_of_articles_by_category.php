<?php 
/*
	File Name: list_of_articles_by_category.php
	Descriptions: widget hiển danh sách phân loại post 
	version : 1.0
*/
add_action('widgets_init','gm_list_of_articles_by_category');
function gm_list_of_articles_by_category(){
	register_widget('Gm_list_of_articles_by_category');
}

class Gm_list_of_articles_by_category extends WP_Widget {
	function  __construct() {
		parent::__construct(
			'gemi_widget_list_post_category', // id of widget
			'Widget hiển thị danh sách post theo danh mục chọn',
			array(
				'Description' => 'Danh sách post theo danh mục chọn'
			)
		);
	}

	function form($instance){
		$default = array(
			'id_category'   => 1,
			'id_category2'	=>2,
			'number'		=> 4,
			'number2'		=>2,
			'title'			=>'',
			'intro'			=>''
		);
		$instance = wp_parse_args((array) $instance, $default);
		if($instance){
			$id_category = esc_attr($instance['id_category']);
			$number 	 = esc_attr($instance['number']);
			$id_category1 = esc_attr($instance['id_category2']);
			$number2	 = esc_attr($instance['number2']);
			$title = esc_attr($instance['title']);
			$intro	 = esc_attr($instance['intro']);
		}else{
			$id_category = '';
			$number 	 = '';
			$id_category2 = '';
			$number2 	 = '';
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

			<label for="<?php echo $this->get_field_id('id_category') ?>"><?php _e('Chuyên mục bên trái:', 'gemi'); ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name('id_category') ?>" id="<?php echo $this->get_field_id('id_category') ?>">
				<?php  $list_category = get_categories(); ?>

				<?php 
					foreach ($list_category as $list_categories) :
				?>
					<option class="widefat" value="<?php echo $list_categories->term_id ?>" <?php if($list_categories->term_id == $instance['id_category']) echo 'selected = "selected"' ?> > 
						<?php echo $list_categories->name ?>
						
					</option>
				<?php 
					endforeach;
				?>
			</select>

			<label for="<?php echo $this->get_field_id('number');?>"><?php _e('số bài hiển thị bên trái', 'gemi')?></label>
			<input class="widefat" type="number" name="<?php echo $this->get_field_name('number');?>" id="<?php echo $this->get_field_id('number');?>" value="<?php echo esc_attr($instance['number']); ?>">


			<label for="<?php echo $this->get_field_id('id_category2') ?>"><?php _e('Chuyên mục bên phải:', 'gemi'); ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name('id_category2') ?>" id="<?php echo $this->get_field_id('id_category2') ?>">
				<?php  $list_category = get_categories(); ?>

				<?php 
					foreach ($list_category as $list_categories) :
				?>
					<option class="widefat" value="<?php echo $list_categories->term_id ?>" <?php if($list_categories->term_id == $instance['id_category2']) echo 'selected = "selected"' ?> > 
						<?php echo $list_categories->name ?>
						
					</option>
				<?php 
					endforeach;
				?>
			</select>

			<label for="<?php echo $this->get_field_id('number2');?>"><?php _e('số bài hiển thị bên phải', 'gemi')?></label>
			<input class="widefat" type="number" name="<?php echo $this->get_field_name('number2');?>" id="<?php echo $this->get_field_id('number2');?>" value="<?php echo esc_attr($instance['number2']); ?>">
		<?php
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['id_category'] = strip_tags($new_instance['id_category']);
        $instance['number'] = strip_tags($new_instance['number']);
        $instance['id_category2'] = strip_tags($new_instance['id_category2']);
        $instance['number2'] = strip_tags($new_instance['number2']);
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['intro'] = strip_tags($new_instance['intro']);
		return $instance;
	}
	
	function widget($args, $instance){
		//global $id_category;
		extract($args);
		$id_category = esc_attr($instance['id_category']);
		$number 	 = esc_attr($instance['number']);
		$id_category2 = esc_attr($instance['id_category2']);
		$number2	 = esc_attr($instance['number2']);
		$title = esc_attr($instance['title']);
		$intro	 = esc_attr($instance['intro']);

		$args_query = array(
            'post_type'=>'post',
            'post_status'=>'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'cat'=> $id_category,
            'posts_per_page' => $number,

        );
		$query = new WP_Query($args_query);


		$args_query2 = array(
            'post_type'=>'post',
            'post_status'=>'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'cat'=> $id_category2,
            'posts_per_page' => $number2,

        );
		$query2 = new WP_Query($args_query2);

		echo $before_widget;
			?>
        <div class="therapy_home">
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-6 col-xl-6">
	                	<?php
	                		if($query ->have_posts()) :
						?>
	                    <div class="th_right">
	                        <div class="th_title">
	                            <h3><?php echo $title?></h3>
	                            <p><?php echo $intro?></p>
	                        </div>
	                        <div class="th_list">
	                            <ul>
	                            	<?php
										while($query ->have_posts()) : $query ->the_post();
									?>
	                                <li>
	                                    <div class="th_htumb">
	                                        <a href="<?php the_permalink()?>">
	                                            <img src="<?php echo get_the_post_thumbnail_url()?>" alt="<?php the_title()?>">
	                                        </a>
	                                    </div>
	                                    <div class="th_content">
	                                        <h3>
	                                            <a href="<?php the_permalink()?>"><?php the_title()?></a>
	                                        </h3>
	                                        <p><?php echo wp_trim_words(get_the_content(), 15, '...');?></p>
	                                    </div>
	                                </li>
	                            <?php endwhile;?>
	                            </ul>
	                        </div>
	                    </div>
	                <?php endif;?>
	                </div>

	                <div class="col-lg-6 col-xl-6">
	                	<?php
	                		if($query2 ->have_posts()) :
						?>
	                    <div class="th_left">
	                        <div class="row">
	                        	<?php
									while($query2 ->have_posts()) : $query2 ->the_post();
								?>
	                            <div class="col-lg-6 col-xl-6">
	                                <div class="lf_pro">
	                                    <div class="lf_thumb">
	                                        <a href="<?php the_permalink()?>">
	                                            <img src="<?php echo get_the_post_thumbnail_url()?>" alt="<?php the_title()?>" class="img-fluid">
	                                        </a>
	                                    </div>
	                                    <div class="lf_title">
	                                        <h3>
	                                            <a href="<?php the_permalink()?>"><?php the_title() ?></a>
	                                        </h3>
	                                        <p><?php echo wp_trim_words(get_the_content(), 15, '...');?></p>
	                                    </div>
	                                </div>
	                            </div>
	                        <?php  endwhile;?>
	                        </div>
	                    </div>
	                <?php endif;?>
	                </div>
	            </div>
	        </div>
	    </div>	
			<?php
		echo $after_widget;

	}

}