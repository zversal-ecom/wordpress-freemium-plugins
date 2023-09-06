<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://zversal.com/
 * @since             1.0.0
 * @package           Zweather_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       ZWeather Widget
 * Plugin URI:        https://#
 * Description:       ZWeather Widget: Instant City Forecasts
 * Version:           1.0.0
 * Author:            Zversal
 * Author URI:        https://https://zversal.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       zweather-widget
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ZWEATHER_WIDGET_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-zweather-widget-activator.php
 */
function activate_zweather_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zweather-widget-activator.php';
	Zweather_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-zweather-widget-deactivator.php
 */
function deactivate_zweather_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-zweather-widget-deactivator.php';
	Zweather_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_zweather_widget' );
register_deactivation_hook( __FILE__, 'deactivate_zweather_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-zweather-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_zweather_widget() {

	$plugin = new Zweather_Widget();
	$plugin->run();

}
run_zweather_widget();
