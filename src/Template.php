<?php

declare(strict_types=1);

namespace Izbet;

use Izbet\Traits\SingleTon;

/**
 * Renders php templates from files
 */
class Template
{
    use SingleTon;

    /**
     * Compiles template file with context to a string
     */
    public function compile(string $templateFile, array $args = []): string
    {
        extract($args);

        ob_start();

        $templateFilePath = IZBET_PLUGIN_DIR_PATH . 'views/' . $templateFile . '.php';

        if (file_exists($templateFilePath)) {
            require $templateFilePath;
        } else {
            echo esc_html__('Template not found!', 'iz-block-editor-tooltips');
        }

        return (string) ob_get_clean();
    }

    /**
     * Displays compiled template
     */
    public function render(string $templateFile, array $args = []): void
    {
        echo $this->compile($templateFile, $args);
    }
}
