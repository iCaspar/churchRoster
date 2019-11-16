<?php
/**
 * Tests for Base DB Response class.
 *
 * @package ChurchRoster\Tests\Unit\Db
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Tests\Unit\Db;

use ChurchRoster\Db\DBResponseBase;
use PHPUnit\Framework\TestCase;
use PDOStatement;

class DBResponseBaseTest extends TestCase
{
    /**
     * Test __construct() returns a DBResponse.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testConstructReturnsDBResponse()
    {
        $this->assertInstanceOf('ChurchRoster\Db\DBResponse', new DBResponseBase(new PDOStatement()));
    }

    /**
     * Test isError() returns correct response error status.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testIsErrorReturnsCorrectErrorStatus()
    {
        $responseNoError = new DBResponseBase(new PDOStatement());
        $this->assertFalse($responseNoError->isError());

        $responseIsError = new DBResponseBase(new PDOStatement(), true);
        $this->assertTrue($responseIsError->isError());
    }

    /**
     * Test getMessage() returns the response message.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testGetMessageReturnsResponseMessage()
    {
        $response = new DBResponseBase(new PDOStatement(), true, 'An error message.');
        $this->assertEquals('An error message.', $response->getMessage());
    }

    /**
     * Test getStatement() returns PDO Statement.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testGetPDOSatementReturnsPDOStatement()
    {
        $statement = new PDOStatement();

        $response = new DBResponseBase($statement);
        $this->assertSame($statement, $response->getStatement());
    }

    /**
     * Test getResponseContent() returns response content.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testResponseContentReturnsContent()
    {
        $response = new DBResponseBase(
            new PDOStatement(),
            false,
            '',
            ['Heading' => 'value']
        );

        $this->assertSame(
            ['Heading' => 'value'],
            $response->getResponseContent()
        );
    }
}
