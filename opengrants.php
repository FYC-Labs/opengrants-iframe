<?php
/**
 * Plugin Name: Opengrants
 * Version: 1.0.6
 * Description: This plugin enables a custom iframe to view OpenGrants Portal
 * Author: FYCLabs
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: opengrants
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Hugh Lashbrooke
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load plugin class files.
require_once 'includes/class-opengrants.php';
require_once 'includes/class-opengrants-settings.php';

// Load plugin libraries.
require_once 'includes/lib/class-opengrants-admin-api.php';
require_once 'includes/lib/class-opengrants-dashboard.php';
require_once 'includes/lib/class-opengrants-dashboard.php';

require_once 'includes/lib/plugin-updater.php';

$updater = new PDUpdater(__FILE__);
$updater->set_username('FYC-Labs');
$updater->set_repository('opengrants-iframe');
$updater->initialize();

/**
 * Returns the main instance of opengrants to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object opengrants
 */
function opengrants() {
	$instance = opengrants::instance( __FILE__, '1.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = opengrants_Settings::instance( $instance );
	}

	return $instance;
}

opengrants();
