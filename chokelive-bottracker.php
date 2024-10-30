<?php
/**
 * @package ChokeLive BotTracker
 * @version 1.0
 */
/*
Plugin Name: ChokeLive BotTracker
Plugin URI: http://www.chokelive.com
Description: This pulgin is using for tracking the history of Bot that ever visited to your blog site
Author: Chokeumnuay Khowsakool
Version: 1.0
Author URI: http://www.chokelive.com
License: GPL
*/

/*  Copyright 2013  ChokeLive BotTracker  (email : chokelive@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if(!class_exists('chokelive_bottrack'))
{
	class chokelive_bottrack
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// Initialize Settings
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$chokelive_bottrack_settings = new chokelive_bottrack_settings();
			
			// Initial Widget
			require_once(sprintf("%s/widgets/cb_widgets.php", dirname(__FILE__))); 
			$CB_widgets = new chokelive_bottrack_widgets(); 

			
		} // END public function __construct

		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			// Do nothing
		} // END public static function activate

		/**
		 * Deactivate the plugin
		 */		
		public static function deactivate()
		{
			// Do nothing
		} // END public static function deactivate
	} // END class WP_Plugin_Template
} // END if(!class_exists('WP_Plugin_Template'))


if(class_exists('chokelive_bottrack'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('chokelive_bottrack', 'activate'));
	register_deactivation_hook(__FILE__, array('chokelive_bottrack', 'deactivate'));

	// instantiate the plugin class
	$chokelive_bottrack = new chokelive_bottrack();

	 // Add a link to the settings page onto the plugin page
    if(isset($chokelive_bottrack))
    {
        // Add the settings link to the plugins page
        function plugin_settings_link($links)
        { 
            $settings_link = '<a href="options-general.php?page=chokelive_bottrack">Settings</a>'; 
            array_unshift($links, $settings_link); 
            return $links; 
        }

        $plugin = plugin_basename(__FILE__); 
        add_filter("plugin_action_links_$plugin", 'plugin_settings_link');
    }

}

?>
