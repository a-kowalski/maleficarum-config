<?php
/**
 * This class carries ioc initialization functionality used by this component.
 */
declare (strict_types=1);

namespace Maleficarum\Config\Initializer;

class Initializer {
    /* ------------------------------------ Class Methods START ---------------------------------------- */

    /**
     * This will initialize the time profiler.
     *
     * @param array $opts
     *
     * @return string
     */
    static public function initialize(array $opts = []): string {
        // load default builder if skip not requested
        $builders = $opts['builders'] ?? [];
        is_array($builders) or $builders = [];
        if (!isset($builders['config']['skip'])) {
            \Maleficarum\Ioc\Container::register('Maleficarum\Config\Ini\Config', function ($dep, $opts) {
                $file = CONFIG_PATH . DIRECTORY_SEPARATOR . $dep['Maleficarum\Environment']->getCurrentEnvironment() . DIRECTORY_SEPARATOR . $opts['id'];

                return (new \Maleficarum\Config\Ini\Config($file));
            });
        }

        // load config object
        $config = \Maleficarum\Ioc\Container::get('Maleficarum\Config\Ini\Config', ['id' => 'config.ini']);
        \Maleficarum\Ioc\Container::registerDependency('Maleficarum\Config', $config);

        // check the disabled/enabled switch
        if (!isset($config['global']['enabled']) || (!$config['global']['enabled'])) {
            throw new \RuntimeException(sprintf('Application disabled! \%s()', __METHOD__));
        }

        return __METHOD__;
    }

    /* ------------------------------------ Class Methods END ------------------------------------------ */
}
