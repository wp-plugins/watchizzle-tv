<?php
/*
Plugin Name: Watchizzle TV
Plugin URI: http://www.watchizzle.com
Description: Watchizzle TV Online DVR. Live TV and Record TV.
Version: 1.0
Author: Watchizzle
Author URI: http://www.watchizzle.com

/*  Copyright 2009 Watchizzle (email: develop@watchizzle.com)

	About the Wordpress widget implementation:
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

function wp_widget_watchizzle_tv($args) {
	extract($args);
	$options = get_option('widget_watchizzle_tv');
	$title = $options['title'];
	if ( empty($title) )
		$title = 'Watchizzle TV';
?>
		<?php echo $before_widget; ?>
			<?php $title ? print($before_title . $title . $after_title) : null; ?>
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" type="application/x-shockwave-flash" width="170px" height="423px" id="InsertWidget_13cc8bd0-af92-4259-b15e-de3cb6b62b5e" align="middle"><param name="movie" value="http://widgetserver.com/syndication/flash/wrapper/InsertWidget.swf"/><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="menu" value="false" /><param name="flashvars" value="r=2&appId=13cc8bd0-af92-4259-b15e-de3cb6b62b5e" /> <embed src="http://widgetserver.com/syndication/flash/wrapper/InsertWidget.swf"  name="InsertWidget_13cc8bd0-af92-4259-b15e-de3cb6b62b5e"  width="170px" height="423px" quality="high" menu="false" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent" align="middle" flashvars="r=2&appId=13cc8bd0-af92-4259-b15e-de3cb6b62b5e" /></object>
		<?php echo $after_widget; ?>
<?php
}

function wp_widget_watchizzle_tv_control() {
	$options = $newoptions = get_option('widget_watchizzle_tv');
	if ( $_POST["watchizzle-submit"] ) {
		$newoptions['title'] = strip_tags(stripslashes($_POST["watchizzle-title"]));
	}
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('widget_watchizzle_tv', $options);
	}
	$title = attribute_escape($options['title']);
?>
			<p><label for="watchizzle-title"><?php _e('Title:'); ?> <input style="width: 200px;" id="watchizzle-title" name="watchizzle-title" type="text" value="<?php echo $title; ?>" /></label></p>
			<input type="hidden" id="watchizzle-submit" name="watchizzle-submit" value="1" />
<?php
}

function wp_widget_watchizzle_tv_register() {
	$dimension = array('height' => 100, 'width' => 300);
	$class = array('classname' => 'widget_watchizzle_tv');
	wp_register_sidebar_widget('watchizzle', __('Watchizzle TV'), 'wp_widget_watchizzle_tv', $class);
	wp_register_widget_control('watchizzle', __('Watchizzle TV'), 'wp_widget_watchizzle_tv_control', $dimension);
}

add_action('plugins_loaded','wp_widget_watchizzle_tv_register');
?>