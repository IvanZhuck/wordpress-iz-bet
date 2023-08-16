<?php

declare(strict_types=1);

namespace IzBet;

/**
 * Manages CSS and JS assets
 */
final class Assets
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', 'enqueueEditorAssets');
        add_action('enqueue_block_assets', 'enqueueCommonAssets');
        add_action('wp_print_styles', 'renderHeadStyles');
        add_action('admin_head', 'renderHeadStyles');
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
                --text-color: ' . apply_filters('iz_bet_style_text_color', 'var(--wp--preset--color--secondary, #247DE0)') . ';
                --border-color: ' . apply_filters('iz_bet_style_border_color', 'var(--wp--preset--color--secondary, #247DE0)') . ';
                --tooltip-text-color: ' . apply_filters('iz_bet_style_tooltip_text_color', 'var(--wp--preset--color--base, #fff)') . ';
                --tooltip-background-color: ' . apply_filters('iz_bet_style_tooltip_background_color:', 'var(--wp--preset--color--contrast, rgba(0, 010, 030, .85))') . ';
            }
        </style>';
    }
}
