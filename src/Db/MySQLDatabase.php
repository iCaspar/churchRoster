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

    /**
     * Get the database's PDO connection object.
     *
     * @return PDO
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    /**
     * Insert a record.
     *
     * @param string $table Table in which to insert the record.
     * @param array $columns Data to insert.
     * @return bool
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function insert(string $table, array $columns): bool
    {
        $dataSetTemplate = $this->getDataSetTemplate($columns);

        $query = "INSERT INTO {$table} SET {$dataSetTemplate}";
        $statement = $this->connection->prepare($query);

        foreach ($columns as $header => $value) {
            $statement->bindParam(":{$header}", $value);
        }

        return $statement->execute();
    }

    /**
     * Get a dataset query template for a set of columns.
     *
     * @param array $columns Data columns for the query.
     *
     * @return string The dataset template string.
     * @author Caspar Green
     * @since  ver 1.0.0
     *
     */
    protected function getDataSetTemplate(array $columns): string
    {
        $dataSetTemplate = '';

        foreach ($columns as $header => $value) {
            $dataSetTemplate .= "{$header}=:{$header}, ";
        }

        return trim($dataSetTemplate, ', ');
    }

    /**
     * Read contents of a table.
     *
     * @param string $table Table to read.
     *
     * @return array Table contents.
     * @author Caspar Green
     * @since  ver 1.0.0
     *
     */
    public function read(string $table): array
    {
        $query = "SELECT * from {$table}";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        $result = $statement->rowCount() > 0 ? $statement->fetchAll(PDO::FETCH_ASSOC) : [];
        return $result;
    }
}
