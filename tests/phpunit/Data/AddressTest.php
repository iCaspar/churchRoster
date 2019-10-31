<?php
/**
 * Tests for Address Class.
 *
 * @package ChurchRoster\Tests\Unit\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Tests\Unit\Data;

use ChurchRoster\Data\Address;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Address Class.
 *
 * @package ChurchRoster\Tests\Unit\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */
class AddressTest extends TestCase
{
    /**
     * Address test object.
     * @var Address
     */
    private $address;

    /**
     * Earliest acceptable time for timestamp.
     * @var int
     */
    private $startTime;

    /**
     * Latest acceptable time for timestamp.
     * @var int
     */
    private $endTime;

    /**
     * Set up before each test.
     *
     * @return void
     * @throws \Exception
     * @author Caspar Green
     * @since  ver 1.0.0
     */
    public function setUp(): void
    {
        $this->startTime = (int)microtime(true);
        $this->address = new Address(
            1,
            '123 Main Street',
            'Apt 2',
            'Anytown',
            'NY',
            '12345-6789'
        );
        $this->endTime = (int)microtime(true);
    }

    /**
     * Test that object is an Address.
     *
     * @return void
     *
     * @throws \Exception
     * @author Caspar Green
     * @since  ver 1.0.0
     *
     */
    public function testObjectIsAddressClass()
    {
        $this->assertInstanceOf(
            'ChurchRoster\Data\Address',
            $this->address,
            'Object created is not an Address class.'
        );
    }

    /**
     * Test that getters return correct property values.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testGettersReturnCorrectPropertyValues()
    {
        $this->assertEquals(
            1,
            $this->address->getId(),
            'Returned wrong address ID.'
        );

        $this->assertEquals(
            '123 Main Street',
            $this->address->getStreetLine1(),
            'Returned wrong Street Line1.'
        );

        $this->assertEquals(
            'Apt 2',
            $this->address->getStreetLine2(),
            'Returned wrong Street Line2.'
        );

        $this->assertEquals(
            'Anytown',
            $this->address->getCity(),
            'Returned wrong City.'
        );

        $this->assertEquals(
            'NY',
            $this->address->getState(),
            'Returned wrong State.'
        );

        $this->assertEquals(
            '12345-6789',
            $this->address->getZipcode()
        );

        $this->assertGreaterThanOrEqual(
            $this->startTime,
            $this->address->getTimeStamp()->getTimestamp(),
            'Returned address timestamp before possible range.'
        );

        $this->assertLessThanOrEqual(
            $this->endTime,
            $this->address->getTimeStamp()->getTimestamp(),
            'Returned address timestamp after possible range.'
        );
    }
}
