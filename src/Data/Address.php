<?php
/**
 * Address Class.
 *
 * @package ChurchRoster\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Data;

use DateTime;

/**
 * Address Class.
 *
 * @package ChurchRoster\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */
class Address
{
    private $id;
    private $streetLine1;
    private $streetLine2;
    private $city;
    private $state;
    private $zipcode;
    private $timeStamp;

    /**
     * Address constructor.
     * @param int $id
     * @param string $streetLine1
     * @param string $streetLine2
     * @param string $city
     * @param string $state
     * @param string $zipcode
     * @throws \Exception
     */
    public function __construct(
        int $id,
        string $streetLine1,
        string $streetLine2,
        string $city,
        string $state,
        string $zipcode
    ) {
        $this->id = $id;
        $this->streetLine1 = $streetLine1;
        $this->streetLine2 = $streetLine2;
        $this->city = $city;
        $this->state = $state;
        $this->zipcode = $zipcode;
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
     * Get Street Line1.
     *
     * @return string
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getStreetLine1(): string
    {
        return $this->streetLine1;
    }

    /**
     * Get Street Line2.
     *
     * @return string
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getStreetLine2(): string
    {
        return $this->streetLine2;
    }

    /**
     * Get City.
     *
     * @return string
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Get State.
     *
     * @return string
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * Get Zipcode.
     *
     * @return string
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * Get Time Stamp.
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
