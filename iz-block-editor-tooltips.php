<?php

/**
 * Plugin Name: IZ Block Editor Tooltips
 * Description: An easy way to implement tooltip element in the WordPress Block Editor
 * Version: 3.0.0
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * Author: Ivan Zhuck
 * Author URI: https://izhuck.ru/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 * Text Domain: iz-bet
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!defined('IZ_BET_PLUGIN_DIR_URL')) {
    define('IZ_BET_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
}

if (!defined('IZ_BET_PLUGIN_DIR_PATH')) {
    define('IZ_BET_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}

if (!defined('IZ_BET_PLUGIN_STYLE_DEFAULT_TEXT_COLOR')) {
    define('IZ_BET_PLUGIN_STYLE_DEFAULT_TEXT_COLOR', '#247DE0');
}

if (!defined('IZ_BET_PLUGIN_STYLE_DEFAULT_BORDER_COLOR')) {
    define('IZ_BET_PLUGIN_STYLE_DEFAULT_BORDER_COLOR', '#247DE0');
}

if (!defined('IZ_BET_PLUGIN_STYLE_DEFAULT_TOOLTIP_TEXT_COLOR')) {
    define('IZ_BET_PLUGIN_STYLE_DEFAULT_TOOLTIP_TEXT_COLOR', '#FFFFFF');
}

if (!defined('IZ_BET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BG_COLOR')) {
    define('IZ_BET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BG_COLOR', 'rgba(0, 010, 030, .85)');
}

require_once 'vendor/autoload.php';

new \IzBet\Main();
