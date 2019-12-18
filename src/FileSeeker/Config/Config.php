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
     */
    private function __construct()
    {
        try {
            $this->readConfigFromFile();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    /**
     * @throws Exception
     */
    private function readConfigFromFile()
    {
        $ds = DIRECTORY_SEPARATOR;
        $path = dirname(__FILE__) . "{$ds}..{$ds}..{$ds}..{$ds}config";
        $fileName = $path . $ds . 'config.yaml';
        $fileNameChunks = explode('.', $fileName);
        if (!file_exists($fileName) || array_pop($fileNameChunks) !== 'yaml')
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
                die();
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