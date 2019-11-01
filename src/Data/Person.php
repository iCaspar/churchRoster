<?php
/**
 * Person Class.
 *
 * @package ChurchRoster\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Data;

use Cassandra\Date;
use DateTime;
use ChurchRoster\Data\Address;
use ChurchRoster\Data\MembershipStatus;

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
     * @param \ChurchRoster\Data\MembershipStatus $membershipStatus
     * @throws \Exception
     */
    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        DateTime $birthdate,
        Address $address,
        string $email,
        MembershipStatus $membershipStatus
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthdate = $birthdate;
        $this->address = $address;
        $this->email = $email;
        $this->membershipStatus = $membershipStatus;
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
     * Get first name.
     *
     * @return string
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Get last name.
     *
     * @return string
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Get birthdate.
     *
     * @return int
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getBirthdate(): int
    {
        return $this->birthdate->getTimestamp();
    }

    /**
     * Get Address.
     *
     * @return \ChurchRoster\Data\Address
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * Get email.
     *
     * @return string
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get membership status.
     *
     * @return \ChurchRoster\Data\MembershipStatus
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getMembershipStatus(): MembershipStatus
    {
        return $this->membershipStatus;
    }

    /**
     * Get timestamp.
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
