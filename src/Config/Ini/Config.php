<?php
/**
 * This class is a specific Config implementation based on the INI file format.
 *
 * @extends \Maleficarum\Config\AbstractConfig
 */

namespace Maleficarum\Config\Ini;

class Config extends \Maleficarum\Config\AbstractConfig
{
    /* ------------------------------------ AbstractConfig methods START ------------------------------- */
    /**
     * @see Maleficarum\Config\AbstractConfig::load()
     * 
     * @throws \InvalidArgumentException
     */
    public function load($id) {
        if (!is_string($id)) {
            throw new \InvalidArgumentException('Incorrect config ID - string expected. \Maleficarum\Config\Ini\Config::load()');
        }

        if (!is_readable($id)) {
            throw new \InvalidArgumentException('Incorrect config ID - not a readable file. \Maleficarum\Config\Ini\Config::load()');
        }

        $this->data = parse_ini_file($id, true);

        return $this;
    }
    /* ------------------------------------ AbstractConfig methods END --------------------------------- */
}
