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
use ChurchRoster\Data\MembershipStatus;
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
     * Mock Address object.
     * @var Address|Mockery\MockInterface
     */
    private $address;

    /**
     * Mock MembershipStatus object.
     * @var MembershipStatus|Mockery\MockInterface
     */
    private $membershipStatus;

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
        $this->address = Mockery::Mock('ChurchRoster\Data\Address');
        $this->membershipStatus = Mockery::Mock('ChurchRoster\Data\MembershipStatus');

        $this->startTime = (int)microtime(true);
        $this->person = new Person(
            1,
            'John',
            'Smith',
            new DateTime('12/25/1968'),
            $this->address,
            'johnsmith@example.com',
            $this->membershipStatus
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
            $this->person->getId(),
            'Returned wrong person ID.'
        );

        $this->assertEquals(
            'John',
            $this->person->getFirstName(),
            'Returned wrong first name.'
        );

        $this->assertEquals(
            'Smith',
            $this->person->getLastName(),
            'Returned wrong last name.'
        );

        $this->assertEquals(
            strtotime('12/25/1968'),
            $this->person->getBirthdate(),
            'Returned wrong birthdate.'
        );

        $this->assertSame(
            $this->address,
            $this->person->getAddress(),
            'Returned wrong address.'
        );

        $this->assertEquals(
            'johnsmith@example.com',
            $this->person->getEmail(),
            'Returned wrong email.'
        );

        $this->assertSame(
            $this->membershipStatus,
            $this->person->getMembershipStatus(),
            'Returned wrong membership status.'
        );

        $this->assertGreaterThanOrEqual(
            $this->startTime,
            $this->person->getTimeStamp()->getTimestamp(),
            'Returned person time stamp before possible range.'
        );

        $this->assertLessThanOrEqual(
            $this->endTime,
            $this->person->getTimeStamp()->getTimestamp(),
            'Returned person time stamp after possible range.'
        );
    }
}
