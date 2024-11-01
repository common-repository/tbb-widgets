<?php

/*
 * Plugin Name: The Blackest Box's Widgets
 * Plugin URI: http://wordpress.org/extend/plugins/tbb-widgets/
 * Description: 3 advanced widgets, which replace the default Recent Posts, Recent Comments and Text widget.
 * Author: Sebastian Krüger
 * Version: 0.1.1
 * Author URI: http://theblackestbox.net
 * License: GPL2+
 * Text Domain: tbb-widgets
 * Domain Path: /languages/
 */
define('TBB_WIDGETS_VERSION','0.1.1');
define('TBB_WIDGETS_PLUGIN_BASENAME',plugin_basename(__FILE__));

require_once dirname( __FILE__ ) . '/class.tbb-widgets.php';

TBBWidgets::getInstance();