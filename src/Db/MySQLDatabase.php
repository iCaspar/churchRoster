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
        $this->connection = new PDO(
            "mysql:host={$hostname};dbname={$dbName}",
            $user,
            $password
        );
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

    /**
     * Update a record.
     *
     * @param string $table The table where the record is to be found
     * @param int $id The record ID to update
     * @param array $columns The data columns to update
     *
     * @return bool
     * @author Caspar Green
     * @since  ver 1.0.0
     *
     */
    public function update(string $table, int $id, array $columns): bool
    {
        $dataSetTemplate = $this->getDataSetTemplate($columns);

        /** @noinspection SqlResolve */
        $query = "UPDATE {$table} SET {$dataSetTemplate} WHERE id = :id";
        $statement = $this->connection->prepare($query);

        foreach ($columns as $header => $value) {
            $statement->bindParam(":{$header}", $value);
        }

        $statement->bindParam(':id', $id);

        return $statement->execute();
    }

    /**
     * Delete a record.
     *
     * @param string $table The table to delete from.
     * @param int $id The record ID to delete.
     *
     * @return bool
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function delete(string $table, int $id): bool
    {
        /** @noinspection SqlResolve */
        $query = "DELETE FROM {$table} WHERE id = ?";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(1, $id);

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
}
