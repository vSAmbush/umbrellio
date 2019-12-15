<?php

namespace Umbrellio\FileSeeker\Config;

use Exception;

class Config
{
    private $path;
    /**
     * @var Config $instance
     */
    private static $instance;

    private static $config;

    /**
     * Config constructor.
     * Config file must be only with .yaml extension
     * @throws Exception
     */
    private function __construct()
    {
        $ds = DIRECTORY_SEPARATOR;
        $this->path = dirname(__FILE__) . "{$ds}..{$ds}..{$ds}config";
        $fileName = $this->path . $ds . 'config.yaml';
        $fileNameChunks = explode('.', $fileName);
        if (!file_exists($fileName) || array_pop($fileNameChunks) !== 'yaml')
        {
            throw new Exception('Config file is not found or has a wrong format!');
        }

        self::$config = yaml_parse_file($fileName)['file_config'];
    }

    /**
     * @return Config
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            try {
                self::$instance = new Config();
            } catch (Exception $ex) {
                echo $ex->getMessage();
                die();
            }
        }
        return self::$instance;
    }

    /**
     * @param string $key
     * @return string
     */
    public static function get($key)
    {
        return self::$config[$key];
    }
}