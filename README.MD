# IZ Block Editor Tooltips

An easy way to implement tooltip element in the WordPress Block Editor

![alt Screencast](https://habrastorage.org/webt/us/o_/uq/uso_uqxzsysmpij_qqni8h6pdm0.gif)

## Description

This lightweight plugin adds button "Tooltip" to the RichText toolbar. Use it to paste popover tooltips over the words and phrases in your articles.
You can style tooltips with CSS and using filters:

```php
add_filter('iz_bet_style_text_color', function() { return '#247DE0'; });
add_filter('iz_bet_style_border_color', function() { return '#247DE0'; });
add_filter('iz_bet_style_tooltip_text_color', function() { return '#fff'; });
add_filter('iz_bet_style_tooltip_background_color', function() { return 'rgba(0, 010, 030, .85)'; });
```

## Installation

1. Upload `iz-block-editor-tooltips` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.

## Changelog

For the plugin’s changelog, please see [the Releases page on GitHub](https://github.com/IvanZhuck/wordpress-iz-bet/releases).