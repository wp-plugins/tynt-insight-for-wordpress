<?php
/*
Plugin Name: Tynt Insight for WordPress
Plugin URI: http://regentware.com/software/web-based/wordpress-plugins/tynt-insight-plugin-for-wordpress/
Description: Learn what's being copied off your website and how you can leverage this behaviour to get more traffic, more often.
Author: Christopher Ross
Author URI: http://thisismyurl.com
Version: 0.0.2
*/

/*  Copyright 2008  Christopher Ross  (email : info@thisismyurl.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


add_action('wp_footer', 'cr_tynt_insight_footer_code');


add_action('admin_menu', 'cr_tynt_insight_menu');
add_filter('plugin_action_links', 'cr_tynt_insight_plugin_actions', 10, 2);

register_activation_hook(__FILE__, 'cr_tynt_insight_activate');

function cr_tynt_insight_menu() {
  add_options_page('Tynt Insight for WordPress', 'Tynt Insight for WordPress', 10,'cr_tynt_insight.php', 'cr_tynt_insight_options');
  
}

function cr_tynt_insight_activate() {
	if (!(get_option('cr_tynt_insight_give_credit')))	 	{update_option('cr_tynt_insight_give_credit','1');}
}

function cr_tynt_insight_footer_code($options='') {

		echo "<script type='text/javascript'>tyntVariables = {'ap':'Read more: '};</script> <script type='text/javascript' src='http://tcr.tynt.com/javascripts/Tracer.js?user=".get_option('cr_tynt_user_code')."&amp;st=1'></script>";
	
	global $cr_credit;
	if(get_option('cr_tynt_insight_give_credit') == "1" && !$cr_credit) { 
		echo "<!--  Tynt Insight Plugin for WordPress by Christopher Ross - http://christopherross.ca  -->";
		$cr_credit == true;		
	}
}

function cr_tynt_insight_plugin_actions($links, $file){
	static $this_plugin;

	if( !$this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=cr_tynt_insight.php">' . __('Settings') . '</a>';
		$links = array_merge( array($settings_link), $links); // before other links
	}
	return $links;
}

function cr_tynt_insight_plugin_getupdate() {
}



function cr_tynt_insight_options($options='') {
?>
    
    <div class="wrap">
    <h2>Tynt Insight Plugin for WordPress</h2>
    <form method="post" action="options.php">
    <?php wp_nonce_field('update-options'); ?>
    
    
    <h3>Plugin Settings</h3>
    <table class="form-table">
    
        <tr valign="top">
        <th scope="row">Tynt Usercode</th>
        <td>
        <input name="cr_tynt_user_code" type="text" id="cr_tynt_user_code" value="<?php echo get_option('cr_tynt_user_code'); ?>" />
        <?php if(strlen(get_option('cr_tynt_user_code')) > 5) {?>
		<p><strong><a href='http://id.tynt.com/reports/overview'>View your Tynt stats online</a></strong> to see who's copied your content.</p>
		 <?php } else { ?>
        <p>Before Tynt Insight Plugin for WordPress can work, you'll have to sign up for an account at <a href='http://www.tynt.com/'>http://www.tynt.com/</a> and copy your user code found at <a href='http://id.tynt.com/script/account_script'>http://id.tynt.com/script/account_script</a> into the box above.</p>
        <?php } ?> </td>
        </tr>


        <tr valign="top">
        <th scope="row">Give Credit</th>
        <td>
        <input name="cr_tynt_insight_give_credit" type="checkbox" id="cr_tynt_insight_give_credit" value="1" <?php if(get_option('cr_tynt_insight_give_credit') == "1") {echo  "checked='checked'";} ?> />
        <p>If you'd like to thank me for creating this plugin, please allow my plugin to place a link to my blog in the footer of your website. The link will appear in the HTML code but not on your website. </p>
        </td>
        </tr>
    
    
    </table>
    
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="cr_tynt_user_code,cr_tynt_insight_give_credit" />
    
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
    </form>
    </div>

<?php
}
?>