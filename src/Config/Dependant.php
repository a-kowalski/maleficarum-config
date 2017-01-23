<?php
/**
 * This trait provides functionality common to all classes dependant on the \Maleficarum\Config namespace
 */

namespace Maleficarum\Config;

trait Dependant
{
    /**
     * Internal storage for the config object.
     *
     * @var \Maleficarum\Config\AbstractConfig|null
     */
    protected $configStorage = null;

    /* ------------------------------------ Dependant methods START ------------------------------------ */
    /**
     * Inject a new config object.
     *
     * @param \Maleficarum\Config\AbstractConfig $config
     *
     * @return $this
     */
    public function setConfig(\Maleficarum\Config\AbstractConfig $config) {
        $this->configStorage = $config;

        return $this;
    }

    /**
     * Fetch the currently assigned config object.
     *
     * @return \Maleficarum\Config\AbstractConfig|null
     */
    public function getConfig() {
        return $this->configStorage;
    }

    /**
     * Detach the currently assigned config object.
     *
     * @return $this
     */
    public function detachConfig() {
        $this->configStorage = null;

        return $this;
    }
    /* ------------------------------------ Dependant methods END -------------------------------------- */
}
