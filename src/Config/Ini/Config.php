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
     * Loads the specified config from a storage.
     *
     * @see \Maleficarum\Config\AbstractConfig::load()
     *
     * @param string $id
     *
     * @return \Maleficarum\Config\AbstractConfig
     * @throws \RuntimeException
     */
    public function load(string $id) : \Maleficarum\Config\AbstractConfig {
        if (!is_readable($id)) {
            throw new \RuntimeException(sprintf('Incorrect config ID - not a readable file. \%s::load()', static::class));
        }

        $this->data = parse_ini_file($id, true);

        return $this;
    }
    /* ------------------------------------ AbstractConfig methods END --------------------------------- */
}
