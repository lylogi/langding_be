<?php 
/*
	File Name: list_of_articles_by_category.php
	Descriptions: widget hiển danh sách phân loại post 
	version : 1.0
*/
add_action('widgets_init','gm_list_post_news');
function gm_list_post_news(){
	register_widget('Gm_list_post_news');
}

class Gm_list_post_news extends WP_Widget {
	function  __construct() {
		parent::__construct(
			'gemi_widget_list_post_news', // id of widget
			'Widget hiển thị danh sách bài viết mới nhất',
			array(
				'Description' => 'Hiển thị danh sách bài viết mới nhất'
			)
		);
	}

	function form($instance){
		$default = array(
			'title'			=>'',
			'number'	=>''
		);
		$instance = wp_parse_args((array) $instance, $default);
		if($instance){
			$title 	 = esc_attr($instance['title']);
			$number  = esc_attr($instance['number']);

		}else{
			$title	 = '';
			$number ='';

		}
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Tiêu đề','gemi') ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" value="<?php echo esc_attr($instance['title']); ?>">
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('number') ?>"><?php _e('Số bài viết:','gemi') ?></label>
				<input type="number" class="widefat" name="<?php echo $this->get_field_name('number') ?>" id="<?php echo $this->get_field_id('number') ?>" value="<?php echo esc_attr($instance['number']); ?>">
			</p>

		<?php
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
       
		return $instance;
	}
	
	function widget($args, $instance){
		//global $id_category;
		extract($args);
		$title	 = esc_attr($instance['title']);
		$number = esc_attr($instance['number']);
        
        $args_query = array(
            'post_type'=>'post',
            'post_status'=>'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'cat'=> 'tin-tuc',
            'posts_per_page' => $number,

            );
            $query = new WP_Query($args_query);
            if($query ->have_posts()) :
            
		?>
					<div class="news_right">
                        <div class="news_title">
                            <h4><?php echo $title?></h4>
                        </div>
                        <div class="new_posts">
                            <ul>
                            	<?php while($query ->have_posts()) : $query ->the_post();?>
                                <li>
                                    <div class="thumb_new">
                                        <a href="<?php the_permalink()?>">
                                            <img src="<?php echo get_the_post_thumbnail_url()?>" alt="<?php the_title()?>" class="img-fluid">
                                        </a>
                                    </div>
                                    <div class="title_new">
                                        <h3>
                                            <a href="<?php the_permalink()?>"><?php the_title()?></a>
                                        </h3>
                                        <p><?php echo wp_trim_words(get_the_content(), 10, '...');?></p>
                                    </div>
                                </li>
								<?php endwhile;?>
                            </ul>
                        </div>
                    </div>

			<?php
		endif;
		echo $after_widget;

	}

}