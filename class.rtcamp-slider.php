<?php


class Rtcamp_Slider
{
	const FLEXSLIDER_VERSION = '2.4.0';

	/**
	 * Used for the option's name and admin page slug
	 * @var [string]
	 */
	public $slider_options_name  = 'rtc-slider-settings';

	/**
	 * Will contain all the slider saved or default slider settings
	 * @var [array]
	 */
	public $slider_settings;

	/**
	 * Contains the slides key from $slider_settings
	 * @var [array]
	 */
	public $slides;

	/**
	 * Contains the default slides
	 * @var [array]
	 */
	public $default_slides;

	public function __construct()
	{
		add_action( 'wp_enqueue_scripts' , array( $this , 'load_front_styles' )  );
		add_action( 'wp_enqueue_scripts' , array( $this , 'load_front_scripts' ) );
		add_shortcode( 'rtc-slider' 	 , array( $this , 'create_shortcode' ) 	 );
	}

	/**
	 * Used to avoid mixing of php and html. Outputs the mark contained in the file.
	 * @param  [string] $filePath the path of the file from the plugin directory without php extention.
	 * @param  [array] $args arguments that should be available in the file.
	 * @return [html] markup
	 */
	public function render( $filePath, $args = null )
	{
		( $args ) ? extract( $args ) : null;

		ob_start();

		include ( RTCAMP_SLIDER__PLUGIN_DIR . $filePath . '.php' );
		$template = ob_get_contents();

		ob_end_clean();

		return $template;
	}

	public function load_front_styles()
	{
		wp_register_style( 'rtc-flexslider', RTCAMP_SLIDER__PLUGIN_URL.'css/vendor/flexslider.css', array(), self::FLEXSLIDER_VERSION , 'all' );
		wp_enqueue_style( 'rtc-flexslider' );
	}

	public function load_front_scripts()
	{
		wp_register_script( 'rtc-flexslider', RTCAMP_SLIDER__PLUGIN_URL.'js/vendor/jquery.flexslider.js', array( 'jquery' ), self::FLEXSLIDER_VERSION , true );
		wp_enqueue_script( 'rtc-flexslider' );
	}

	public function create_shortcode( $atts )
	{
		if( ! $this->get_slides() ) return;

		$a = shortcode_atts( array(
			'width'     => '100%',
			'align'     => 'left',
			'animation' => 'slide',
		), $atts );

		return $this->render(
					apply_filters( 'rtcamp_slider_template' , '/view/flexslider-template' , $a ),
					$this->validate_shorcode_values( $a )
					);
	}

	public function validate_shorcode_values( $a )
	{
		//You never know what they would put there.
		$width = (int) preg_replace('/[^0-9]/', '', $a['width']);
		$width = ( $width <= 100 ) ? $width . '%' : '100%';

		switch ($a['align']) {
			case 'center':
				$align = 'rtc-slider-align-center';
				break;
			case 'right':
				$align = 'rtc-slider-align-right';
				break;
			default:
				$align = '';
				break;
		}

		$animation = ( $a['animation'] === 'fade' ) ? 'fade' : 'slide';

		return array(
				'slides'    => $this->slides,
				'width'     => $width,
				'align'     => $align,
				'animation' => $animation
			);
	}

	public function get_slides()
	{
		$this->default_slides = array(
			'slides' => array(
				array(
					'image_src' => RTCAMP_SLIDER__PLUGIN_URL . 'images/demo-1.jpg',
					'title'     => __( 'Demo Slide One' , 'rtcamp' ),
					'content'   => '',
					'permalink' => '',
				 	 ),
				array(
					'image_src' => RTCAMP_SLIDER__PLUGIN_URL . 'images/demo-2.jpg',
					'title'     => __( 'Demo Slide Two' , 'rtcamp' ),
					'content'   => '',
					'permalink' => '',
				 	 )
				)
								);
		$this->slider_settings = (array) get_option( $this->slider_options_name , apply_filters( 'rtcamp_slider_default_slides' , $this->default_slides ) );
		$this->slides = ( isset( $this->slider_settings['slides'] ) ) ? $this->slider_settings['slides'] : false ;

		return $this->slides;
	}

}

new Rtcamp_Slider();
