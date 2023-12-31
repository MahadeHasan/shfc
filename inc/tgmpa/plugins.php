<?php

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Genz for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'genz_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function genz_register_required_plugins()
{
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'      => 'Elementor', 'genz',
			'slug'      => 'elementor',
			'required'  => true
		),
		array(
			'name'      => 'Control block Patterns', 'genz',
			'slug'      => 'control-block-patterns',
			'required'  => true
		),
		array(
			'name'               => esc_attr(__('Genz Framework', 'genz')),
			'slug'               => 'genz-framework', // The plugin slug (typically the folder name).
			'source'             => __DIR__ . '/plugins/genz-framework.zip',
			'required'           => true,
			'version'            => '1.0.2',
			'force_activation'   => false,
			'force_deactivation' => false
		),
		array(
			'name'               => esc_attr(__('Control Email Subscriber', 'genz')),
			'slug'               => 'control-email-subscriber', // The plugin slug (typically the folder name).
			'source'             => __DIR__ . '/plugins/control-email-subscriber.zip',
			'required'           => true,
			'version'            => '1.0.0',
			'force_activation'   => false,
			'force_deactivation' => false
		),
		array(
			'name' => __('Contact form 7', 'genz'),
			'slug' => 'contact-form-7',
			'required' => false
		),
		array(
			'name' => __('One Click Demo Import', 'genz'),
			'slug' => 'one-click-demo-import',
			'required' => false
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'genz',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa($plugins, $config);
}
