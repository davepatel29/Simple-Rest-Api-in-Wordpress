<?php

/**
 * The plugin bootstrap file.
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://digitalwebinfosoft.com
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Rest Api in Wordpress
 * Plugin URI:        http://digitalwebinfosoft.com
 * Description:       Extends the Simple REST API using Access token and api key.
 * Version:           1.0.0
 * @author     Dave Patel <dave.dwis@gmail.com>
 * Text Domain:       wp-rest-api
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Register Activation and Deactivation Hooks
 * This action is documented in inc/core/class-activator.php
 */

require_once ( dirname( __FILE__ ) . '/inc/core/class-activator.php' );

register_activation_hook( __FILE__, array('Activator', 'activate' ) );

/**
 * The code that runs during plugin deactivation.
 * This action is documented inc/core/class-deactivator.php
 */
require_once ( dirname( __FILE__ ) . '/inc/core/class-deactivator.php' );

register_deactivation_hook( __FILE__, array('Deactivator', 'deactivate' ) );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-sis-rest.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sis_rest()
{
    $plugin = new Sis_Rest();
    $plugin->run();
}
run_sis_rest();
