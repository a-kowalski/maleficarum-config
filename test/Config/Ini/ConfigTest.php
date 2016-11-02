<?php
/**
 * Tests for the \Maleficarum\Config\Ini\Config class.
 */

namespace Test\Maleficarum\Config\Ini;


class ConfigTest extends \PHPUnit\Framework\TestCase
{
    /**
     * TESTS
     */

    /**  METHOD: \Maleficarum\Config\Ini\Config::load */

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConfigLoadIncorrectId() {
        new \Maleficarum\Config\Ini\Config(null);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConfigLoadUnreadableId() {
        new \Maleficarum\Config\Ini\Config(uniqid());
    }

    public function testConfigLoadCorrectId() {
        $cfg = new \Maleficarum\Config\Ini\Config('test/resources/__example-config.ini');
        $this->assertArrayHasKey('global', $cfg);
    }

    /**  STRUCTURE */

    public function testInheritance() {
        $cfg = new \Maleficarum\Config\Ini\Config('test/resources/__example-config.ini');
        $this->assertInstanceOf('Maleficarum\Config\AbstractConfig', $cfg);
    }
}
