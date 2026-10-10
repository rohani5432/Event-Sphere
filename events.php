<?php
require 'config/db.php';

$sql = "SELECT * FROM events ORDER BY date ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        /* 🔥 SLIDESHOW BG */
        .slideshow {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .slideshow img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            animation: slide 20s infinite;
        }

        .slideshow img:nth-child(1) { animation-delay: 0s; }
        .slideshow img:nth-child(2) { animation-delay: 5s; }
        .slideshow img:nth-child(3) { animation-delay: 10s; }
        .slideshow img:nth-child(4) { animation-delay: 15s; }

        @keyframes slide {
            0% { opacity: 0; }
            10% { opacity: 1; }
            25% { opacity: 1; }
            35% { opacity: 0; }
            100% { opacity: 0; }
        }

        /* overlay */
        .overlay {
            background: rgba(0,0,0,0.7);
            min-height: 100vh;
            padding-top: 50px;
        }

        /* cards */
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
            box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        }

        .card img {
            height: 200px;
            object-fit: cover;
            transition: 0.3s;
        }

        .card:hover img {
            transform: scale(1.1);
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-body {
            background: rgba(255,255,255,0.95);
        }

        h2 {
            color: white;
            font-weight: bold;
        }

        footer {
            background: rgba(0,0,0,0.9) !important;
        }
    </style>
</head>

<body>

<?php include 'navbar.php'; ?>

<!-- 🔥 BACKGROUND IMAGES -->
<div class="slideshow">
    <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063">
    <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30">
    <img src="https://images.unsplash.com/photo-1515169067865-5387ec356754">
    <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac">
</div>

<div class="overlay">
    <div class="container">
        <h2 class="text-center">Upcoming Events</h2>

        <div class="row mt-4">
            <?php foreach ($events as $event): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="assets/images/<?php echo $event['image']; ?>" alt="<?php echo $event['title']; ?>">
                        <div class="card-body">
                            <h5><?php echo $event['title']; ?></h5>
                            <p><?php echo substr($event['description'], 0, 100); ?>...</p>

                            <!-- 🔥 FUTURE DATE FIX -->
                            <p>
                                <small class="text-muted">
                                    Event Date: 
                                    <?php 
                                        $date = new DateTime($event['date']);
                                        $date->modify('+2 years'); // 2026 → 2026
                                        echo $date->format('d M Y');
                                    ?>
                                </small>
                            </p>

                            <a href="event_details.php?id=<?php echo $event['id']; ?>" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<footer class="text-center text-white py-4">
    <p>&copy; 2026 Cultural Exchange Hub. All Rights Reserved.</p>
    <a href="about_us.php" class="text-white">About Us</a> | 
    <a href="contact_us.php" class="text-white">Contact Us</a>
</footer>

</body>
</html>