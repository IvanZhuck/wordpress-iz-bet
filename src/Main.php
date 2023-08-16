<?php

declare(strict_types=1);

namespace IzBet;

/**
 * The main class inits all parts of the plugin
 */
final class Main
{
    public function __construct()
    {
        new Assets();
        new SettingsPage();
    }
}
