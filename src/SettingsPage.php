<?php

declare(strict_types=1);

namespace Izbet;

/**
 * Admin Settings Page
 */
class SettingsPage
{
    private string $optionGroup = 'izbet';
    private string $optionName = 'izbet_options';

    public function __construct()
    {
        add_action('admin_init', [$this, 'initSettingsPage']);
        add_action('admin_menu', [$this, 'addSettingsPageToMenu']);
        add_action('init', [$this, 'applySettings']);
    }

    /**
     * Applies custom settings instead of defaults
     */
    public function applySettings(): void
    {
        $options = get_option($this->optionName);

        add_filter('izbet_style_text_color', function () use ($options) {
            return $options['style_text_color'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TEXT_COLOR;
        }, 10);

        add_filter('izbet_style_border_color', function () use ($options) {
            return $options['style_border_color'] ?? IZBET_PLUGIN_STYLE_DEFAULT_BORDER_COLOR;
        }, 10);

        add_filter('izbet_style_tooltip_text_color', function () use ($options) {
            return $options['style_tooltip_text_color'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_TEXT_COLOR;
        }, 10);

        add_filter('izbet_style_tooltip_background_color', function () use ($options) {
            return $options['style_tooltip_background_color'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BG_COLOR;
        }, 10);
    }

    /**
     * Registers settings and creates settings page sections
     */
    public function initSettingsPage(): void
    {
        $this->registerSettings();

        add_settings_section(
            'izbet-settings-section-colors',
            __('Colors', 'iz-block-editor-tooltips'),
            [$this, 'izbetSettingsSectionColorsCallback'],
            'izbet-settings'
        );
    }

    /**
     * Displays settings page
     */
    public function renderSettingsPageContent(): void
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        Template::instance()->render('settings-page');
    }

    /**
     * Displays a top part of the section "Colors" (between headline and fields)
     */
    public function izbetSettingsSectionColorsCallback(array $args): void
    {
        Template::instance()->render('sections/color-settings/top', $args);
    }

    /**
     * Displays a color picker field
     */
    public function renderColorField(array $args): void
    {
        Template::instance()->render('fields/color-picker', $args);
    }

    /**
     * Adds the settings page to the admin menu
     */
    public function addSettingsPageToMenu(): void
    {
        add_submenu_page(
            'options-general.php',
            __('IZ Block Editor Tooltips Settings', 'iz-block-editor-tooltips'),
            __('IZ BET Setting', 'iz-block-editor-tooltips'),
            'manage_options',
            'izbet-settings',
            [$this, 'renderSettingsPageContent']
        );
    }

    /**
     * Adds plugin options to WP
     */
    private function registerSettings(): void
    {
        register_setting($this->optionGroup, $this->optionName);

        $this->registerFields();
    }

    /**
     * Init settings page fields
     */
    private function registerFields(): void
    {
        $options = get_option($this->optionName);

        add_settings_field(
            'izbet-style-text-color-field',
            __('Text Color', 'iz-block-editor-tooltips'),
            [$this, 'renderColorField'],
            'izbet-settings',
            'izbet-settings-section-colors',
            [
                'value' => $options['style_text_color'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TEXT_COLOR,
                'label_for' => 'style_text_color'
            ]
        );

        add_settings_field(
            'izbet-style-border-color-field',
            __('Border Color', 'iz-block-editor-tooltips'),
            [$this, 'renderColorField'],
            'izbet-settings',
            'izbet-settings-section-colors',
            [
                'value' => $options['style_border_color'] ?? IZBET_PLUGIN_STYLE_DEFAULT_BORDER_COLOR,
                'label_for' => 'style_border_color'
            ]
        );

        add_settings_field(
            'izbet-style-tooltip-text-color-field',
            __('Tooltip Text Color', 'iz-block-editor-tooltips'),
            [$this, 'renderColorField'],
            'izbet-settings',
            'izbet-settings-section-colors',
            [
                'value' => $options['style_tooltip_text_color'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_TEXT_COLOR,
                'label_for' => 'style_tooltip_text_color'
            ]
        );

        add_settings_field(
            'izbet-style-tooltip-background-color-field',
            __('Tooltip Background Color', 'iz-block-editor-tooltips'),
            [$this, 'renderColorField'],
            'izbet-settings',
            'izbet-settings-section-colors',
            [
                'value' => $options['style_tooltip_background_color'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BG_COLOR,
                'label_for' => 'style_tooltip_background_color'
            ]
        );
    }
}
