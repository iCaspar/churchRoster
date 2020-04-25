<?php
/**
 * ChurchRoster
 * PrivateAccess.php
 */

namespace ChurchRoster\TestTraits;

use ReflectionException;
use ReflectionProperty;

trait PrivateAccess
{
    /**
     * Get an accessible private property.
     *
     * @param string $class        Class to access.
     * @param string $propertyName Property name to access.
     *
     * @return ReflectionProperty Accessible property.
     * @throws ReflectionException
     *
     * @since 0.0.1
     */
    protected function getAccessibleProperty(string $class, string $propertyName): ReflectionProperty
    {
        $accessibleProperty = new ReflectionProperty($class, $propertyName);
        $accessibleProperty->setAccessible(true);

        return $accessibleProperty;
    }
}
