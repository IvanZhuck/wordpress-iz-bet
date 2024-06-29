<?php

declare(strict_types=1);

namespace Izbet;

use stdClass;

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
        $editorScriptUrl = IZBET_PLUGIN_DIR_URL . 'assets/build/js/editor.js';
        $editorScriptAssetPath = IZBET_PLUGIN_DIR_PATH . 'assets/build/js/editor.asset.json';

        $editorStyleUrl = IZBET_PLUGIN_DIR_URL . 'assets/build/styles/editor.css';
        $editorStylePath = IZBET_PLUGIN_DIR_PATH . 'assets/build/styles/editor.css';

        $editorScriptMeta = $this->loadJsonAssetFile($editorScriptAssetPath);

        wp_enqueue_script(
            'izbet-editor',
            $editorScriptUrl,
            $editorScriptMeta->dependencies,
            $editorScriptMeta->version
        );

        wp_enqueue_style('izbet-editor', $editorStyleUrl, [], filemtime($editorStylePath));
    }

    /**
     * Enqueues settings page assets
     */
    public function enqueueSettingsPageAssets(): void
    {
        $currentPageId = get_current_screen()->id;

        if ($currentPageId !== 'settings_page_izbet-settings') {
            return;
        }

        $settingsPageScriptUrl = IZBET_PLUGIN_DIR_URL . 'assets/build/js/settings.js';
        $settingsPageScriptAssetPath = IZBET_PLUGIN_DIR_PATH . 'assets/build/js/settings.asset.json';

        $settingsPageScriptMeta = $this->loadJsonAssetFile($settingsPageScriptAssetPath);
        $settingsPageScriptMeta->dependencies[] = 'wp-color-picker';

        wp_enqueue_script(
            'izbet-settings',
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
        $styleUrl = IZBET_PLUGIN_DIR_URL . 'assets/build/styles/styles.css';
        $stylePath = IZBET_PLUGIN_DIR_PATH . 'assets/build/styles/styles.css';

        wp_enqueue_style('izbet-styles', $styleUrl, [], filemtime($stylePath));
    }

    /**
     * Prints CSS variables to page header
     */
    public function renderHeadStyles(): void
    {
        echo '<style>
            .izbet-tooltip{
                --text-color: ' . esc_html(apply_filters('izbet_style_text_color', IZBET_PLUGIN_STYLE_DEFAULT_TEXT_COLOR)) . ';
                --border-color: ' . esc_html(apply_filters('izbet_style_border_color', IZBET_PLUGIN_STYLE_DEFAULT_BORDER_COLOR)) . ';
                --tooltip-text-color: ' . esc_html(apply_filters('izbet_style_tooltip_text_color', IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_TEXT_COLOR)) . ';
                --tooltip-background-color: ' . esc_html(apply_filters('izbet_style_tooltip_background_color', IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BG_COLOR)) . ';
                --tooltip-font-size: ' . esc_html(apply_filters('izbet_style_tooltip_font_size', IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_FONT_SIZE)) . ';
                --tooltip-padding: ' . esc_html(apply_filters('izbet_style_tooltip_padding', IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_PADDING)) . ';
                --tooltip-border-radius: ' . esc_html(apply_filters('izbet_style_tooltip_border_radius', IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BORDER_RADIUS)) . ';
            }
        </style>';
    }

    /**
     * Load an asset from a local json file
     */
    private function loadJsonAssetFile(string $filePath): stdClass
    {
        ob_start();
        include $filePath;
        $json = ob_get_clean();

        return json_decode($json);
    }
}
