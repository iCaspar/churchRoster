<?php
/**
 * Membership Status Class.
 *
 * @package ChurchRoster\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Data;

use DateTime;

/**
 * Membership Status Class.
 *
 * @package ChurchRoster\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */
class MemberShipStatus
{
    private $id;
    private $membershipStatusName;
    private $timeStamp;

    /**
     * MemberShipStatus constructor.
     * @param int $id
     * @param string $membershipStatusName
     * @throws \Exception
     */
    public function __construct(
        int $id,
        string $membershipStatusName
    ) {
        $this->id = $id;
        $this->membershipStatusName = $membershipStatusName;
        $this->timeStamp = new DateTime();
    }
}
