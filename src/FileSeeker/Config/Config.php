<?php

namespace Umbrellio\FileSeeker\Config;

use Exception;

class Config
{
    /**
     * @var Config $instance
     */
    private static $instance;

    /**
     * @var array $config
     */
    private $config;

    /**
     * Config constructor.
     * Config file must be only .yaml extension
     * @throws Exception
     */
    private function __construct()
    {
        $this->readConfigFromFile();
    }

    /**
     * @throws Exception
     */
    private function readConfigFromFile()
    {
        $ds = DIRECTORY_SEPARATOR;
        $path = dirname(__FILE__) . "{$ds}..{$ds}..{$ds}..{$ds}config";
        $fileName = $path . $ds . 'config.yaml';
        $info = pathinfo($fileName);
        if (!file_exists($fileName) || $info['extension'] !== 'yaml')
        {
            throw new Exception('Config file is not found or has a wrong format!');
        }

        $this->config = yaml_parse_file($fileName);
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
            }
        }
        return self::$instance;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}