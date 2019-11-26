<?php

namespace Engine;

/**
 * Class App.
 *
 * @package Engine
 */
class App
{
    /**
     * @var mixed
     */
    private $config;

    public function __construct()
    {
        $this->config = include ROOT . '/config/app.php';
    }

    public function getConfig($param = null)
    {
        return $this->config[$param] ?? $this->config;
    }
}
