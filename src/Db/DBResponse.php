<?php
/**
 * Database Response Interface.
 *
 * @package ChurchRoster\Db
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Db;

use PDOStatement;

/**
 * Interface DBResponse.
 * @package ChurchRoster\Db
 */
interface DBResponse
{
    /**
     * Is the database response an error.
     *
     * @return bool
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function isError(): bool;

    /**
     * Get the response message.
     *
     * @return string
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getMessage(): string;

    /**
     * Get the PDO Statement.
     *
     * @return PDOStatement
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getStatement(): PDOStatement;

    /**
     * Get the response content.
     *
     * @return array
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function getResponseContent(): array;
}
