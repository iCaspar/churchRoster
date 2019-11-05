<?php
/**
 * Church Roster Project Root.
 *
 * @author  Caspar Green
 * @since   1.0.0
 */

require_once 'vendor/autoload.php';


$dbCreds = include('.env/env.php');

$connection = new \ChurchRoster\Db\MySQLConnection(
    $dbCreds['host_name'],
    $dbCreds['db_name'],
    $dbCreds['db_user'],
    $dbCreds['db_pass']
);
?>

<!doctype html>
<html>
<head>
    <title>Church Roster</title>
</head>
<body>
<h1>Church Roster</h1>
<?php
var_dump($connection);
?>
</body>
</html>
