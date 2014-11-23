<?php
/*
Plugin Name: Tynt Insight for WordPress
Plugin URI: http://thisismyurl.com/downloads/tynt-insight-for-wordpress/
Description: Learn what's being copied off your website and how you can leverage this behaviour to get more traffic, more often.
Author: Christopher Ross
Author URI: http://thisismyurl.com/
Version: 1.11.14.07.08
*/

/**
 * Tynt Insight for WordPress core file
 *
 * This file contains all the logic required for the plugin
 *
 * @link			http://wordpress.org/extend/plugins/tynt-insight-for-wordpress/
 *
 * @package 		Tynt Insight for WordPress
 * @copyright		Copyright (c) 2013, Chrsitopher Ross
 * @license			http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 			Tynt Insight for WordPress 1.0
 */



class TyntInsight {
	
	public function __construct() {
		
		add_action( 'init',  array( $this, 'setup' ) );
		register_activation_hook( __FILE__, array( $this, 'update_old_settings' ) );
		
	} /* __construct() */
	
	
	/**
	 * setup the plugin
	 *
	 * @package 		Tynt Insight for WordPress
	 * @author			Christopher Ross <info@thisismyurl.com>
	 *
	 * @since 			Tynt Insight for WordPress 1.1.1.2014.06.27
	 *
	 */
	function setup() {
		
		if ( is_admin() ) {
			 
			/* run if this is the admin area of WordPress to register settings etc */
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'admin_init', array( $this, 'register_settings' ) );
		  
		} else {
			
			/* run on the visitor side of WordPress */
			add_action( 'wp_head', array( $this, 'display_tynt_js' ) );
			
		} /* if( is_admin() ) */
		
	} /* setup() */
	
	
	
	
	
	/**
	 * Register the settings we'll need
	 *
	 * @package 		Tynt Insight for WordPress
	 * @author			Christopher Ross <info@thisismyurl.com>
	 *
	 * @since 			Tynt Insight for WordPress 1.1.1.2014.06.27
	 *
	 */
	function register_settings() { 
	  register_setting( 'main-settings', 'tynt_settings' );
	} /* register_settings() */
	
	
	
	
	
	/**
	 * Add the Tynt Insight settings page to WordPress.org admin panels
	 *
	 * @package 		Tynt Insight for WordPress
	 * @author			Christopher Ross <info@thisismyurl.com>
	 *
	 * @since 			Tynt Insight for WordPress 1.1.0
	 *
	 */
	function admin_menu() {
		
		$settings = add_options_page( __( 'Tynt Insight', 'tynt_insight_for_wordpress' ), 
														__( 'Tynt Insight', 'tynt_insight_for_wordpress' ), 
														'edit_posts', 
														'tynt_insight_for_wordpress', 
														array( $this, 'settings_page' ) 
									);
		
	} /* admin_menu() */
	
	
	
	
	
	/**
	 * Settings page for Tynt Insight.
	 *
	 * @package 		Tynt Insight for WordPress
	 * @author			Christopher Ross <info@thisismyurl.com>
	 *
	 * @since 			Tynt Insight for WordPress 1.1.0
	 *
	 */
	function settings_page() {
		?>
		<div class="wrap">
		<h2><?php _e( 'Settings for Tynt Insight for WordPress', 'tynt_insight_for_wordpress' );?></h2>
		
		<form method="post" action="options.php">
		<?php settings_fields( 'main-settings' ); ?>
		<?php do_settings_sections( 'main-settings' ); ?>
		<label><?php _e( 'Paste your Tynt Insight script', 'tynt_insight_for_wordpress' );?></label><br />
		<textarea name="tynt_settings" rows="10" cols="50" class="large-text code"><?php echo get_option( 'tynt_settings' ); ?></textarea>
		<?php submit_button(); ?>
		</form>
		
		<h3><?php _e( 'Get your Tynt Insight script', 'tynt_insight_for_wordpress' );?></h3>				
		<p><?php echo sprintf( __( 'Tynt Insight for WordPress requires JavaScript code from Tynt to work properly. Please log into your Tynt account any copy the JavaScript into the field above. Your JavaScript is located at %s.', 'tynt_insight_for_wordpress' ),
			'<a href="' . esc_url( 'http://id.tynt.com/script/main' ) . '">' . esc_url( 'http://id.tynt.com/script/main' ) . '</a>' );?></p>
				
		</div>
		<?php
	} /* settings_page() */
	
	
	
	
	
	/**
	 * Displays the Tynt JS in the wp_head() area of WordPress websites
	 *
	 * @package 		Tynt Insight for WordPress
	 * @author			Christopher Ross <info@thisismyurl.com>
	 *
	 * @since 			Tynt Insight for WordPress 1.1.0
	 *
	 */
	function display_tynt_js() {
		
		/* try to load the tynt JS from settings */
		$tynt_setting = get_option( 'tynt_settings' );
		
		/* if found, display the settings */
		if ( ! empty( $tynt_setting )  )
			echo $tynt_setting;	
			
	} /* display_tynt_js() */
	
	
	
	
	
	/**
	 * Check to see if the old settings need to be updated to the new format
	 *
	 * @package 		Tynt Insight for WordPress
	 * @author			Christopher Ross <info@thisismyurl.com>
	 *
	 * @since 			Tynt Insight for WordPress 1.1.1.2014.06.27
	 *
	 */
	function update_old_settings() {
		
		/* fetch the old settings on activation */
		$old_tynt_settings = get_option( 'tynt_insight_for_wordpress' );
		$new_tynt_settings = get_option( 'tynt_insight_for_wordpress' );
		
		/* if the settings are not empty, update the new settings */
		if ( ! empty( $old_tynt_settings ) && empty( $new_tynt_settings ) )
			update_option( 'tynt_settings', $old_tynt_settings );	
		else
			delete_option( 'tynt_insight_for_wordpress' );
		
	} /* update_old_settings() */
	

} /* TyntInsight */






$TyntInsight = new TyntInsight;