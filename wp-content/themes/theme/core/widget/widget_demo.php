<?php 
/*
	File Name: list_of_articles_by_category.php
	Descriptions: widget hiển danh sách phân loại post 
	version : 1.0
*/
add_action('widgets_init','gm_price_list');
function gm_price_list(){
	register_widget('Gm_price_list');
}

class Gm_price_list extends GM_Widget_Text {
	function  __construct() {
		parent::__construct(
			'gm_price_list',
			'widget gia san pham',
			array(
				'Description'	=> 'gia',
			)
		);
	}

	function form($instance){
		$default = array(
			'title'			=>'',
			'price'			=>'',
			'currency'		=>'',
			'duration'		=> '',
			'color'			=> '',
			'image'			=>'',
			'text'			=>''
		);
		$instance = wp_parse_args((array) $instance, $default);
		if($instance){
			$title = esc_attr($instance['title']);
			$price	 = esc_attr($instance['price']);
			$currency	 = esc_attr($instance['currency']);
			$duration	 = esc_attr($instance['duration']);
			$color	 = esc_attr($instance['color']);
			$image	 = esc_attr($instance['image']);
			$text =  esc_attr($instance['text']);

		}else{
			$title = '';
			$price 	 = '';
			$currency	 = '';
			$duration	 = '';
			$color	 = '';
			$image	 = '';
			$text = '';
		}
		?>


			<p>
				<?php if ( ! $this->is_legacy_instance( $instance ) ) : ?>
					<?php

					if ( user_can_richedit() ) {
						add_filter( 'the_editor_content', 'format_for_editor', 10, 2 );
						$default_editor = 'tinymce';
					} else {
						$default_editor = 'html';
					}

					/** This filter is documented in wp-includes/class-wp-editor.php */
					$text = apply_filters( 'the_editor_content', $instance['text'], $default_editor );

					// Reset filter addition.
					if ( user_can_richedit() ) {
						remove_filter( 'the_editor_content', 'format_for_editor' );
					}

					// Prevent premature closing of textarea in case format_for_editor() didn't apply or the_editor_content filter did a wrong thing.
					$escaped_text = preg_replace( '#</textarea#i', '&lt;/textarea', $text );

					?>
					<textarea id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" class="text sync-input" hidden><?php echo $escaped_text; ?></textarea>
					<input id="<?php echo $this->get_field_id( 'filter' ); ?>" name="<?php echo $this->get_field_name( 'filter' ); ?>" class="filter sync-input" type="hidden" value="on">
					<input id="<?php echo $this->get_field_id( 'visual' ); ?>" name="<?php echo $this->get_field_name( 'visual' ); ?>" class="visual sync-input" type="hidden" value="on">
				<?php else : ?>
					<input id="<?php echo $this->get_field_id( 'visual' ); ?>" name="<?php echo $this->get_field_name( 'visual' ); ?>" class="visual" type="hidden" value="">
					<div class="notice inline notice-info notice-alt">
						<?php if ( ! isset( $instance['visual'] ) ) : ?>
							<p><?php _e( 'This widget may contain code that may work better in the &#8220;Custom HTML&#8221; widget. How about trying that widget instead?' ); ?></p>
						<?php else : ?>
							<p><?php _e( 'This widget may have contained code that may work better in the &#8220;Custom HTML&#8221; widget. If you haven&#8217;t yet, how about trying that widget instead?' ); ?></p>
						<?php endif; ?>
					</div>
					<p>
						<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Content:' ); ?></label>
						<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea>
					</p>
					<p>
						<input id="<?php echo $this->get_field_id( 'filter' ); ?>" name="<?php echo $this->get_field_name( 'filter' ); ?>" type="checkbox"<?php checked( ! empty( $instance['filter'] ) ); ?> />&nbsp;<label for="<?php echo $this->get_field_id( 'filter' ); ?>"><?php _e( 'Automatically add paragraphs' ); ?></label>
					</p>
				<?php
				endif;
			    ?>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('title') ?>"><?php _e('The Title','gemi') ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" value="<?php echo esc_attr($instance['title']); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('price') ?>"><?php _e('Giá','gemi') ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('price') ?>" id="<?php echo $this->get_field_id('price') ?>" value="<?php echo esc_attr($instance['price']); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('currency') ?>"><?php _e('Đơn vị','gemi') ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('currency') ?>" id="<?php echo $this->get_field_id('currency') ?>" value="<?php echo esc_attr($instance['currency']); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('duration') ?>"><?php _e('Thời hạn dịch vụ','gemi') ?></label>
				<input type="text" class="widefat" name="<?php echo $this->get_field_name('duration') ?>" id="<?php echo $this->get_field_id('duration') ?>" value="<?php echo esc_attr($instance['duration']); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('color') ?>"><?php _e('Màu nền','gemi') ?></label>
				<input type="color" class="widefat" name="<?php echo $this->get_field_name('color') ?>" id="<?php echo $this->get_field_id('color') ?>" value="<?php echo esc_attr($instance['color']); ?>">
			</p>
            
            <p>
				<label for="<?php echo $this->get_field_id('image') ?>"> <?php _e('Upload image ','gemi')?> </label>
				<div class="gemi-media-container">
					<div class="gemi-media-inner">
						<?php $img_style = ( $instance[ 'image' ] != '' ) ? '' : 'style="display:none;"'; ?>
						<img id="<?php echo $this->get_field_id( 'image' ); ?>-preview" src="<?php echo esc_attr( $instance['image'] ); ?>" <?php echo $img_style; ?> style="width: 50px; height: 50px" />
						<?php $no_img_style = ( $instance[ 'image' ] != '' ) ? 'style="display:none;"' : ''; ?>
						<span class="gemi-no-image" id="<?php echo $this->get_field_id( 'image' ); ?>-noimg" <?php echo $no_img_style; ?>><?php _e( 'Chưa có ảnh nào được chọn', 'gemi' ); ?></span>
					</div>

					<input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>" class="gemi-media-url" />

					<input type="button" value="<?php echo _e( 'Xóa', 'gemi' ); ?>" class="button gemi-media-remove btn btn-danger btn-sm" id="<?php echo $this->get_field_id( 'image' ); ?>-remove" <?php echo $img_style; ?> />

					<?php $button_text = ( $instance[ 'image' ] != '' ) ? __( 'Đổi ảnh', 'gemi' ) : __( 'Chọn ảnh', 'gemi' ); ?>
					<input type="button" value="<?php echo $button_text; ?>" class="button gemi-media-upload" id="<?php echo $this->get_field_id( 'image' ); ?>-button" />
					<br class="clear">
				</div>
			</p>

			
			<style type="text/css">
				.gemi-media-inner img {
					width: 115px !important;
					height: auto;
				}
			</style>
			<script>
			jQuery( document ).ready( function() {

	    // Upload / Change Image
	    function gemi_image_upload( button_class ) {

	    	var _custom_media = true,
	    	_orig_send_attachment = wp.media.editor.send.attachment;

	    	jQuery( 'body' ).on( 'click', button_class, function(e) {

	    		var button_id           = '#' + jQuery( this ).attr( 'id' ),
	    		self                = jQuery( button_id),
	    		send_attachment_bkp = wp.media.editor.send.attachment,
	    		button              = jQuery( button_id ),
	    		id                  = button.attr( 'id' ).replace( '-button', '' );

	    		_custom_media = true;

	    		wp.media.editor.send.attachment = function( props, attachment ){

	    			if ( _custom_media ) {

	    				jQuery( '#' + id + '-preview'  ).attr( 'src', attachment.url ).css( 'display', 'block' );
	    				jQuery( '#' + id + '-remove'  ).css( 'display', 'inline-block' );
	    				jQuery( '#' + id + '-noimg' ).css( 'display', 'none' );
	    				jQuery( '#' + id ).val( attachment.url ).trigger( 'change' );  

	    			} else {

	    				return _orig_send_attachment.apply( button_id, [props, attachment] );

	    			}
	    		}

	    		wp.media.editor.open( button );

	    		return false;
	    	});
	    }
	    gemi_image_upload( '.gemi-media-upload' );

		    // Remove Image
		    function gemi_image_remove( button_class ) {

		    	jQuery( 'body' ).on( 'click', button_class, function(e) {

		    		var button              = jQuery( this ),
		    		id                  = button.attr( 'id' ).replace( '-remove', '' );

		    		jQuery( '#' + id + '-preview' ).css( 'display', 'none' );
		    		jQuery( '#' + id + '-noimg' ).css( 'display', 'block' );
		    		button.css( 'display', 'none' );
		    		jQuery( '#' + id ).val( '' ).trigger( 'change' );

		    	});
		    }
		    gemi_image_remove( '.gemi-media-remove' );

		});
	</script>

		<?php
	}
	public static function render_control_template_scripts() {
		$dismissed_pointers = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
		?>
		<script type="text/html" id="tmpl-widget-text-control-fields">
			<# var elementIdPrefix = 'el' + String( Math.random() ).replace( /\D/g, '' ) + '_' #>
			<p>
				<label for="{{ elementIdPrefix }}title"><?php esc_html_e( 'Title:' ); ?></label>
				<input id="{{ elementIdPrefix }}title" type="text" class="widefat title">
			</p>

			<?php if ( ! in_array( 'text_widget_custom_html', $dismissed_pointers, true ) ) : ?>
				<div hidden class="wp-pointer custom-html-widget-pointer wp-pointer-top">
					<div class="wp-pointer-content">
						<h3><?php _e( 'New Custom HTML Widget' ); ?></h3>
						<?php if ( is_customize_preview() ) : ?>
							<p><?php _e( 'Did you know there is a &#8220;Custom HTML&#8221; widget now? You can find it by pressing the &#8220;<a class="add-widget" href="#">Add a Widget</a>&#8221; button and searching for &#8220;HTML&#8221;. Check it out to add some custom code to your site!' ); ?></p>
						<?php else : ?>
							<p><?php _e( 'Did you know there is a &#8220;Custom HTML&#8221; widget now? You can find it by scanning the list of available widgets on this screen. Check it out to add some custom code to your site!' ); ?></p>
						<?php endif; ?>
						<div class="wp-pointer-buttons">
							<a class="close" href="#"><?php _e( 'Dismiss' ); ?></a>
						</div>
					</div>
					<div class="wp-pointer-arrow">
						<div class="wp-pointer-arrow-inner"></div>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( ! in_array( 'text_widget_paste_html', $dismissed_pointers, true ) ) : ?>
				<div hidden class="wp-pointer paste-html-pointer wp-pointer-top">
					<div class="wp-pointer-content">
						<h3><?php _e( 'Did you just paste HTML?' ); ?></h3>
						<p><?php _e( 'Hey there, looks like you just pasted HTML into the &#8220;Visual&#8221; tab of the Text widget. You may want to paste your code into the &#8220;Text&#8221; tab instead. Alternately, try out the new &#8220;Custom HTML&#8221; widget!' ); ?></p>
						<div class="wp-pointer-buttons">
							<a class="close" href="#"><?php _e( 'Dismiss' ); ?></a>
						</div>
					</div>
					<div class="wp-pointer-arrow">
						<div class="wp-pointer-arrow-inner"></div>
					</div>
				</div>
			<?php endif; ?>

			<p>
				<label for="{{ elementIdPrefix }}text" class="screen-reader-text"><?php esc_html_e( 'Content:' ); ?></label>
				<textarea id="{{ elementIdPrefix }}text" class="widefat text wp-editor-area" style="height: 200px" rows="16" cols="20"></textarea>
			</p>
		</script>
		<?php
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['price'] = strip_tags($new_instance['price']);
        $instance['currency'] = strip_tags($new_instance['currency']);
        $instance['duration'] = strip_tags($new_instance['duration']);
        $instance['service'] = strip_tags($new_instance['service']);
        $instance['color'] = strip_tags($new_instance['color']);
        $instance['image'] = strip_tags($new_instance['image']);


		return $instance;
	}
	
