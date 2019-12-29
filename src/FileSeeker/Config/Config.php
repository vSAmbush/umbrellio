<?php

namespace Umbrellio\FileSeeker\Config;

use Umbrellio\FileSeeker\Exception\AbstractException;

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
     * @throws AbstractException
     */
    private function __construct()
    {
        $this->readConfigFromFile();
    }

    /**
     * @throws AbstractException
     */
    private function readConfigFromFile()
    {
        $ds = DIRECTORY_SEPARATOR;
        $path = dirname(__FILE__) . "{$ds}..{$ds}..{$ds}..{$ds}config";
        $fileName = $path . $ds . 'config.yaml';
        $info = pathinfo($fileName);
        if (!file_exists($fileName) || $info['extension'] !== 'yaml')
        {
            throw new AbstractException('Config file is not found or has a wrong format!');
        }

        $this->config = yaml_parse_file($fileName);
    }

    /**
     * @return Config|false
     */
    public static function getInstance()
    {
        try {
            if (!self::$instance) {
                self::$instance = new Config();
            }
            return self::$instance;
        } catch (AbstractException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}