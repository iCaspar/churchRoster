<?php
/**
 * ChurchRoster
 * Person.php
 */

namespace ChurchRoster\Entity;

class Person
{
    /**
     * @var string firstName First Name.
     */
    private string $firstName;

    /**
     * @var string lastName Last Name.
     */
    private string $lastName;

    /**
     * @var Address address Address.
     */
    private Address $address;

    /**
     * Person constructor.
     *
     * @param array|null $properties (optional) Properties to set.
     */
    public function __construct(array $properties = null)
    {
        if (null === $properties) {
            return;
        }

        $this->setFirstName(isset($properties['firstName']) ?? '');
        $this->setLastName(isset($properties['lastName']) ?? '');
        $this->setAddress(isset($properties['address']) ?? new Address());
    }

    /**
     * Set the First Name.
     *
     * @param string $firstName Name to set.
     *
     * @return $this Person with updated First Name.
     *
     * @since 0.0.1
     */
    public function setFirstName(string $firstName): Person
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the First Name.
     *
     * @return string The First Name.
     *
     * @since 0.0.1
     */
    public function getFirstName(): string
    {
        return $this->firstName ?? '';
    }

    /**
     * Set the Last Name.
     *
     * @param string $lastName Name to set.
     *
     * @return $this Person with updated Last Name.
     *
     * @since 0.0.1
     */
    public function setLastName(string $lastName): Person
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the Last Name.
     *
     * @return string The Last Name.
     *
     * @since 0.0.1
     */
    public function getLastName(): string
    {
        return $this->lastName ?? '';
    }

    /**
     * Set the address.
     *
     * @param Address $address
     *
     * @return $this Person with updated address.
     *
     * @since 0.0.1
     */
    public function setAddress(Address $address): Person
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the Address.
     *
     * @return Address The Address.
     *
     * @since 0.0.1
     */
    public function getAddress(): Address
    {
        return $this->address ?? new Address();
    }
}
