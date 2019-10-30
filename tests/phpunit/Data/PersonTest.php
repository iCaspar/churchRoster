<?php
/**
 * Tests for Person Class.
 *
 * @package ChurchRoster\Tests\Unit\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Tests\Unit\Data;

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
    public function testObjectIsPersonClass()
    {
        $address = Mockery::Mock('ChurchRoster\Data\Address');
        $membershipStatus = Mockery::Mock('ChurchRoster\Data\MembershipStatus');
        $person = new Person(
            34,
            'John',
            'Smith',
            new DateTime('12/25/1968'),
            $address,
            'johnsmith@example.com',
            $membershipStatus
        );

        $this->assertInstanceOf(
            'ChurchRoster\Data\Person',
            $person,
            'Object created is not a Person class.');
    }
}
