<?php
/*
Plugin Name: Pojo Device Widget
Plugin URI: http://wordpress.org/plugins/aryo-widget-device/
Description: Allows to easily control the display of widgets (Visible/Hidden) by the specific device: Desktop, Tablet, Mobile.
Author: Yakir Sitbon, Ariel Klikstein
Version: 1.1.0
Author URI: http://pojo.me/?utm_source=wpadmin&utm_medium=plugin&utm_campaign=device-widget
License: GPLv2 or later


This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'WIDGET_DEVICE_BASE', plugin_basename( __FILE__ ) );

include( 'classes/class-awd-widget-ui.php' );

class AWD_Main {

	public function load_textdomain() {
		load_plugin_textdomain( 'aryo-awd', false, basename( dirname( __FILE__ ) ) . '/language' );
	}
	
	public function __construct() {
		new AWD_Widget_UI();

		add_action( 'plugins_loaded', array( &$this, 'load_textdomain' ) );
	}
	
}
new AWD_Main();

// EOF