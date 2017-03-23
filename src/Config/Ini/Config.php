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
    public function load(string $id) : \Maleficarum\Config\AbstractConfig {
        if (!is_readable($id)) {
            throw new \RuntimeException(sprintf('Incorrect config ID - not a readable file. \%s::load()', static::class));
        }

        $this->data = parse_ini_file($id, true);
        return $this;
    }
    
    /* ------------------------------------ Class Methods END ------------------------------------------ */
    
}
