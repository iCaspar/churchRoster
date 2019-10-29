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
    public function testObjectIsMembershipStatusClass()
    {
        $membershipStatus = new MemberShipStatus(1, 'Single');

        $this->assertInstanceOf(
            'ChurchRoster\Data\MembershipStatus',
            $membershipStatus,
            'Object created is not a MembershipStatus class.'
        );
    }
}
