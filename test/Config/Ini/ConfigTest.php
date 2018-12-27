<?php
declare(strict_types = 1);

/**
 * Tests for the \Maleficarum\Config\Ini\Config class.
 */

namespace Maleficarum\Config\Tests\Ini;

class ConfigTest extends \PHPUnit\Framework\TestCase
{
    /* ------------------------------------ Method: load START ----------------------------------------- */
    /**
     * @expectedException \RuntimeException
     */
    public function testConfigLoadUnreadableId() {
        new \Maleficarum\Config\Ini\Config([uniqid()]);
    }

    public function testConfigLoadCorrectId() {
        $config = new \Maleficarum\Config\Ini\Config(['test/resources/__example-config.ini']);
        $this->assertArrayHasKey('global', $config);
    }
    /* ------------------------------------ Method: load END ------------------------------------------- */

    /* ------------------------------------ Inheritance START ------------------------------------------ */
    public function testInheritance() {
        $config = new \Maleficarum\Config\Ini\Config(['test/resources/__example-config.ini']);
        $this->assertInstanceOf('Maleficarum\Config\AbstractConfig', $config);
    }
    /* ------------------------------------ Inheritance END -------------------------------------------- */
}
