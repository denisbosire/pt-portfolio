<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://thepixeltribe.com
 * @since             1.0.3
 * @package           Pt_Portfolio
 *
 * @wordpress-plugin
 * Plugin Name:       PT portfolio
 * Plugin URI:        https://thepixeltribe.com
 * Description:       Pixel Tribe Portfolio Plugin for building portfolios, you'll need one of our free themes to use with this.
 * Version:           1.2.2
 * Author:            Pixel Tribe
 * Author URI:        https://thepixeltribe.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pt-portfolio
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pt-portfolio-activator.php
 */
function activate_pt_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pt-portfolio-activator.php';
	Pt_Portfolio_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pt-portfolio-deactivator.php
 */
function deactivate_pt_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pt-portfolio-deactivator.php';
	Pt_Portfolio_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pt_portfolio' );
register_deactivation_hook( __FILE__, 'deactivate_pt_portfolio' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

require plugin_dir_path( __FILE__ ) . 'includes/update.php';

require plugin_dir_path( __FILE__ ) . 'includes/class-pt-portfolio.php';

require plugin_dir_path( __FILE__ ) . 'updater/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'http://updates.thepixeltribe.com/draft/update.json',
	__FILE__,
	'pt-portfolio'
);

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pt_portfolio() {

	$plugin = new Pt_Portfolio();
	$plugin->run();

}
run_pt_portfolio();
