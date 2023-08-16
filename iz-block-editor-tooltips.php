<?php

/**
 * Plugin Name: IZ Block Editor Tooltips
 * Description: An easy way to implement tooltip element in the WordPress Block Editor
 * Version: 2.0.1
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

require_once 'vendor/autoload.php';

new \IzBet\Main();
