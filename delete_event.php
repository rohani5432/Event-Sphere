<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

include '../../config/db.php';

if (isset($_GET['id'])) {
    $eventId = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->execute([$eventId]);

    header('Location: ../dashboard.php');
    exit();
} else {
    echo "Invalid request.";
}
?>
