<?php

/**
 * Plugin Name: IZ Block Editor Tooltips
 * Description: An easy way to implement tooltip element in the WordPress Block Editor
 * Version: 3.4.2
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * Author: Ivan Zhuck
 * Author URI: https://izhuck.ru/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 * Text Domain: iz-block-editor-tooltips
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!defined('IZBET_PLUGIN_DIR_URL')) {
    define('IZBET_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
}

if (!defined('IZBET_PLUGIN_DIR_PATH')) {
    define('IZBET_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}

if (!defined('IZBET_PLUGIN_STYLE_DEFAULT_TEXT_COLOR')) {
    define('IZBET_PLUGIN_STYLE_DEFAULT_TEXT_COLOR', '#247DE0');
}

if (!defined('IZBET_PLUGIN_STYLE_DEFAULT_BORDER_COLOR')) {
    define('IZBET_PLUGIN_STYLE_DEFAULT_BORDER_COLOR', '#247DE0');
}

if (!defined('IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_TEXT_COLOR')) {
    define('IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_TEXT_COLOR', '#FFFFFF');
}

if (!defined('IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BG_COLOR')) {
    define('IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BG_COLOR', 'rgba(0, 010, 030, .85)');
}

if (!defined('IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_FONT_SIZE')) {
    define('IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_FONT_SIZE', '.8rem');
}

if (!defined('IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_PADDING')) {
    define('IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_PADDING', '.6rem');
}

if (!defined('IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BORDER_RADIUS')) {
    define('IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BORDER_RADIUS', '.3rem');
}

require_once(realpath(__DIR__ . '/vendor/autoload.php'));

new \Izbet\Main();
