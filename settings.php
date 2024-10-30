<?php

if(!class_exists('chokelive_bottrack_settings'))
{
	class chokelive_bottrack_settings
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} // END public function __construct

        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
			// Set up the settings for this plugin
			$this->init_settings();

            // Possibly do additional admin_init tasks
        } // END public static function activate
        
		/** 
		* Initialize some custom settings 
		*/ 
		public function init_settings() 
		{ 
			// register the settings for this plugin 
			register_setting('chokelive_bottrack-group', 'cb_setting_email'); 
			//register_setting('chokelive_bottrack-group', 'setting_b'); 
			
			// add your settings section
        	add_settings_section(
        	    'chokelive_bottrack-section', 
        	    'Email Settings', 
        	    array(&$this, 'settings_section_wp_plugin_template'), 
        	    'chokelive_bottrack'
        	);
        	
        	// add your setting's fields
            add_settings_field(
                'chokelive_bottrack-cb_setting_email', 
                'Email-Address', 
                array(&$this, 'settings_field_input_text'), 
                'chokelive_bottrack', 
                'chokelive_bottrack-section',
                array(
                    'field' => 'cb_setting_email'
                )
            );
			
		} 
		// END public function init_custom_settings() 
		
		
		public function settings_section_wp_plugin_template()
        {
            // Think of this as help text for the section.
            echo 'Enter Email for report Google Bot Tracking';
        }

		 /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        } // END public function settings_field_input_text($args)
		
		public function add_menu()
        {
            // Add a page to manage this plugin's settings
        	add_options_page(
        	    'Chokelive Bottracker Settings', 
        	    'Chokelive Bottracker', 
        	    'manage_options', 
        	    'chokelive_bottrack', 
        	    array(&$this, 'plugin_settings_page')
        	);
        } // END public function add_menu()
		
		 /**
         * Menu Callback
         */		
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}

        	// Render the settings template
        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
		
 
    } // END class WP_Plugin_Template_Settings
} // END if(!class_exists('WP_Plugin_Template_Settings'))

?>