	function widget($args, $instance){
		//global $id_category;
		extract($args);
		$title = esc_attr($instance['title']);
		$price	 = esc_attr($instance['price']);
		$currency	 = esc_attr($instance['currency']);
		$duration = esc_attr($instance['duration']);
		$service	 = esc_attr($instance['service']);
		$color	 = esc_attr($instance['color']);
		$image	 = esc_attr($instance['image']);
		$text = $instance['text']



		?>
		<style>
			.price_list .pl_pro .pl_thumb .pl_title h4::after{
				border-right-color: inherit;
			}
			.price_list .pl_pro .pl_thumb .pl_title h4::before{
				border-left-color: inherit;
			}
		</style>
        <div class="col-lg-4 col-xl-4">
            <div class="pl_pro">
                <div class="pl_thumb">
                    <a href="#">
                        <img src="<?php echo $image?>" alt="<?php echo $title?>" class="img-fluid">
                    </a>
                    <div class="pl_title">
                        <h4 style="background: <?php echo $color?>; border-color: <?php echo $color;?>"><?php echo $title?></h4>
                    </div>
                    <div class="pl_price" style="background: <?php echo $color?>">
                        <?php echo $price?>
                        <?php echo $currency?>
                        <span><?php echo $duration?></span>
                    </div>
                </div>
                <div class="pl_list">
                    <?php echo $text?>
                </div>
                <div class="pl_form" style="background: <?php echo $color?>">
                	<a type="submit" class="btn btn-primary" data-toggle="modal" data-target="#muangay"><span><?php _e( 'Buy Now', 'gemi' ) ?></span></a>
                </div>
            </div>
        </div>
		<?php
		echo $after_widget;

	}

}