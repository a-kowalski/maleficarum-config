<?php
/**
 * This class is a specific Config implementation based on the INI file format.
 */
declare (strict_types=1);

namespace Maleficarum\Config\Ini;

class Config extends \Maleficarum\Config\AbstractConfig {
    /* ------------------------------------ Class Methods START ---------------------------------------- */

    /**
     * @see \Maleficarum\Config\AbstractConfig::load()
     */
    public function load(array $ids): \Maleficarum\Config\AbstractConfig {
        foreach($ids as $id) {
            if (!is_readable($id)) {
                throw new \RuntimeException(sprintf('Incorrect config ID - not a readable file: %s. \%s::load()', $id, static::class));
            } else {
                $this->data = \array_merge_recursive($this->data, \parse_ini_file($id, true));
            }
        }

        return $this;
    }

    /* ------------------------------------ Class Methods END ------------------------------------------ */
}
