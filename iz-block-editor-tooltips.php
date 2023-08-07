<?php

declare(strict_types=1);

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

define('IZ_BET_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
define('IZ_BET_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

add_action('admin_enqueue_scripts', function() {
    $editorScriptUrl = IZ_BET_PLUGIN_DIR_URL . 'assets/build/js/editor.js';
    $editorScriptAssetPath = IZ_BET_PLUGIN_DIR_PATH . 'assets/build/js/editor.asset.json';

    $editorStyleUrl = IZ_BET_PLUGIN_DIR_URL . 'assets/build/styles/style.css';
    $editorStylePath = IZ_BET_PLUGIN_DIR_PATH . 'assets/build/styles/style.css';

    $editorScriptMeta = json_decode(file_get_contents($editorScriptAssetPath));

    wp_enqueue_script(
        'iz-bet-editor',
        $editorScriptUrl,
        $editorScriptMeta->dependencies,
        $editorScriptMeta->version
    );

    wp_enqueue_style('iz-bet-editor', $editorStyleUrl, [], filemtime($editorStylePath));
});


