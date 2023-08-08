<?php

/**
 * Plugin Name: IZ Block Editor Tooltips
 * Description: An easy way to implement tooltip element in the WordPress Block Editor
 * Version: 0.0.1
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * Author: Ivan Zhuck
 * Author URI: https://izhuck.ru/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 * Text Domain: iz-bet
 * Domain Path: /languages
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

/**
 * Enqueues admin assets
 */
function iz_enqueue_admin_assets(): void
{
    $editorScriptUrl = IZ_BET_PLUGIN_DIR_URL . 'assets/build/js/editor.js';
    $editorScriptAssetPath = IZ_BET_PLUGIN_DIR_PATH . 'assets/build/js/editor.asset.json';

    $editorStyleUrl = IZ_BET_PLUGIN_DIR_URL . 'assets/build/styles/editor.css';
    $editorStylePath = IZ_BET_PLUGIN_DIR_PATH . 'assets/build/styles/editor.css';

    $editorScriptMeta = json_decode(file_get_contents($editorScriptAssetPath));

    wp_enqueue_script(
        'iz-bet-editor',
        $editorScriptUrl,
        $editorScriptMeta->dependencies,
        $editorScriptMeta->version
    );

    wp_enqueue_style('iz-bet-editor', $editorStyleUrl, [], filemtime($editorStylePath));
}

/**
 * Enqueues common (frontend and backend) assets
 */
function iz_enqueue_common_assets(): void
{
    $styleUrl = IZ_BET_PLUGIN_DIR_URL . 'assets/build/styles/styles.css';
    $stylePath = IZ_BET_PLUGIN_DIR_PATH . 'assets/build/styles/styles.css';

    wp_enqueue_style('iz-bet-styles', $styleUrl, [], filemtime($stylePath));
}

/**
 * Prints CSS variables to page header
 */
function iz_render_head_styles(): void
{
    echo '<style>
            .iz-tooltip{
                --text-color: ' . apply_filters('iz_bet_style_text_color', 'var(--wp--preset--color--secondary, #247DE0)') . ';
                --border-color: ' . apply_filters('iz_bet_style_border_color', 'var(--wp--preset--color--secondary, #247DE0)') . ';
                --tooltip-text-color: ' . apply_filters('iz_bet_style_tooltip_text_color', 'var(--wp--preset--color--base, #fff)') . ';
                --tooltip-background-color: ' . apply_filters('iz_bet_style_tooltip_background_color:', 'var(--wp--preset--color--contrast, rgba(0, 010, 030, .85))') . ';
            }
        </style>';
}

add_action('admin_enqueue_scripts', 'iz_enqueue_admin_assets');
add_action('admin_enqueue_scripts', 'iz_enqueue_common_assets');
add_action('wp_enqueue_scripts', 'iz_enqueue_common_assets');
add_action('wp_head', 'iz_render_head_styles');
add_action('admin_head', 'iz_render_head_styles');
