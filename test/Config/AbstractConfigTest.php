<?php
/**
 * Tests for the \Maleficarum\Config\AbstractConfig class.
 */

namespace Test\Maleficarum\Config;

class AbstractConfigTest extends \PHPUnit\Framework\TestCase
{
    /**
     * ATTRIBUTES
     */

    private $configMock = null;

    /**
     * FIXTURES
     */

    public function setUp() {
        // execute parent functionality
        parent::setUp();

        // setup a mock config object for each test
        $this->configMock = $this
            ->getMockBuilder('Maleficarum\Config\AbstractConfig')
            ->disableOriginalConstructor()
            ->setMethods(['load'])
            ->getMockForAbstractClass();

        $configData = new \ReflectionProperty($this->configMock, 'data');
        $configData->setAccessible(true);
        $configData->setValue($this->configMock, ['testKey' => 'testValue']);
        $configData->setAccessible(false);
    }

    /**
     * TESTS
     */

    /**  METHOD: \Maleficarum\Config\AbstractConfig::__construct */

    public function testConstructWithId() {
        $this->configMock
            ->expects($this->once())
            ->method('load')
            ->with($this->equalTo('config_id'));

        $reflection = new \ReflectionClass('Maleficarum\Config\AbstractConfig');
        $constructor = $reflection->getConstructor();
        $constructor->invoke($this->configMock, 'config_id');
    }

    /** METHOD: \Maleficarum\Config\AbstractConfig::offsetExists() */

    public function testOffsetexistsSuccess() {
        $this->assertTrue($this->configMock->offsetExists('testKey'));
    }

    public function testOffsetexistsFailure() {
        $this->assertFalse($this->configMock->offsetExists(uniqid()));
    }

    /** METHOD: \Maleficarum\Config\AbstractConfig::offsetUnset() */

    /**
     * @expectedException \RuntimeException
     */
    public function testOffsetunsetException() {
        $this->configMock->offsetUnset(uniqid());
    }

    /** METHOD: \Maleficarum\Config\AbstractConfig::offsetGet() */

    public function testOffsetGetExisting() {
        $this->assertSame('testValue', $this->configMock->offsetGet('testKey'));
    }

    public function testOffsetGetNonExisting() {
        $this->assertNull($this->configMock->offsetGet(uniqid()));
    }

    /** METHOD: \Maleficarum\Config\AbstractConfig::offsetSet() */

    /**
     * @expectedException \RuntimeException
     */
    public function testOffsetsetException() {
        $this->configMock->offsetSet(uniqid(), uniqid());
    }
}
