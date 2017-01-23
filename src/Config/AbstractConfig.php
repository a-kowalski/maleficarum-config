<?php
/**
 * This class implements functionality common to all configuration storage classes.
 *
 * @implements \ArrayAccess
 */

namespace Maleficarum\Config;

abstract class AbstractConfig implements \ArrayAccess
{
    /**
     * Internal storage for config data.
     *
     * @var array
     */
    protected $data = [];

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
     * Checks if the given key exists in the array
     *
     * @see \ArrayAccess::offsetExists()
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset) : bool {
        return array_key_exists($offset, $this->data);
    }

    /**
     * Gets the element with the given key
     *
     * @see \ArrayAccess::offsetGet()
     *
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset) {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->data[$offset];
    }

    /**
     * This method will always throw a RuntimeException. It's not allowed to set config data from the execution context.
     *
     * @see \ArrayAccess::offsetSet()
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     * @throws \RuntimeException
     */
    public function offsetSet($offset, $value) {
        throw new \RuntimeException(sprintf('Config data is read-only. \%s::offsetSet()', static::class));
    }

    /**
     * This method will always throw a RuntimeException. It's not allowed to unset config data from the execution context.
     *
     * @see \ArrayAccess::offsetUnset()
     *
     * @param mixed $offset
     *
     * @return void
     * @throws \RuntimeException
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
     *
     * @return \Maleficarum\Config\AbstractConfig
     */
    abstract public function load(string $id) : \Maleficarum\Config\AbstractConfig;
    /* ------------------------------------ Abstract methods END --------------------------------------- */
}
