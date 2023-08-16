<?php

declare(strict_types=1);

namespace IzBet;

/**
 * Manages CSS and JS assets
 */
class Assets
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueueEditorAssets']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueSettingsPageAssets']);
        add_action('enqueue_block_assets', [$this, 'enqueueCommonAssets']);
        add_action('wp_print_styles', [$this, 'renderHeadStyles']);
        add_action('admin_head', [$this, 'renderHeadStyles']);
    }

    /**
     * Enqueues admin assets
     */
    public function enqueueEditorAssets(): void
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
     * Enqueues settings page assets
     */
    public function enqueueSettingsPageAssets(): void
    {
        $currentPageId = get_current_screen()->id;

        if ($currentPageId !== 'settings_page_iz-bet-settings') {
            return;
        }

        $settingsPageScriptUrl = IZ_BET_PLUGIN_DIR_URL . 'assets/build/js/settings.js';
        $settingsPageScriptAssetPath = IZ_BET_PLUGIN_DIR_PATH . 'assets/build/js/settings.asset.json';

        $settingsPageScriptMeta = json_decode(file_get_contents($settingsPageScriptAssetPath));
        $settingsPageScriptMeta->dependencies[] = 'wp-color-picker';

        wp_enqueue_script(
            'iz-bet-settings',
            $settingsPageScriptUrl,
            $settingsPageScriptMeta->dependencies,
            $settingsPageScriptMeta->version
        );

        wp_enqueue_style('wp-color-picker');
    }

    /**
     * Enqueues common (frontend and backend) assets
     */
    public function enqueueCommonAssets(): void
    {
        $styleUrl = IZ_BET_PLUGIN_DIR_URL . 'assets/build/styles/styles.css';
        $stylePath = IZ_BET_PLUGIN_DIR_PATH . 'assets/build/styles/styles.css';

        wp_enqueue_style('iz-bet-styles', $styleUrl, [], filemtime($stylePath));
    }

    /**
     * Prints CSS variables to page header
     */
    public function renderHeadStyles(): void
    {
        echo '<style>
            .iz-tooltip{
                --text-color: ' . apply_filters('iz_bet_style_text_color', IZ_BET_PLUGIN_STYLE_DEFAULT_TEXT_COLOR) . ';
                --border-color: ' . apply_filters('iz_bet_style_border_color', IZ_BET_PLUGIN_STYLE_DEFAULT_BORDER_COLOR) . ';
                --tooltip-text-color: ' . apply_filters('iz_bet_style_tooltip_text_color', IZ_BET_PLUGIN_STYLE_DEFAULT_TOOLTIP_TEXT_COLOR) . ';
                --tooltip-background-color: ' . apply_filters('iz_bet_style_tooltip_background_color', IZ_BET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BG_COLOR) . ';
            }
        </style>';
    }
}
