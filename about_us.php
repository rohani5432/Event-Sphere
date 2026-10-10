<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - EventSphere</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        /* 🔥 Background Slideshow */
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

        /* Overlay */
        .overlay {
            background: rgba(0, 0, 0, 0.6);
            min-height: 100vh;
            padding-top: 80px;
        }

        /* Content Box */
        .about-box {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.5);
            transition: 0.3s;
        }

        .about-box:hover {
            transform: scale(1.02);
        }

        h1 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.7;
        }

        footer {
            background: rgba(0,0,0,0.8) !important;
        }
    </style>
</head>

<body>

<?php include 'navbar.php'; ?>

<!-- 🔥 Background Images -->
<div class="slideshow">
    <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063">
    <img src="https://images.unsplash.com/photo-1515169067865-5387ec356754">
    <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac">
    <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30">
</div>

<div class="overlay">
    <div class="container">
        <div class="about-box mt-5">

            <h1>About Us</h1>

            <p>
                Welcome to the EventSphere, a platform dedicated to celebrating the rich cultural diversity of the world. Our mission is to bring people together through events and activities that promote cultural understanding, knowledge sharing, and community building.
            </p>

            <p>
                We believe that cultural exchange is a powerful way to bridge gaps between communities, foster mutual respect, and create lasting connections. Our events focus on food, art, crafts, and traditional practices that highlight the beauty and uniqueness of different cultures.
            </p>

            <p>
                Join us in our journey to build a better future through cultural exchange. Explore our events, participate in activities, and connect with like-minded individuals who share a passion for learning and sharing cultures.
            </p>

        </div>
    </div>
</div>

<footer class="text-center text-white py-4 mt-5">
    <p>&copy; 2026 EventSphere. All Rights Reserved.</p>
    <a href="index.php" class="text-white">Home</a> | 
    <a href="contact_us.php" class="text-white">Contact Us</a>
</footer>

</body>
</html>