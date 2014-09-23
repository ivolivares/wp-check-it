<?php
// Path and URL
define("_dir", dirname(__FILE__));
define("_url", plugin_dir_url( __FILE__ ));

// Requires
require _dir . '/activation.controll.class.php';
require _dir . '/checks.view.class.php';

/**
*
* Plugin Name: Check-it
* Plugin URI: https://github.com/ivolivares/wp-check-it
* Description: [CHECK-IT] A plugin that defines flags behind the wp-pages.
* Version: 1.0
* Author: Mediastream
* Author URI: http://www.mediastre.am
*
**/

function checkit_add_menu()
{
	if (function_exists('add_options_page'))
	{
		add_menu_page('Checks - Check-it', 'Checks', 8, basename(__FILE__), array('views_Checkit','checkit_view'), _url . '/template/icon.png', 3);
		// add sub-menu pages
		add_submenu_page('check-it.php', 'Check Add - Check-it', 'Check-it add', 8, 'checkit-add', array('views_Checkit','checkit_panel'));
	}
}

if(function_exists('add_action'))
{
	add_action('admin_menu', 'checkit_add_menu' );
	add_action('change_status', array('checkit_ListTable', 'change_status') );
}

if(function_exists('add_filter'))
{
	add_filter('checkit', array('views_Checkit', 'checkit_get') );
}

// Activation
register_activation_hook( __FILE__, array( 'activation_Checkit', 'install' ) );
register_deactivation_hook( __FILE__, array( 'activation_Checkit', 'uninstall' ) );
//add_action('deactivate_check-it/check-it.php', array( 'activation_Checkit', 'uninstall' ) );