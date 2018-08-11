<?php 
/*
	File Name: parent_categories_post.php
*/
add_action('widgets_init','gm_parent_categories_post');
function gm_parent_categories_post(){
	register_widget('GM_parent_categories_post');
}

class GM_parent_categories_post extends WP_Widget{
	function __construct(){
		parent::__construct(
			'gm_parent_categories_post',
			'Widget hiển thị danh mục cha post',
			array(
				'description'	=> 'Danh mục cha post'
			)
		);
	}
	function form($instance){
		$default = array(
			'title'	=> '',
		);
		$instance = wp_parse_args((array) $instance, $default);
		if($instance){
			$title = esc_attr($instance['title']);
		}
		else{
			$title = '';
		}
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title') ?>"><?php _e('The Title','gemi') ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" value="<?php echo esc_attr($instance['title']); ?>">
			</p>
		<?php
	}
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = esc_attr($new_instance['title']);
		return $instance;
	}
	function widget($args, $instance){
		extract($args);
		$title = esc_attr($instance['title']);

		echo $before_widget;
		?>
			<div class="ft_content">
				<h3><?php echo sanitize_text_field($title) ?></h3>
				<?php 
					$arrays = array(
						'child_of' 	=> 0,
						'parent'	=> 0,
						'type'		=> 'post',

					); 
					$list_category = get_categories($arrays); 
				?>
				<ul>
					<?php 
						foreach ($list_category as $val):
					?>
						<li>
							<a href="<?php echo get_category_link($val->term_id) ?>"><?php echo $val->name ?></a>
						</li>
					<?php 
						endforeach;
					?>
				</ul>
			</div>
		<?php
		echo $after_widget;
	}
}