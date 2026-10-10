<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

include '../../config/db.php';

// Fetch the event details to edit
if (isset($_GET['id'])) {
    $eventId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$eventId]);
    $event = $stmt->fetch();

    if (!$event) {
        echo "Event not found.";
        exit();
    }
}

// Update event details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("UPDATE events SET title = ?, description = ?, date = ?, image = ? WHERE id = ?");
    $stmt->execute([$title, $description, $date, $image, $eventId]);

    header('Location: ../dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- TinyMCE Editor CDN -->
    <script src="https://cdn.tiny.cloud/1/04mdbp7ywbgouyn7nrhy5bna1vlwfgxrfx2n5xquhx0uvr7d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#description',  // The ID of the description textarea
            menubar: false,            // Disable the menu bar
            plugins: ['lists', 'link', 'image', 'textcolor'], // Add additional plugins if needed
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save(); // Synchronize TinyMCE content with the textarea
                });
            }
        });
    </script>
</head>
<body>
<div class="container mt-5">
    <h2>Edit Event</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" class="form-control" name="description" required><?php echo htmlspecialchars($event['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Event Date</label>
            <input type="date" class="form-control" name="date" value="<?php echo htmlspecialchars($event['date']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" class="form-control" name="image" value="<?php echo htmlspecialchars($event['image']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>
</body>
</html>
