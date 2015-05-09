<?php
	/**
	 * Renders Rtcamp slider settings page.
	 */
?>

<div class="wrap" id="rtc-slider">
    <h2><?php _e( 'RTcamp Slider Settings', 'rtcamp' ); ?></h2>	
    <form action="options.php" method="post" id="rtcamp-slider-form" >
        <?php 
        		//Output nonce, action, and option_page fields
        		settings_fields( $section_group );

        		//Print out all settings sections added to the settings page.
        		do_settings_sections( $settings_menu_slug );
        ?>
        <div id="rtcamp-accordion" class="rtcamp"></div>
        <button class="button-secondary add-new-button"><?php _e('Add New', 'rtcamp'); ?></button>
        <input name="Submit" type="submit" value="<?php esc_attr_e( 'Save Changes', 'rtcamp' ); ?>" class="button button-primary" />
    </form>
</div>


    <script type="text/template" id="rtcamp-accordion-template">
        <?php include RTCAMP_SLIDER__PLUGIN_DIR . 'view/slide-template.php';  ?>
    </script>