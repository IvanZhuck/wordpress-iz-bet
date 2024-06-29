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

        add_filter('izbet_style_tooltip_font_size', function () use ($options) {
            return $options['style_tooltip_font_size'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_FONT_SIZE;
        }, 10);

        add_filter('izbet_style_tooltip_padding', function () use ($options) {
            return $options['style_tooltip_padding'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_PADDING;
        }, 10);

        add_filter('izbet_style_tooltip_border_radius', function () use ($options) {
            return $options['style_tooltip_border_radius'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BORDER_RADIUS;
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

        add_settings_section(
            'izbet-settings-section-sizes',
            __('Sizes', 'iz-block-editor-tooltips'),
            [$this, 'izbetSettingsSectionSizesCallback'],
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
     * Displays a top part of the section "Sizes"
     */
    public function izbetSettingsSectionSizesCallback(array $args): void
    {
        Template::instance()->render('sections/size-settings/top', $args);
    }

    /**
     * Displays a color picker field
     */
    public function renderColorField(array $args): void
    {
        Template::instance()->render('fields/color-picker', $args);
    }

    /**
     * Displays a selector field
     */
    public function renderSelectorField(array $args): void
    {
        Template::instance()->render('fields/size-selector', $args);
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

        add_settings_field(
            'izbet-style-tooltip-font-size-field',
            __('Tooltip Font Size', 'iz-block-editor-tooltips'),
            [$this, 'renderSelectorField'],
            'izbet-settings',
            'izbet-settings-section-sizes',
            [
                'value' => $options['style_tooltip_font_size'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_FONT_SIZE,
                'label_for' => 'style_tooltip_font_size',
                'options' => [
                    'XXS' => '.7rem',
                    'XS' => '.8rem',
                    'S' => '.9rem',
                    'M' => '1rem',
                    'L' => '1.1rem',
                    'XL' => '1.2rem',
                    'XXL' => '1.5rem',
                ]
            ]
        );

        add_settings_field(
            'izbet-style-tooltip-padding-field',
            __('Tooltip Padding', 'iz-block-editor-tooltips'),
            [$this, 'renderSelectorField'],
            'izbet-settings',
            'izbet-settings-section-sizes',
            [
                'value' => $options['style_tooltip_padding'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_PADDING,
                'label_for' => 'style_tooltip_padding',
                'options' => [
                    'XXS' => '.2rem',
                    'XS' => '.4rem',
                    'S' => '.6rem',
                    'M' => '.8rem',
                    'L' => '1rem',
                    'XL' => '1.1rem',
                    'XXL' => '1.3rem',
                ]
            ]
        );

        add_settings_field(
            'izbet-style-tooltip-border-radius-field',
            __('Tooltip Border Radius', 'iz-block-editor-tooltips'),
            [$this, 'renderSelectorField'],
            'izbet-settings',
            'izbet-settings-section-sizes',
            [
                'value' => $options['style_tooltip_border_radius'] ?? IZBET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BORDER_RADIUS,
                'label_for' => 'style_tooltip_border_radius',
                'options' => [
                    'None' => '0',
                    'S' => '.3rem',
                    'M' => '.5rem',
                    'L' => '.8rem',
                ]
            ]
        );
    }
}
