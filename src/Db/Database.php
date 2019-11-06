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
}
