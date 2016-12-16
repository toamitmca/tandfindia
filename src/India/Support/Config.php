<?php
/**
 * Config
 *
 * @filesource
 */
namespace TandF\India\Support;

/**
 * Support class to load config parameters.
 *
 * @package    TandF\India\Support\Config
 * @version    1.0.1
 * @copyright  2016 Taylor & Francis Group
 * @author     Sean Sciarrone <sean.sciarrone@taylorandfrancis.com>
 */
class Config
{

    /**
     * Get Config parameters
     *
     * @param  array $config Configuration parameters
     * @return array
     */
    public static function get(array $config = array())
    {
        // Load config-presets
        $config_preset = require __DIR__ . '/../../config/config.php';
        // Set configuration parameters
        return array_merge($config_preset, $config);
    }

}