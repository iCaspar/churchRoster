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
    /**
     * Membership Status ID.
     * @var int
     */
    private $id;

    /**
     * Membership Status name.
     * @var string
     */
    private $membershipStatusName;

    /**
     * Membership Status time stamp.
     * @var DateTime
     */
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

    /**
     * Get the ID.
     *
     * @return int
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the Status Name.
     *
     * @return string
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getStatusName(): string
    {
        return $this->membershipStatusName;
    }

    /**
     * Get the Time Stamp.
     *
     * @return DateTime
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getTimeStamp(): DateTime
    {
        return $this->timeStamp;
    }
}
