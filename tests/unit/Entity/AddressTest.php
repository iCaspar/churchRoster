<?php
/**
 * ChurchRoster
 * AddressTest.php
 */

namespace ChurchRoster\Entity;

use ChurchRoster\TestCases\EntityTestCase;
use ReflectionException;

class AddressTest extends EntityTestCase
{
    /**
     * @var Address address Address to test.
     */
    private Address $address;

    /**
     * Set up before each test.
     *
     * @return void
     *
     * @since 0.0.1
     */
    public function setUp(): void
    {
        $this->address = new Address();
    }

    /**
     * Provide properties data for getter and setter tests.
     *
     * @return array
     *
     * @since 0.0.1
     */
    public function propertiesDataProvider(): array
    {
        return [
            ['addressLine1', '123 Main Street', 'AddressLine1'],
            ['addressLine2', 'Apt. 3-B', 'AddressLine2'],
            ['city', 'Anytown', 'City'],
            ['state', 'NY', 'State'],
            ['postCode', '12345', 'PostCode'],
            ['postCodeExtension', '6789', 'PostCodeExtension']
        ];
    }

    /**
     * Test Setter methods should set their properties.
     *
     * @dataProvider propertiesDataProvider
     *
     * @param string $propertyName  Name of property to set.
     * @param string $propertyValue Value of property to set.
     * @param string $methodStub    Stub of the setter method name.
     *
     * @return void
     * @throws ReflectionException
     *
     * @since        0.0.1
     */
    public function testSettersShouldSetTheirProperties(
        string $propertyName,
        string $propertyValue,
        string $methodStub
    ): void {
        $this->assertStringPropertySetterShouldSetItsProperty(
            $this->address,
            $propertyName,
            $propertyValue,
            $methodStub
        );
    }

    /**
     * Test Getter Methods should get their properties when set.
     *
     * @dataProvider propertiesDataProvider
     *
     * @param string $propertyName  Name of property to get.
     * @param string $propertyValue Expected Value of property.
     * @param string $methodStub    Stub of the getter method name.
     *
     * @return void
     * @throws ReflectionException
     *
     * @since        0.0.1
     */
    public function testGettersShouldReturnTheirPropertiesWhenSet(
        string $propertyName,
        string $propertyValue,
        string $methodStub
    ): void {
        $this->assertStringGetterShouldReturnItsPropertyWhenSet(
            $this->address,
            $propertyName,
            $propertyValue,
            $methodStub
        );
    }

    /**
     * Test getter methods should return an empty string when not set.
     *
     * @dataProvider propertiesDataProvider
     *
     * @param string $propertyName  (not used)
     * @param string $propertyValue (not used)
     * @param string $methodStub    Stub of getter method name.
     *
     * @return void
     *
     * @since        0.0.1
     */
    public function testGettersShouldReturnEmptyStringWhenNotSet(
        string $propertyName,
        string $propertyValue,
        string $methodStub
    ): void {
        $this->assertStringGetterShouldReturnEmptyStringWhenNotSet(
            $this->address,
            $propertyName,
            $propertyValue,
            $methodStub
        );
    }
}
