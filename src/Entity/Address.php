<?php
/**
 * ChurchRoster
 * Address.php
 */

namespace ChurchRoster\Entity;

class Address
{
    /**
     * @var string addressLine1 Address Line 1.
     */
    private string $addressLine1;

    /**
     * @var string addressLine1 Address Line 2.
     */
    private string $addressLine2;

    /**
     * @var string city City.
     */
    private string $city;

    /**
     * @var string state State.
     */
    private string $state;

    /**
     * @var string postCode Post Code (zipcode).
     */
    private string $postCode;

    /**
     * @var string postCodeExtension Post Code Extension.
     */
    private string $postCodeExtension;

    /**
     * Address constructor.
     *
     * @param array|null $properties (optional) Properties to set.
     */
    public function __construct(array $properties = null)
    {
        if (null === $properties) {
            return;
        }

        $this->setAddressLine1(isset($properties['addressLine1']) ?? '');
        $this->setAddressLine2(isset($properties['addressLine2']) ?? '');
        $this->setCity(isset($properties['city']) ?? '');
        $this->setState(isset($properties['state']) ?? '');
        $this->setPostCode(isset($properties['postCode']) ?? '');
        $this->setPostCodeExtension(isset($properties['postCodeExtension']) ?? '');
    }

    /**
     * Set the Address Line 1.
     *
     * @param string $addressLine1 Address Line 1 to set.
     *
     * @return $this Address with updated Line 1.
     *
     * @since 0.0.1
     */
    public function setAddressLine1(string $addressLine1): Address
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    /**
     * Get the Address Line 1.
     *
     * @return string The Address Line 1.
     *
     * @since 0.0.1
     */
    public function getAddressLine1(): string
    {
        return $this->addressLine1 ?? '';
    }

    /**
     * Set Address Line 2.
     *
     * @param string $addressLine2 Address Line 2 to set.
     *
     * @return $this Address with updated Address Line 2.
     *
     * @since 0.0.1
     */
    public function setAddressLine2(string $addressLine2): Address
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * Get Address Line 2.
     *
     * @return string The Address Line 2.
     *
     * @since 0.0.1
     */
    public function getAddressLine2(): string
    {
        return $this->addressLine2 ?? '';
    }

    /**
     * Set the City.
     *
     * @param string $city City to set.
     *
     * @return $this Address with updated City.
     *
     * @since 0.0.1
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the city.
     *
     * @return string The City.
     *
     * @since 0.0.1
     */
    public function getCity(): string
    {
        return $this->city ?? '';
    }

    /**
     * Set the State.
     *
     * @param string $state
     *
     * @return Address Address with updated State.
     *
     * @since 0.0.1
     */
    public function setState(string $state): Address
    {
        $this->state = strtoupper(substr($state, 0, 2));

        return $this;
    }

    /**
     * Get the State.
     *
     * @return string The State.
     *
     * @since 0.0.1
     */
    public function getState(): string
    {
        return $this->state ?? '';
    }

    /**
     * Set the Post Code.
     *
     * @param string $postCode Post Code to set.
     *
     * @return $this Address with updated Post Code.
     *
     * @since 0.0.1
     */
    public function setPostCode(string $postCode): Address
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get the Post Code.
     *
     * @return string The Post Code.
     *
     * @since 0.0.1
     */
    public function getPostCode(): string
    {
        return $this->postCode ?? '';
    }

    /**
     * Set the Post Code Extension.
     *
     * @param string $postCodeExtension Post Code Extension to set.
     *
     * @return $this Address with updated Post Code Extension.
     *
     * @since 0.0.1
     */
    public function setPostCodeExtension(string $postCodeExtension): Address
    {
        $this->postCodeExtension = $postCodeExtension;

        return $this;
    }

    /**
     * Get the Post Code Extension.
     *
     * @return string The Post Code Extension.
     *
     * @since 0.0.1
     */
    public function getPostCodeExtension(): string
    {
        return $this->postCodeExtension ?? '';
    }
}
