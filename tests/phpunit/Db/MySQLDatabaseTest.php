<?php
/**
 * Tests for MySQLConnection.
 *
 * @package ChurchRoster\Tests\Unit
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Tests\Unit\Db;

use ChurchRoster\Db\MySQLDatabase;
use PHPUnit\Framework\TestCase;
use PDOException;

class MySQLDatabaseTest extends TestCase
{
    /**
     * Test DB credentials.
     * @var array
     */
    private $creds;

    /**
     * Set up before running Connection tests.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function setUp(): void
    {
        $this->creds = include('.env/env.php');
    }

    /**
     * Test Constructor prints a PDO Exception message when it cannot connect.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testPrintsPDOExceptionMessageWhenCannotConnect()
    {
        ob_start();

        $connection = new MySQLDatabase(
            'bad_host',
            'bad_db_name',
            'bad_username',
            'bad_password'
        );

        $message = ob_get_clean();

        $this->assertStringContainsString(
            'Connection error: ',
            $message,
            'PDO Exception message error not printed.'
        );
    }

    public function testGetConnectionReturnsPDO()
    {
        $connection = new MySQLDatabase(
            $this->creds['test_db_host_name'],
            $this->creds['test_db_name'],
            $this->creds['test_db_user'],
            $this->creds['test_db_pass']
        );

        $connectionObject = $connection->getConnection();

        $this->assertInstanceOf(
            'PDO',
            $connectionObject,
            'Connection is not a PDO.'
        );
    }
}
