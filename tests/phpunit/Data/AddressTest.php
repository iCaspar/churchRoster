<?php
/**
 * Tests for Address Class.
 *
 * @package ChurchRoster\Tests\Unit\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Tests\Unit\Data;

use ChurchRoster\Data\Address;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Address Class.
 *
 * @package ChurchRoster\Tests\Unit\Data
 * @author  Caspar Green
 * @since   ver 1.0.0
 */
class AddressTest extends TestCase
{
    public function testObjectIsAddressClass()
    {
        $address = new Address(
            1,
            '123 Any Street',
            '',
            'Hometown',
            'NY',
            '12345-6789'
        );

        $this->assertInstanceOf(
            'ChurchRoster\Data\Address',
            $address,
            'Object created is not an Address class.');
    }
}
