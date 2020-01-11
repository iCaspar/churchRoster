<?php
/**
 * Church Roster Project Root.
 *
 * @author  Caspar Green
 * @since   1.0.0
 */

use ChurchRoster\Db\MySQLDatabase;
use Dotenv\Dotenv;

require_once 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $database = new MySQLDatabase(
        getenv('DB_HOST'),
        getenv('DB_NAME'),
        getenv('DB_USER'),
        getenv('DB_PASS')
    );
} catch (PDOException $exception) {
    echo 'Database Error: ' . $exception->getMessage();
}

if ($_POST && 'Save Membership Status' === $_POST['submit']) {
    $name = htmlspecialchars(strip_tags($_POST['name']));

    try {
        $result = $database->insert('membershipstatuses', ['name' => $name]);
        $notice = $result ? 'New Membership Status added.' : 'Failed adding new Membership Status.';
    } catch (PDOException $exception) {
        echo 'Database Error: ' . $exception->getMessage();
    }
}

if ($_POST && 'Rename Status' === $_POST['submit']) {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $id = (int)$_POST['id'];

    try {
        $result = $database->update('membershipstatuses', $id, ['name' => $name]);
        $notice = $result ? 'Membership Status Updated.' : 'Failed updating Membership Status.';
    } catch (PDOException $exception) {
        echo 'Database Error: ' . $exception->getMessage();
    }
}

if ($_POST && 'Remove Status' === $_POST['submit']) {
    $id = (int)$_POST['id'];

    try {
        $result = $database->delete('membershipstatuses', $id);
        $notice = $result ? 'Membership Status Removed.' : 'Failed removing Membership Status.';
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
<html lang="en">
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
            <h3>Add an Item:</h3>
            <table class="table table-add-item">
                <tr>
                    <td><label for="add-name">Membership Status Name:</label>
                        <input type="text" name="name" id="add-name" class="form-control"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Save Membership Status"
                               class="button button-primary"/></td>
                </tr>
            </table>
        </form>
        <form method="post">
            <h3>Update an Item:</h3>
            <table class="table table-edit-item">
                <tr>
                    <td><label for="edit-id">Membership Status ID:</label>
                        <input type="number" name="id" id="edit-id" class="form-control"/></td>
                </tr>
                <tr>
                    <td>
                        <label for="edit-name">New Status Name:</label>
                        <input type="text" name="name" id="edit-name" class="form-control"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Rename Status"
                               class="button button-primary"/></td>
                </tr>
            </table>
        </form>
        <form method="post">
            <h3>Remove an Item:</h3>
            <table>
                <tr>
                    <td>
                        <label for="remove-id">Membership Status ID to remove:</label>
                        <input type="number" name="id" id="remove-id" class="form-control"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Remove Status"
                               class="button button-primary"</td>
                </tr>
            </table>
        </form>
    </section>
</div>

</body>
</html>
