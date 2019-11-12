<?php
/**
 * Church Roster Project Root.
 *
 * @author  Caspar Green
 * @since   1.0.0
 */

use ChurchRoster\Db\MySQLDatabase;

require_once 'vendor/autoload.php';

$dbCreds = include('.env/env.php');

try {
    $database = new MySQLDatabase(
        $dbCreds['host_name'],
        $dbCreds['db_name'],
        $dbCreds['db_user'],
        $dbCreds['db_pass']
    );
} catch (PDOException $exception) {
    echo 'Database Error: ' . $exception->getMessage();
}

if ($_POST && 'Save Membership Status' === $_POST['submit']) {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    try {
        $result = $database->insert('membershipstatuses', ['name' => $name]);
        $notice = $result ? 'New Membership Status added!' : 'Failed adding new Membership Status!';
    } catch (PDOException $exception) {
        echo 'Database Error: ' . $exception->getMessage();
    }
}

$tableContents = [];

try {
    $readMembershipTableQuery = "SELECT * FROM membershipstatuses";
    $statement = $database->getConnection()->prepare($readMembershipTableQuery);
    $statement->execute();
    $membershipTableContents = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo 'Database Error: ' . $exception->getMessage();
}
?>

<!doctype html>
<html>
<head>
    <title>Church Roster</title>
</head>
<body>
<h1>Church Roster</h1>

<div class="container">
    <div class="connection-response"><?php var_dump($database); ?></div>
    <section>
        <div class="section-header">
            <h2>Membership Statuses</h2>
        </div>
        <p class="notice">
            <?php if ($notice) {
                echo $notice;
            } ?></p>
        <div>
            <table class="membershipstatus-table">
                <?php foreach ($membershipTableContents as $row) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['timestamp']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <form method="post">
            <table class="table table-add-item">
                <h3>Add an Item:</h3>
                <tr>
                    <td>Membership Status Name</td>
                    <td><input type="text" name="name" class="form-control"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Save Membership Status"
                               class="button button-primary"/></td>
                </tr>
            </table>
        </form>
    </section>
</div>

</body>
</html>
