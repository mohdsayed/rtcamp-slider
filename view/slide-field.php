<?php
	/**
	 * Will be used to get existing slide data in javascript.
	 */
?>

<div class="slide-fields">
	<p class="image-src-field">
		<label for=""><?php _e( 'Choose Image' , 'rtcamp' ); ?></label>
		<input class="image-src-input" type='text' name='rtc-slider-settings[slides][slide_number][image_src]' value='<?php echo $image_src; ?>' />
		<button class="button-secondary upload_image_button"><?php _e( 'Choose Slider Image' , 'rtcamp' ); ?></button>
		<button class="button-secondary remove-slider-image"><?php _e( 'Remove' , 'rtcamp' ); ?></button>
	</p>
	<p class="title-field">
		<label for=""><?php _e( 'Slide Title' , 'rtcamp' ); ?></label>
		<input type='text' class="title-input" name='rtc-slider-settings[slides][slide_number][title]' value='<?php echo $title; ?>' />
	</p>
	<p class="content-field">
		<label for=""><?php _e( 'Slide Content' , 'rtcamp' ); ?></label>
		<textarea class="content-input" name='rtc-slider-settings[slides][slide_number][content]'><?php echo $content; ?></textarea>
	</p>
	<p class="link-field">
		<label for=""><?php _e( 'Slide Link' , 'rtcamp' ); ?></label>
		<input type='text' class="permalink-input" name='rtc-slider-settings[slides][slide_number][permalink]' value='<?php echo $permalink; ?>' />
	</p>
</div>
