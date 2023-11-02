<?php

declare(strict_types=1);

namespace Izbet\Traits;

trait SingleTon
{
    private static ?self $instance = null;

    protected function __construct()
    {
        return $this->initInstance();
    }

    public static function instance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Init Method
     * Can be redefined in a class that uses this trait
     */
    protected function initInstance(): self
    {
        return $this;
    }
}
