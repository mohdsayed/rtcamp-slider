<?php

/**
 * Creates admin page for the slider
 */

class Rtcamp_Slider_Admin extends Rtcamp_Slider
{
		protected $section_group       = 'rtc_slider_group';
		protected $default_slide_count = 1;

		public function __construct()
		{
			add_action( 'admin_menu', 			 array( $this , 'add_options_page') 	);
			add_action( 'admin_init', 			 array( $this , 'slider_admin_init' ) 	);
			add_action( 'admin_enqueue_scripts', array( $this , 'load_admin_styles' ) 	);
			add_action( 'admin_enqueue_scripts', array( $this , 'load_admin_scripts' )	);
		}

		public function add_options_page()
		{
			add_options_page(
								__( 'Rtcamp Slider Settings' , 'rtcamp' ),
								__( 'Rtcamp Slider' , 'rtcamp' ),
								'manage_options', 		  		//capability
								$this->slider_options_name, 	//menu-slug
								array( $this, 'create_page' ) 	//callback function
							);
		}

		public function create_page()
		{
			echo $this->render( '/view/admin-page' , array(
							'section_group'      => $this->section_group,
							'settings_menu_slug' => $this->slider_options_name
							));
		}

		public function slider_admin_init()
		{
			// Create Setting
			register_setting(
					$this->section_group, 				//settings group name
					$this->slider_options_name,   		//The name of an option to sanitize and save.
					array( $this, 'validate_inputs' )
					);

			 $settings_section = 'rtc_add_slides_section';

			 //Create section of Page
			 add_settings_section(
				 $settings_section, 					//Id
				 __( 'Add Slides', 'rtcamp' ),  		//Title of the section.
				 false,									//Callback for output
				 $this->slider_options_name 			//menu_slug
			 );

			 $this->get_slides();
			 $this->_add_settings_field( $settings_section , $this->slider_settings );

		}

		public function _add_settings_field( $settings_section , $slider_settings )
		{
			$slides      		= ( isset($slider_settings['slides']) ) ? $slider_settings['slides'] : '';
			$slide_count 		= ( is_array($slides) && count($slides) > $this->default_slide_count ) ? count($slides) : $this->default_slide_count ;

			 //Add fields to that section
			 for ( $i = 0; $i < $slide_count; $i++ )
			 {
			 	$slide_key = 'slide-' . $i;
			 	$slide_number = $i + 1;

				$image_src  = ( isset($slides[$i]['image_src']) ) ? esc_url( $slides[$i]['image_src'] ) 	: '';
				$title    	= ( isset($slides[$i]['title']) )     ? esc_attr( $slides[$i]['title'] ) 		: '';
				$content    = ( isset($slides[$i]['content']) )   ? esc_attr( $slides[$i]['content'] ) 		: '';
				$permalink  = ( isset($slides[$i]['permalink']) ) ? esc_url($slides[$i]['permalink']) 		: '';

			 	 add_settings_field(
			 		 'rtc_slide_' . $i, 					//id
			 		 __('Slide ', 'rtcamp' ) .$slide_number, //title
			 		 array( $this, 'single_slider_field' ), //callback
			 		 $this->slider_options_name, 			//page
			 		 $settings_section, 					//Section
			 		 array(
							'image_src' => $image_src,
							'title'     => $title,
							'content'   => $content,
							'permalink' => $permalink,
							'count' 	=> $i
			 		 	)
			 	 );
			 }
		}

		public function single_slider_field( $arg )
		{
		    echo $this->render( '/view/slide-field', $arg );
		}

		public function validate_inputs( $input )
		{
	       $output = array();

	       $slides = $input['slides'];

	       if( $slides )
	       {
	       	foreach ( $slides as $key => $slide )
	       	{
	   			//Image url
	   			$output['slides'][$key]['image_src'] = esc_url( $slides[$key]['image_src'] );
	   			
	   			//Title
	   			$output['slides'][$key]['title']     = wp_filter_nohtml_kses( $slides[$key]['title'] );
	   			
	   			//Content
	   			$output['slides'][$key]['content']   = wp_filter_post_kses( $slides[$key]['content'] );
	   			
	   			//Permalink
	   			$output['slides'][$key]['permalink'] = esc_url( $slides[$key]['permalink'] );					

	       	}
	       }

	       return apply_filters( 'rtcamp_slider_input_validation', $output, $input );

		}

		public function load_admin_styles()
		{
			wp_register_style( 'rtc-jquery-ui', RTCAMP_SLIDER__PLUGIN_URL.'css/vendor/jquery-ui.css', array(), RTCAMP_SLIDER_VERSION , 'all' );
			wp_register_style( 'rtc-admin-css', RTCAMP_SLIDER__PLUGIN_URL.'css/admin.css', array( 'thickbox', 'rtc-jquery-ui' ), RTCAMP_SLIDER_VERSION , 'all' );


			if ( isset($_GET['page']) && $_GET['page'] === $this->slider_options_name ){
				wp_enqueue_style( 'rtc-admin-css' );
			}
		}

		public function load_admin_scripts()
		{
			wp_register_script(
								'rtc-admin-script',
								RTCAMP_SLIDER__PLUGIN_URL.'js/admin.js',
								array(
										'backbone',
										'jquery-ui-sortable',
										'jquery-ui-accordion',
										'media-upload',
										'thickbox'
									),
								RTCAMP_SLIDER_VERSION ,
								true
							   );

			if ( isset($_GET['page']) && $_GET['page'] === $this->slider_options_name )
			{
				wp_enqueue_media();
				wp_enqueue_script( 'rtc-admin-script' );

				wp_localize_script( 'rtc-admin-script' , 'rtc_translated_texts' , array(
							'choose_slider_image' => __( 'Choose Slider Image', 'rtcamp' )
				));
			}
		}
}

new Rtcamp_Slider_Admin();



