<?php
/**
 * autoload
 *
 * @filesource
 */

/**
 * Autoload function for the `TandF\India` package.
 *
 * @package    TandF\India\autoload
 * @version    1.0.1
 * @copyright  2016 Taylor & Francis Group
 * @author     Sean Sciarrone <sean.sciarrone@taylorandfrancis.com>
 * @param string $class Class Name
 */

function tandfindiaAutoload($class)
{
    $basedir = __DIR__ . DIRECTORY_SEPARATOR;

    if (is_string($basedir) and is_dir($basedir)) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $class = str_replace('TandF/India', '', $class);

        if (file_exists($basedir . $class . '.php')) {
            include $basedir . $class . '.php';
        } elseif (method_exists($class, 'init')) {
            // For initiating static classes
            call_user_func(array($class, 'init'));
        }
    } else {
        // Die if the packages root directory isn't set.
        die('Sorry, `TandF\India` package is incorrectly configured. Cannot autoload, directory not found.');
    }
}

spl_autoload_register('tandfindiaAutoload');
