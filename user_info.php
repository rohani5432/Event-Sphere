<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

include '../config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include ('navbar.php');?>
<div class="container mt-5">
    <h2>Registered Users</h2>
    <table class="table table-bordered mt-3">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Event</th>
            <th>Registration Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $stmt = $conn->prepare("
            SELECT r.user_name, r.user_email, e.title AS event_title, r.registration_date
            FROM registrations r
            JOIN events e ON r.event_id = e.id
        ");
        $stmt->execute();
        $users = $stmt->fetchAll();

        if ($users) {
            foreach ($users as $user) {
                echo "<tr>
                        <td>{$user['user_name']}</td>
                        <td>{$user['user_email']}</td>
                        <td>{$user['event_title']}</td>
                        <td>{$user['registration_date']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>No users registered yet.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
