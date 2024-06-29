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
        echo wp_kses(
            $this->compile($templateFile, $args),
            [
                'h1' => [],
                'h2' => [],
                'div' => [
                    'id' => true,
                    'class' => true,
                    'tabindex' => true,
                    'aria-label' => true,
                ],
                'span' => [
                    'class' => true,
                    'style' => true,
                ],
                'p' => [
                    'id' => true,
                    'class' => true,
                ],
                'table' => [
                    'id' => true,
                    'class' => true,
                    'role' => true,
                ],
                'tbody' => [],
                'tr' => [],
                'th' => [
                    'scope' => true,
                ],
                'td' => [
                    'scope' => true,
                ],
                'form' => [
                    'action' => true,
                    'method' => true,
                ],
                'label' => [
                    'for' => true,
                ],
                'input' => [
                    'id' => true,
                    'class' => true,
                    'type' => true,
                    'name' => true,
                    'value' => true,
                    'data-alpha-enabled' => true,
                ],
                'select' => [
                    'name' => true,
                ],
                'option' => [
                    'value' => true,
                    'selected' => true,
                ],
                'button' => [
                    'type' => true,
                    'class' => true,
                    'aria-expanded' => true,
                    'style' => true,
                ],
            ]
        );
    }
}
