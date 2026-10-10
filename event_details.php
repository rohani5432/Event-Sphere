<?php
require 'config/db.php';

// ID safely lo
$event_id = $_GET['id'] ?? 0;

// fetch event
$sql = "SELECT * FROM events WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $event_id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

// agar empty hai to crash na ho
if (!$event) {
    $event = [
        'title' => 'Event',
        'description' => 'No description available',
        'image' => 'default.jpg',
        'date' => date('Y-m-d')
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $event['title']; ?> - Event Details</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
body {
    margin: 0;
    font-family: Arial;
}

/* 🔥 BG */
.bg {
    position: fixed;
    width: 100%;
    height: 100%;
    background: url('https://images.unsplash.com/photo-1506157786151-b8491531f063') no-repeat center center/cover;
    z-index: -1;
}

.overlay {
    background: rgba(0,0,0,0.7);
    min-height: 100vh;
    padding: 60px 0;
}

/* layout */
.box {
    background: rgba(255,255,255,0.95);
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

.event-img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    border-radius: 10px;
}

.registration-form {
    position: sticky;
    top: 20px;
}

/* button */
.btn-custom {
    background: linear-gradient(45deg, #ff6a00, #ee0979);
    border: none;
    color: white;
}

.btn-custom:hover {
    transform: scale(1.05);
}
</style>
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="bg"></div>

<div class="overlay">
<div class="container">
<div class="row g-4">

    <!-- LEFT -->
    <div class="col-md-8">
        <div class="box">
            <h2><?php echo $event['title']; ?></h2>

            <img src="assets/images/<?php echo $event['image']; ?>" class="event-img my-3">

            <p><?php echo $event['description']; ?></p>

            <p><strong>Date:</strong>
                <?php
                $date = new DateTime($event['date']);
                $date->modify('+2 years');
                echo $date->format('d M Y');
                ?>
            </p>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="col-md-4">
        <div class="box registration-form">

            <h4>Register for this Event</h4>

            <form action="register_event.php" method="POST">
                <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <button type="submit" class="btn btn-custom w-100">Register Now</button>
            </form>

        </div>
    </div>

</div>
</div>
</div>

</body>
</html>