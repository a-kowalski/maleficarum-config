<?php
/**
 * This trait provides functionality common to all classes dependant on the \Maleficarum\Config namespace
 */
declare (strict_types=1);

namespace Maleficarum\Config;

trait Dependant {
    /* ------------------------------------ Class Property START --------------------------------------- */

    /**
     * Internal storage for the config object.
     *
     * @var \Maleficarum\Config\AbstractConfig|null
     */
    protected $configStorage = null;

    /* ------------------------------------ Class Property END ----------------------------------------- */

    /* ------------------------------------ Class Methods START ---------------------------------------- */

    /**
     * Inject a new config object.
     *
     * @param \Maleficarum\Config\AbstractConfig $config
     *
     * @return \Maleficarum\Config\Dependant
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
    public function getConfig(): ?\Maleficarum\Config\AbstractConfig {
        return $this->configStorage;
    }

    /**
     * Detach the currently assigned config object.
     *
     * @return \Maleficarum\Config\Dependant
     */
    public function detachConfig() {
        $this->configStorage = null;

        return $this;
    }

    /* ------------------------------------ Class Methods END ------------------------------------------ */
}
