<?php
/**
 * Database Connection Interface.
 *
 * @package ChurchRoster\Db
 * @author  Caspar Green
 * @since   ver 1.0.0
 */

namespace ChurchRoster\Db;

/**
 * Interface DbConnection
 * @package ChurchRoster\Db
 */
interface Database
{
    /**
     * Insert a record.
     *
     * @return bool
     * @since  ver 1.0.0
     *
     * @author Caspar Green
     */
    public function insert(string $table, array $columns): bool;

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
    public function read(string $table): array;

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
    public function update(string $table, int $id, array $columns): bool;

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
    public function delete(string $table, int $id): bool;
}
