<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

include '../../config/db.php'; // Ensure this file has the correct database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    // File upload logic
    $targetDir = "../../assets/images/";
    $originalFileName = basename($_FILES['image']['name']);
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

    // Generate a new file name with a random integer
    $randomInt = rand(1000, 9999);
    $newFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . "_" . $randomInt . "." . $fileExtension;
    $targetFilePath = $targetDir . $newFileName;

    $uploadOk = 1;

    // Check if file is a valid image
    $imageFileType = strtolower($fileExtension);
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (5MB limit)
    if ($_FILES['image']['size'] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg','webp', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $stmt = $conn->prepare("INSERT INTO events (title, description, date, image) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $description, $date, $newFileName]);
            header('Location: ../dashboard.php');
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- TinyMCE Editor CDN -->
    <script src="https://cdn.tiny.cloud/1/04mdbp7ywbgouyn7nrhy5bna1vlwfgxrfx2n5xquhx0uvr7d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#description', 
            menubar: false,
            plugins: ['lists', 'link', 'image', 'textcolor'],
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save(); // Synchronize TinyMCE content with textarea
                });
            }
        });
    </script>
</head>
<body>
<?php include('../navbar.php'); ?>
<div class="container mt-5">
    <h2>Create New Event</h2>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" class="form-control" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Event Date</label>
            <input type="date" class="form-control" name="date" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Event Image</label>
            <input type="file" class="form-control" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
</body>
</html>
