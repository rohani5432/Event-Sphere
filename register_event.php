<?php
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $event_id = $_POST['event_id'];

    $sql = "INSERT INTO registrations (user_name, user_email, event_id, registration_date) VALUES (:name, :email, :event_id, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['name' => $name, 'email' => $email, 'event_id' => $event_id]);

    echo "Thank you for registering!";
}
?>
