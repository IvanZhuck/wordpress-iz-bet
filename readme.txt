=== IZ Block Editor Tooltips ===
Contributors: ivanzhuck
Tags: tooltips, block editor tooltips, gutenberg tooltips, richtext tooltips
Requires at least: 5.9
Tested up to: 6.6
Stable tag: 3.4.2
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

An easy way to implement tooltip element in the WordPress Block Editor

== Description ==

This lightweight plugin adds button "Tooltip" to the RichText toolbar.

Use it to paste popover tooltips over the words and phrases in your articles.

You can style tooltips with the admin settings page.

You can also style tooltips with CSS and using filters:

`
add_filter('izbet_style_text_color', function() { return '#247DE0'; });
add_filter('izbet_style_border_color', function() { return '#247DE0'; });
add_filter('izbet_style_tooltip_text_color', function() { return '#fff'; });
add_filter('izbet_style_tooltip_background_color', function() { return 'rgba(0, 010, 030, .85)'; });
add_filter('izbet_style_tooltip_font_size', function() { return '.8rem'; });
add_filter('izbet_style_tooltip_padding', function() { return '.6rem'; });
add_filter('izbet_style_tooltip_border_radius', function() { return '.3rem'; });
`

== Screenshots ==

1. How tooltips look on the page
2. How tooltips look in the editor
3. Settings page

== How to contribute ==

If you want to help me develop the plugin please visit its repository on GitHub: [https://github.com/IvanZhuck/wordpress-iz-bet](https://github.com/IvanZhuck/wordpress-iz-bet). The repository contains the source code and tools for development.

== Installation ==

1. Upload `iz-block-editor-tooltips` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Visit "Settings" -> "IZ BET Setting" to set up tooltip colors.

== Changelog ==

= 3.4.2 =
* Tested with WordPress 6.6

= 3.4.1 =
* Fixed filter names in readme
* Fixed string for translation

= 3.4.0 =
* Added custom size settings
* Tested with WordPress 6.5.5

= 3.3.0 =
* Tested with WordPress 6.5
* Fixed tooltip editor popover position
* Fixed new lines inside tooltip content

= 3.2.3 =
* Updated readme.txt

= 3.2.2 =
* Tested with WordPress 6.4.2
* Added screenshots

= 3.2.1 =
* Updated output escaping

= 3.2.0 =
* Tested with WordPress 6.4.1
* Added variable escaping

= 3.1.1 =
* Updated @wordpress/eslint-plugin version
* Updated readme.txt

= 3.1.0 =
* Updated plugin text prefix
* Updated plugin text domain
* Changed the way to read json config files

Please visit [the Releases page on GitHub](https://github.com/IvanZhuck/wordpress-iz-bet/releases) to see the full plugin’s changelog,