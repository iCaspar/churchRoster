<?php
/**
 * ChurchRoster
 * EntityTestCase.php
 */

namespace ChurchRoster\TestCases;

use ChurchRoster\TestTraits\PrivateAccess;
use PHPUnit\Framework\TestCase;

class EntityTestCase extends TestCase
{
    use PrivateAccess;

    /**
     * Assert that a string setter method should set its property.
     *
     * @param object $entity        Entity object to assert against.
     * @param string $propertyName  Property name for assertion.
     * @param string $propertyValue Property value for assertion.
     * @param string $methodStub    Stub for setter method name.
     *
     * @return void
     *
     * @throws \ReflectionException
     * @since 0.0.1
     */
    public function assertStringPropertySetterShouldSetItsProperty(
        object $entity,
        string $propertyName,
        string $propertyValue,
        string $methodStub
    ): void {
        $property     = $this->getAccessibleProperty(get_class($entity), $propertyName);
        $setterMethod = 'set' . $methodStub;

        $updatedAddress = $entity->$setterMethod($propertyValue);

        $this->assertEquals($propertyValue, $property->getValue($updatedAddress));
    }

    /**
     * Assert that a string getter method should get its property when set.
     *
     * @param object $entity        Entity object to assert against.
     * @param string $propertyName  Property name for assertion.
     * @param string $propertyValue Property value for assertion.
     * @param string $methodStub    Stub for setter method name.
     *
     * @return void
     * @throws \ReflectionException
     *
     * @since 0.0.1
     */
    public function assertStringGetterShouldReturnItsPropertyWhenSet(
        object $entity,
        string $propertyName,
        string $propertyValue,
        string $methodStub
    ): void {
        $property = $this->getAccessibleProperty(get_class($entity), $propertyName);
        $property->setValue($entity, $propertyValue);
        $getterMethod = 'get' . $methodStub;

        $this->assertEquals($propertyValue, $entity->$getterMethod());
    }

    /**
     * Short Description
     *
     * @param object $entity        Entity object to assert against.
     * @param string $propertyName  (not used) Property name for assertion.
     * @param string $propertyValue (not used) Property value for assertion.
     * @param string $methodStub    Stub for setter method name.
     *
     * @return void
     *
     * @since 0.0.1
     */
    public function assertStringGetterShouldReturnEmptyStringWhenNotSet(
        object $entity,
        string $propertyName,
        string $propertyValue,
        string $methodStub
    ): void {
        $getterMethod = 'get' . $methodStub;

        $this->assertEquals('', $entity->$getterMethod());
    }

}
