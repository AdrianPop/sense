<?php namespace sense;

class Config
{
    /**
     * @var Container
     */
    private $container;

    /*
     * namespace to store the data in the container
     * @var string
     */
    private $namespace = 'config';

    public function __construct($configDir = null, Container $container)
    {
        if ( ! is_dir($configDir) )
        {
            return;
        }

        $this->container = $container;

        $files = $this->_getFiles($configDir);

        $this->load($files);
    }

    public function load(array $files)
    {
        foreach ( $files as $file )
        {
            $baseKey = $this->namespace . "." . $this->_getBaseKey($file);

            $this->container->set($baseKey, require_once($file));
        }

        return true;
    }

    public static function get($key)
    {
        // app.slack.token
        $parts = explode('.', $key);

        $container = Container::getInstance();
        $base = $container->{'config.' . $parts[0]};

        unset($parts[0]);

        foreach ($parts as $part)
        {
            if ( isset($base[$part]) )
            {
                $base = $base[$part];
            }
            else
            {
                return null;
            }
        }

        return $base;
    }

    /**
     * Get all files from the config directory
     *
     * @param $configDir
     * @return array
     */
    private function _getFiles($configDir)
    {
        return glob(realpath($configDir) . "/*.php");
    }

    private function _getBaseKey($file)
    {
        return pathinfo($file, PATHINFO_FILENAME);
    }
}