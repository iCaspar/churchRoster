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
use PDO;
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
            'PDO Exception message not printed.'
        );
    }

    /**
     * Test getConnection() returns a PDO.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testGetConnectionReturnsPDO()
    {
        $database = new MySQLDatabase(
            $this->creds['test_db_host_name'],
            $this->creds['test_db_name'],
            $this->creds['test_db_user'],
            $this->creds['test_db_pass']
        );

        $connectionObject = $database->getConnection();

        $this->assertInstanceOf(
            'PDO',
            $connectionObject,
            'Connection is not a PDO.'
        );
    }

    /**
     * Test create() inserts a record into the database.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testCreateInsertsRecordIntoDatabase()
    {
        // Prepare the database for the test by creating an empty membershipstatuses table.
        // TODO: Move to SetUp() method.

        try {
            $testConn = new PDO(
                "mysql:host={$this->creds['test_db_host_name']};dbname={$this->creds['test_db_name']}",
                $this->creds['test_db_user'],
                $this->creds['test_db_pass']
            );

            $createMemberStatusesTableQuery = "CREATE TABLE `membershipstatuses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $statement = $testConn->prepare($createMemberStatusesTableQuery);
            $statement->execute();
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }

        // Create a new MySQLDatabase instance to test.

        $database = new MySQLDatabase(
            $this->creds['test_db_host_name'],
            $this->creds['test_db_name'],
            $this->creds['test_db_user'],
            $this->creds['test_db_pass']
        );

        // Run the test.
        $database->insert(
            'membershipstatuses',
            [
                'name' => 'Visitor'
            ]
        );

        // Read the membershipstatuses table and assert against result.
        $getMembershipstatusestableContentsQuery = "SELECT * FROM membershipstatuses";
        $statement = $testConn->prepare($getMembershipstatusestableContentsQuery);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals(
            'Visitor',
            $row['name'],
            'Returned wrong membership status name.'
        );

        // Reset Database after test.
        // TODO: Move to TearDown() method.

        $resetDatabaseQuery = "DROP TABLE membershipstatuses";
        $statement = $testConn->prepare($resetDatabaseQuery);
        $statement->execute();
    }
}
