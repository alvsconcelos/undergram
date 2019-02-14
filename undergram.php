<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://underbits.com.br
 * @since             1.0.0
 * @package           Undergram
 *
 * @wordpress-plugin
 * Plugin Name:       undergram
 * Plugin URI:        https://underbits.com.br
 * Description:       A Wordpress widget plugin that shows the last 3 pictures of a Instagram profile.
 * Version:           1.0.0
 * Author:            Underbits
 * Author URI:        https://underbits.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       undergram
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-undergram-activator.php
 */
function activate_undergram() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-undergram-activator.php';
	Undergram_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-undergram-deactivator.php
 */
function deactivate_undergram() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-undergram-deactivator.php';
	Undergram_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_undergram' );
register_deactivation_hook( __FILE__, 'deactivate_undergram' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

// require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-undergram.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_undergram() {

	$plugin = new Undergram();
	$plugin->run();

}
run_undergram();
