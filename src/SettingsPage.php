<?php

declare(strict_types=1);

namespace IzBet;

/**
 * Admin Settings Page
 */
class SettingsPage
{
    private string $optionGroup = 'iz_bet';
    private string $optionName = 'iz_bet_options';

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

        add_filter('iz_bet_style_text_color', function () use ($options) {
            return $options['style_text_color'] ?? IZ_BET_PLUGIN_STYLE_DEFAULT_TEXT_COLOR;
        }, 10);

        add_filter('iz_bet_style_border_color', function () use ($options) {
            return $options['style_border_color'] ?? IZ_BET_PLUGIN_STYLE_DEFAULT_BORDER_COLOR;
        }, 10);

        add_filter('iz_bet_style_tooltip_text_color', function () use ($options) {
            return $options['style_tooltip_text_color'] ?? IZ_BET_PLUGIN_STYLE_DEFAULT_TOOLTIP_TEXT_COLOR;
        }, 10);

        add_filter('iz_bet_style_tooltip_background_color', function () use ($options) {
            return $options['style_tooltip_background_color'] ?? IZ_BET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BG_COLOR;
        }, 10);
    }

    /**
     * Registers settings and creates settings page sections
     */
    public function initSettingsPage(): void
    {
        $this->registerSettings();

        add_settings_section(
            'iz-bet-settings-section-colors',
            __('Colors', 'iz-bet'),
            [$this, 'izBetSettingsSectionColorsCallback'],
            'iz-bet-settings'
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
    public function izBetSettingsSectionColorsCallback(array $args): void
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
            __('IZ Block Editor Tooltips Settings', 'iz-bet'),
            __('IZ BET Setting', 'iz-bet'),
            'manage_options',
            'iz-bet-settings',
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
            'iz-bet-style-text-color-field',
            __('Text Color', 'iz-bet'),
            [$this, 'renderColorField'],
            'iz-bet-settings',
            'iz-bet-settings-section-colors',
            [
                'value' => $options['style_text_color'] ?? IZ_BET_PLUGIN_STYLE_DEFAULT_TEXT_COLOR,
                'label_for' => 'style_text_color'
            ]
        );

        add_settings_field(
            'iz-bet-style-border-color-field',
            __('Border Color', 'iz-bet'),
            [$this, 'renderColorField'],
            'iz-bet-settings',
            'iz-bet-settings-section-colors',
            [
                'value' => $options['style_border_color'] ?? IZ_BET_PLUGIN_STYLE_DEFAULT_BORDER_COLOR,
                'label_for' => 'style_border_color'
            ]
        );

        add_settings_field(
            'iz-bet-style-tooltip-text-color-field',
            __('Tooltip Text Color', 'iz-bet'),
            [$this, 'renderColorField'],
            'iz-bet-settings',
            'iz-bet-settings-section-colors',
            [
                'value' => $options['style_tooltip_text_color'] ?? IZ_BET_PLUGIN_STYLE_DEFAULT_TOOLTIP_TEXT_COLOR,
                'label_for' => 'style_tooltip_text_color'
            ]
        );

        add_settings_field(
            'iz-bet-style-tooltip-background-color-field',
            __('Tooltip Background Color', 'iz-bet'),
            [$this, 'renderColorField'],
            'iz-bet-settings',
            'iz-bet-settings-section-colors',
            [
                'value' => $options['style_tooltip_background_color'] ?? IZ_BET_PLUGIN_STYLE_DEFAULT_TOOLTIP_BG_COLOR,
                'label_for' => 'style_tooltip_background_color'
            ]
        );
    }
}
