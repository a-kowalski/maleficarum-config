<?php
/**
 * This class implements functionality common to all configuration storage classes.
 */
declare (strict_types=1);

namespace Maleficarum\Config;

abstract class AbstractConfig implements \ArrayAccess {
    
    /* ------------------------------------ Class Property START --------------------------------------- */
    
    /**
     * Internal storage for config data.
     *
     * @var array
     */
    protected $data = [];

    /* ------------------------------------ Class Property END ----------------------------------------- */
    
    /* ------------------------------------ Magic methods START ---------------------------------------- */
    /**
     * Create and load a new config instance.
     *
     * @param string $id
     */
    public function __construct(string $id) {
        $this->load($id);
    }
    /* ------------------------------------ Magic methods END ------------------------------------------ */
    
    /* ------------------------------------ ArrayAccess methods START ---------------------------------- */
    
    /**
     * @see \ArrayAccess::offsetExists()
     */
    public function offsetExists($offset) : bool {
        return array_key_exists($offset, $this->data);
    }

    /**
     * @see \ArrayAccess::offsetGet()
     */
    public function offsetGet($offset) {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->data[$offset];
    }

    /**
     * @see \ArrayAccess::offsetSet()
     */
    public function offsetSet($offset, $value) {
        throw new \RuntimeException(sprintf('Config data is read-only. \%s::offsetSet()', static::class));
    }

    /**
     * @see \ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset) {
        throw new \RuntimeException(sprintf('Config data is read-only. \%s::offsetUnset()', static::class));
    }
    
    /* ------------------------------------ ArrayAccess methods END ------------------------------------ */

    /* ------------------------------------ Abstract methods START ------------------------------------- */
    
    /**
     * Load the specified config from a storage.
     *
     * @param string $id
     * @return \Maleficarum\Config\AbstractConfig
     */
    abstract public function load(string $id) : \Maleficarum\Config\AbstractConfig;
    
    /* ------------------------------------ Abstract methods END --------------------------------------- */
    
}
