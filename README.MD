# IZ Block Editor Tooltips

An easy way to implement tooltip element in the WordPress Block Editor

![alt Screencast](https://habrastorage.org/webt/us/o_/uq/uso_uqxzsysmpij_qqni8h6pdm0.gif)

## Description

- This lightweight plugin adds button "Tooltip" to the RichText toolbar. 
- Use it to paste popover tooltips over the words and phrases in your articles.
- You can style tooltips with the admin settings page.
- You can also style tooltips with CSS and using filters:

```php
add_filter('izbet_style_text_color', function() { return '#247DE0'; });
add_filter('izbet_style_border_color', function() { return '#247DE0'; });
add_filter('izbet_style_tooltip_text_color', function() { return '#fff'; });
add_filter('izbet_style_tooltip_background_color', function() { return 'rgba(0, 010, 030, .85)'; });
add_filter('izbet_style_tooltip_font_size', function() { return '.8rem'; });
add_filter('izbet_style_tooltip_padding', function() { return '.6rem'; });
add_filter('izbet_style_tooltip_border_radius', function() { return '.3rem'; });
```

## Building plugin from the development version

- Install PHP dependencies: `composer install`
- Install JS dependencies: `yarn install` or `npm install`
- Compile styles: `yarn run build-styles` or `npm run build-styles`
- Compile JS scripts: `yarn run build-scripts` or `npm run build-scripts`

## Checking code styles
- Run ESLint: `yarn run eslint` or `npm run eslint`
- Run PHP CodeSniffer: `composer run-script phpcs` or `yarn run phpcs` or `npm run phpcs`

## Installation

1. Upload `iz-block-editor-tooltips` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Visit `"Settings" -> "IZ BET Setting"` in the admin menu to set up tooltip colors.

## Changelog

For the plugin’s changelog, please see [the Releases page on GitHub](https://github.com/IvanZhuck/wordpress-iz-bet/releases).