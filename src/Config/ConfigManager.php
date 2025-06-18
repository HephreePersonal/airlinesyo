<?php
namespace App\Config;

class ConfigManager
{
    private static $instance = null;
    private $configs = [];

    private function __construct()
    {
        // Private constructor to prevent direct creation
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function load($name)
    {
        if (!isset($this->configs[$name])) {
            $configFile = __DIR__ . '/../../config/' . $name . '.php';
            
            if (!file_exists($configFile)) {
                throw new \RuntimeException("Configuration file {$name}.php not found");
            }
            
            $this->configs[$name] = require $configFile;
        }
        
        return $this->configs[$name];
    }

    public function get($name, $key = null)
    {
        $config = $this->load($name);
        
        if ($key === null) {
            return $config;
        }
        
        return $config[$key] ?? null;
    }
}