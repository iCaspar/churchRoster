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
    private static $creds;

    /**
     * DB Connection for configuring tests.
     * @var PDO
     */
    private static $testConn;

    /**
     * MySQLDatabase object to test.
     * @var MySQLDatabase
     */
    private static $database;

    /**
     * Set up before running tests.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public static function setUpBeforeClass(): void
    {
        $creds = include 'tests/phpunit/.env/testenv.php';
        self::$creds = $creds;

        try {
            self::$testConn = new PDO(
                "mysql:host={$creds['test_db_host_name']};dbname={$creds['test_db_name']}",
                $creds['test_db_user'],
                $creds['test_db_pass']
            );

            self::$database = new MySQLDatabase(
                self::$creds['test_db_host_name'],
                self::$creds['test_db_name'],
                self::$creds['test_db_user'],
                self::$creds['test_db_pass']
            );

        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    /**
     * Tear down after all tests.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public static function tearDownAfterClass(): void
    {
        $dropAllQuery = "DROP TABLE *";
        $statement = self::$testConn->prepare($dropAllQuery);
        $statement->execute();

        self::$testConn = null;
        self::$database = null;
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
        $connectionObject = self::$database->getConnection();

        $this->assertInstanceOf(
            'PDO',
            $connectionObject,
            'Connection is not a PDO.'
        );
    }

    /**
     * Test insert() inserts a record into the database.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testInsertInsertsRecordIntoDatabase()
    {
        $this->createMembershipStatusesTable();

        self::$database->insert(
            'membershipstatuses',
            [
                'name' => 'Visitor'
            ]
        );

        $getMembershipstatusestableContentsQuery = "SELECT * FROM membershipstatuses";
        $statement = self::$testConn->prepare($getMembershipstatusestableContentsQuery);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals(
            'Visitor',
            $row['name'],
            'Returned wrong membership status name.'
        );

        $this->cleanUpMembershipStatuses();
    }

    /**
     * Test read() reads a table's contents.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testReadReadsTableContents()
    {
        $this->createMembershipStatusesTable();
        $this->insertMembershipStatusRecord();

        $result = self::$database->read('membershipstatuses');

        $this->assertCount(1, $result);
        $this->assertArrayHasKey('name', $result[0]);
        $this->assertEquals('Visitor', $result[0]['name']);

        $this->cleanUpMembershipStatuses();
    }

    /**
     * Test update() updates the indicated record.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function testUpdateUpdatesIndicatedRecord()
    {
        $this->createMembershipStatusesTable();
        $this->insertMembershipStatusRecord();

        self::$database->update(
            'membershipstatuses',
            1,
            [
                'name' => 'Member'
            ]
        );

        $getRecordQuery = "SELECT * FROM membershipstatuses";
        $statement = self::$testConn->prepare($getRecordQuery);
        $statement->execute();
        $testRecord = $statement->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals('Member', $testRecord['name']);

        $this->cleanUpMembershipStatuses();
    }

    /**
     * Create a membershipstatuses table in the test database.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    private function createMembershipStatusesTable()
    {
        try {
            $createMemberStatusesTableQuery = "CREATE TABLE `membershipstatuses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $statement = self::$testConn->prepare($createMemberStatusesTableQuery);
            $statement->execute();

        } catch (PDOException $e) {
            die('Read Table Test Error: ' . $e->getMessage());
        }
    }

    /**
     * Enter a sample record in the membershipstatuses table.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    private function insertMembershipStatusRecord()
    {
        try {
            $name = 'Visitor';
            $insertMemberStatusesQuery = "INSERT into membershipstatuses SET name=:name";
            $statement = self::$testConn->prepare($insertMemberStatusesQuery);
            $statement->bindParam(":name", $name);
            $statement->execute();
        } catch (PDOException $e) {
            die('Read Table Test Error: ' . $e->getMessage());
        }
    }

    /**
     * Cleanup test Membershipstatuses table.
     *
     * @return void
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    private function cleanUpMembershipStatuses()
    {
        try {
            $resetDatabaseQuery = "DROP TABLE membershipstatuses";
            $statement = self::$testConn->prepare($resetDatabaseQuery);
            $statement->execute();
        } catch (PDOException $e) {
            die('Test DB Cleanup Error: ' . $e->getMessage());
        }
    }
}
