<?php
namespace TypeRocket\Core;

use TypeRocket\Models\WPUser;

class Config
{

    static private $config = null;
    static private $frontend = false;

    /**
     * Set initial values
     *
     * @param array $config
     */
    public function __construct( $config = [] )
    {
        $key = array_search('configurations', array_keys( $config ), true);
        if ($key !== false) {
            $slice = array_slice($config, $key, null, true);
            $config = array_merge($slice['configurations'], ['app']);
        }

        if (self::$config === null) {
            foreach ($config as $type) {
                self::$config[$type] = include TR_PATH . "/config/{$type}.php";
            }
        }
    }

    /**
     * Check if using outside root
     *
     * @return mixed|null|void
     */
    static public function getTemplates()
    {
        return self::$config['app']['templates'];
    }

    /**
     * Get Main User Class
     *
     * @return mixed
     */
    static public function getMainUserClass()
    {
        return !empty(self::$config['app']['user']) ? self::$config['app']['user'] : WPUser::class;
    }

    /**
     * Get paths array
     *
     * @return mixed|null|void
     */
    static public function getPaths()
    {
        return self::$config['paths'];
    }

    /**
     * Get debug status
     *
     * @return bool
     */
    static public function getDebugStatus()
    {
        return self::$config['app']['debug'];
    }

    /**
     * Get Seed
     *
     * @return null|string
     */
    static public function getSeed()
    {
        return self::$config['app']['seed'];
    }

    /**
     * Check TypeRocket for frontend
     *
     * @return null|string
     */
    static public function getFrontend()
    {
        return self::$frontend;
    }

    /**
     * Get array of plugins
     *
     * @return array
     */
    static public function getPlugins()
    {
        return self::$config['app']['plugins'];
    }

    /**
     * Tell config that front end TypeRocket was enabled
     *
     * This action can not be undone
     */
    public static function enableFrontend()
    {
        self::$frontend = true;
    }

    /**
     * Get the icons class
     *
     * @return mixed
     */
    public static function getIcons()
    {
        return new self::$config['app']['icons'];
    }

}
