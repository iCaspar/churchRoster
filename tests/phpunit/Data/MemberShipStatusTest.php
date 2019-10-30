<?php
/**
 * Tests for Membership Status Class.
 *
 * @package ChurchRoster\Tests\Unit\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Tests\Unit\Data;

use ChurchRoster\Data\MemberShipStatus;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Memership Status Class.
 *
 * @package ChurchRoster\Tests\Unit\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */
class MemberShipStatusTest extends TestCase
{
    /**
     * Membership Status test object.
     * @var MemberShipStatus
     */
    private $membershipStatus;
    private $startTime;
    private $stopTime;

    public function setUp(): void
    {
        $this->startTime = (int)microtime(true);
        $this->membershipStatus = new MemberShipStatus(1, 'Single');
        $this->stopTime = (int)microtime(true);
    }

    public function testObjectIsMembershipStatusClass()
    {
        $this->assertInstanceOf(
            'ChurchRoster\Data\MembershipStatus',
            $this->membershipStatus,
            'Object created is not a MembershipStatus class.'
        );
    }

    public function testGettersReturnCorrectProperties()
    {
        $this->assertEquals(
            1,
            $this->membershipStatus->getId(),
            'Returned wrong membership status ID.'
        );

        $this->assertEquals(
            'Single',
            $this->membershipStatus->getStatusName(),
            'Returned wrong membership status name.'
        );

        $this->assertGreaterThanOrEqual(
            $this->startTime,
            $this->membershipStatus->getTimeStamp()->getTimestamp(),
            'Returned Time Stamp before possible range.'
        );

        $this->assertLessThanOrEqual(
            $this->stopTime,
            $this->membershipStatus->getTimeStamp()->getTimestamp(),
            'Returned Time Stamp after possible range.'
        );
    }
}
