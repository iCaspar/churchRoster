<?php
/**
 * Person Class.
 *
 * @package ChurchRoster\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Data;

use DateTime;
use ChurchRoster\Data\Address;
use ChurchRoster\Data\MemberShipStatus;

/**
 * Person Class.
 *
 * @package ChurchRoster\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */
class Person
{
    private $id;
    private $firstName;
    private $lastName;
    private $birthdate;
    private $address;
    private $email;
    private $membershipStatus;
    private $timeStamp;

    /**
     * Person constructor.
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param DateTime $birthdate
     * @param string $email
     * @param \ChurchRoster\Data\MemberShipStatus $memberShipStatus
     * @throws \Exception
     */
    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        DateTime $birthdate,
        Address $address,
        string $email,
        MemberShipStatus $memberShipStatus
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthdate = $birthdate;
        $this->address = $address;
        $this->email = $email;
        $this->memberShipStatus = $memberShipStatus;
        $this->timeStamp = new DateTime();
    }
}
