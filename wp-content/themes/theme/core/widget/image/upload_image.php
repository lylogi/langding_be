<?php 
/*
	File Name: upload_image.php
*/
add_action('widgets_init','gm_upload_image');
function gm_upload_image(){
	register_widget('GM_upload_image');
}
class GM_upload_image extends WP_Widget{
	function __construct(){
		parent::__construct(
			'gm_upload_image',
			'Widget Upload ảnh ',
			array(
				'Description'	=> 'Widget Upload ảnh'
			)
		);
	}
	function form($instance){
		$default = array(
			'image' => '',
		);
		$instance = wp_parse_args((array) $instance, $default);
		if($instance){
			$image = esc_attr($instance['image']);
		}
		else{
			$image = '';
		}
		?>
			
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
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['image']    = strip_tags($new_instance['image']);
		return $instance;

	}
	function widget($args, $instance){
		
	}
}