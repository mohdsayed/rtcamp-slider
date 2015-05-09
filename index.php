<?php

/*
  Plugin Name: rtCamp Slider
  Plugin URI: https://rtcamp.com/
  Description: Gives the option to show slider with shortcode with customized settings.
  Version: 1.0.0
  Author: Sayed Taqui
  Text Domain: rtcamp
  Author URI: http://supernovathemes.com
  License: GNU General Public License, v2 (or newer)
 */


/*
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

//Exit if accessed directly.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//Setting some constants
define( 'RTCAMP_SLIDER_VERSION', '1.0.0' );
define( 'RTCAMP_SLIDER__MINIMUM_WP_VERSION', '3.1' );
define( 'RTCAMP_SLIDER__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'RTCAMP_SLIDER__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


//Including file
require_once RTCAMP_SLIDER__PLUGIN_DIR . '/class.rtcamp-slider.php';
require_once RTCAMP_SLIDER__PLUGIN_DIR . '/class.rtcamp-slider-admin.php';




