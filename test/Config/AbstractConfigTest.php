<?php
declare(strict_types = 1);

/**
 * Tests for the \Maleficarum\Config\AbstractConfig class.
 */

namespace Maleficarum\Config\Tests;

class AbstractConfigTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Internal storage for config object mock
     *
     * @var \Maleficarum\Config\AbstractConfig|null
     */
    private $configMock = null;

    /**
     * @inheritDoc
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

    /* ------------------------------------ Method: __construct START ---------------------------------- */
    public function testConstructWithId() {
        $this->configMock
            ->expects($this->once())
            ->method('load')
            ->with($this->equalTo(['config_id']));

        $reflection = new \ReflectionClass('Maleficarum\Config\AbstractConfig');
        $constructor = $reflection->getConstructor();
        $constructor->invoke($this->configMock, ['config_id']);
    }
    /* ------------------------------------ Method: __construct END ------------------------------------ */

    /* ------------------------------------ Method: offsetExists START --------------------------------- */
    public function testOffsetExistsSuccess() {
        $this->assertTrue($this->configMock->offsetExists('testKey'));
    }

    public function testOffsetExistsFailure() {
        $this->assertFalse($this->configMock->offsetExists(uniqid()));
    }
    /* ------------------------------------ Method: offsetExists END ----------------------------------- */

    /* ------------------------------------ Method: offsetUnset START ---------------------------------- */
    /**
     * @expectedException \RuntimeException
     */
    public function testOffsetUnsetException() {
        $this->configMock->offsetUnset(uniqid());
    }
    /* ------------------------------------ Method: offsetUnset END ------------------------------------ */

    /* ------------------------------------ Method: offsetGet START ------------------------------------ */
    public function testOffsetGetExisting() {
        $this->assertSame('testValue', $this->configMock->offsetGet('testKey'));
    }

    public function testOffsetGetNonExisting() {
        $this->assertNull($this->configMock->offsetGet(uniqid()));
    }
    /* ------------------------------------ Method: offsetGet END -------------------------------------- */

    /* ------------------------------------ Method: offsetSet START ------------------------------------ */
    /**
     * @expectedException \RuntimeException
     */
    public function testOffsetSetException() {
        $this->configMock->offsetSet(uniqid(), uniqid());
    }
    /* ------------------------------------ Method: offsetSet END -------------------------------------- */
}
