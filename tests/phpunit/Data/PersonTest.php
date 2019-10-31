<?php
/**
 * Tests for Person Class.
 *
 * @package ChurchRoster\Tests\Unit\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Tests\Unit\Data;

use ChurchRoster\Data\Address;
use ChurchRoster\Data\MemberShipStatus;
use ChurchRoster\Data\Person;
use Mockery;
use PHPUnit\Framework\TestCase;
use DateTime;

/**
 * Tests for Person Class.
 *
 * @package ChurchRoster\Tests\Unit\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */
class PersonTest extends TestCase
{
    /**
     * Person test object.
     * @var Person
     */
    private $person;

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
     *
     */
    public function setUp(): void
    {
        $address = Mockery::Mock('ChurchRoster\Data\Address');

        $membershipStatus = Mockery::Mock('ChurchRoster\Data\MembershipStatus');

        $this->startTime = (int)microtime(true);
        /** @var Address|Mockery\MockInterface $address */
        /** @var MemberShipStatus|Mockery\MockInterface $membershipStatus */
        $this->person = new Person(
            1,
            'John',
            'Smith',
            new DateTime('12/25/1968'),
            $address,
            'johnsmith@example.com',
            $membershipStatus
        );
        $this->endTime = (int)microtime(true);
    }

    /**
     * Test that object is a Person.
     *
     * @return void
     *
     * @throws \Exception
     * @author Caspar Green
     * @since  ver 1.0.0
     *
     */
    public function testObjectIsPersonClass()
    {
        $this->assertInstanceOf(
            'ChurchRoster\Data\Person',
            $this->person,
            'Object created is not a Person class.'
        );
    }
}
