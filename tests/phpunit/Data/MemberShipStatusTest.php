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
 * Test for MemershipStatus Class.
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
     *
     * @throws \Exception
     * @author Caspar Green
     * @since  ver 1.0.0
     *
     */
    public function setUp(): void
    {
        $this->startTime = (int)microtime(true);
        $this->membershipStatus = new MemberShipStatus(1, 'Single');
        $this->endTime = (int)microtime(true);
    }

    /**
     * Test that object is a MembershipStatus.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testObjectIsMembershipStatusClass()
    {
        $this->assertInstanceOf(
            'ChurchRoster\Data\MembershipStatus',
            $this->membershipStatus,
            'Object created is not a MembershipStatus class.'
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
            'Returned membership status time stamp before possible range.'
        );

        $this->assertLessThanOrEqual(
            $this->endTime,
            $this->membershipStatus->getTimeStamp()->getTimestamp(),
            'Returned membership status time stamp after possible range.'
        );
    }
}
