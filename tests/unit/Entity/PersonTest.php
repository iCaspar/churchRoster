<?php
/**
 * ChurchRoster
 * PersonTest.php
 */

namespace ChurchRoster\Entity;

use ChurchRoster\TestTraits\PrivateAccess;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class PersonTest extends TestCase
{
    use PrivateAccess;

    /**
     * @var Person Person Test Person.
     */
    private Person $person;

    /**
     * Set up before each test.
     *
     * @return void
     *
     * @since 0.0.1
     */
    public function setUp(): void
    {
        $this->person = new Person;
    }

    /**
     * Test setFirstName() should set the firstName property.
     *
     * @return void
     *
     * @throws ReflectionException
     * @since 0.0.1
     */
    public function testSetFirstNameShouldSetFirstNameProperty(): void
    {
        $firstNameProperty = $this->getAccessibleProperty(__NAMESPACE__ . '\Person', 'firstName');

        $updatedPerson = $this->person->setFirstName('Jane');

        $this->assertEquals('Jane', $firstNameProperty->getValue($updatedPerson));
    }

    /**
     * Test getFirstName() should return the firstName property when set.
     *
     * @return void
     * @throws ReflectionException
     *
     * @since 0.0.1
     */
    public function testGetFirstNameShouldReturnFirstNamePropertyWhenSet(): void
    {
        $firstNameProperty = $this->getAccessibleProperty(__NAMESPACE__ . '\Person', 'firstName');
        $firstNameProperty->setValue($this->person, 'Jane');

        $this->assertEquals('Jane', $this->person->getFirstName());
    }

    /**
     * Test getFirstName() should return an empty string when not set.
     *
     * @return void
     *
     * @since 0.0.1
     */
    public function testGetFirstNameShouldReturnEmptyStringWhenNotSet(): void
    {
        $this->assertEquals('', $this->person->getFirstName());
    }

    /**
     * Test setLastName() should set the lastName property.
     *
     * @return void
     * @throws ReflectionException
     *
     * @since 0.0.1
     */
    public function testSetLastNameShouldSetLastNameProperty(): void
    {
        $lastNameProperty = $this->getAccessibleProperty(__NAMESPACE__ . '\Person', 'lastName');

        $updatedPerson = $this->person->setLastName('Doe');

        $this->assertEquals('Doe', $lastNameProperty->getValue($updatedPerson));
    }

    /**
     * Test getLastName() should return lastName property when set.
     *
     * @return void
     * @throws ReflectionException
     *
     * @since 0.0.1
     */
    public function testGetLastNameShouldGetLastNamePropertyWhenSet(): void
    {
        $lastnameProperty = $this->getAccessibleProperty(__NAMESPACE__ . '\Person', 'lastName');
        $lastnameProperty->setValue($this->person, 'Doe');

        $this->assertEquals('Doe', $this->person->getLastName());
    }

    public function testGetLastNameShouldReturnEmptyStringWhenNotSet(): void
    {
        $this->assertEquals('', $this->person->getLastName());
    }

    /**
     * Test setAddress() should set the address property.
     *
     * @return void
     *
     * @throws ReflectionException
     * @since 0.0.1
     */
    public function testSetAddressShouldSetAddressProperty(): void
    {
        $addressProperty = $this->getAccessibleProperty(__NAMESPACE__ . '\Person', 'address');
        /** @var Address|MockInterface $address */
        $address = Mockery::mock(__NAMESPACE__ . '\Address');

        $updatedPerson = $this->person->setAddress($address);

        $this->assertSame($address, $addressProperty->getValue($updatedPerson));
    }

    /**
     * Test getAddress() should return the Address when set.
     *
     * @return void
     * @throws ReflectionException
     *
     * @since 0.0.1
     */
    public function testGetAddressShouldReturnAddressWhenSet(): void
    {
        $addressProperty = $this->getAccessibleProperty(__NAMESPACE__ . '\Person', 'address');
        /** @var Address|MockInterface $address */
        $address = Mockery::mock(__NAMESPACE__ . '\Address');
        $addressProperty->setValue($this->person, $address);

        $this->assertSame($address, $this->person->getAddress());
    }

    /**
     * Tests getAddress() should return a new address when not set.
     *
     * @return void
     *
     * @since 0.0.1
     */
    public function testGetAddressShouldReturnNewAddressWhenNotSet(): void
    {
        $address = $this->person->getAddress();

        $this->assertInstanceOf(__NAMESPACE__ . '\Address', $address);
    }
}
