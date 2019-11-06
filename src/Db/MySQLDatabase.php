<?php
/**
 * MySQL Database Connection.
 *
 * @package ChurchRoster\Db
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Db;

use PDO;
use PDOException;

/**
 * MySQL Database Connection class.
 *
 * @package ChurchRoster\Db
 * @author  Caspar Green
 * @since   ver 1.0.0
 */
class MySQLDatabase implements Database
{
    /**
     * PDO Database Connection Object.
     * @var PDO
     */
    private $connection;

    public function __construct(string $hostname, string $dbName, string $user, string $password)
    {
        try {
            $this->connection = new PDO(
                "mysql:host={$hostname};dbname={$dbName}",
                $user,
                $password
            );
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
