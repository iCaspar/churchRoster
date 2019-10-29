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
}
