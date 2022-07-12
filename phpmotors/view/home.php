<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Template for PHP Motors Website">
    <meta name="author" content="Branden Torrance">
    <title>Home | PHP Motors</title>

    <!-- Stylesheets -->
    <link href="/phpmotors/css/small.css" rel="stylesheet" media="screen">
    <link href="/phpmotors/css/large.css" rel="stylesheet" media="screen">
    <link href="/phpmotors/css/normalize.css" rel="stylesheet" media="screen">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono&display=swap" rel="stylesheet">
</head>

<body>
    <div class="site-wrapper">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>

        <main>
            <h1>Welcome to PHP Motors!</h1>
            <div class="hero-container">
                <img class="hero-img" src="/phpmotors/images/vehicles/delorean.jpg" alt="Delorean car">
                <div class="hero-cta">
                    <!-- cta = Call To Action -->
                    <p>
                        <strong>DMC Delorean</strong><br>
                        3 Cup holders<br>
                        Superman doors<br>
                        Fuzzy dice!
                    </p>
                    <button type="button">Own Today</button>
                </div>
            </div>
            <div class="grid-large-view">
                <div class="reviews-container">
                    <h2>DMC Delorean Reviews</h2>
                    <ul class="reviews">
                        <li>"So fast its almost like traveling in time." (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day." (4.5/5)</li>
                        <li>"80's livin and I love it!" (5/5)</li>
                    </ul>
                </div>
                <div class="upgrade-container">
                    <h2 class="row1">Delorean Upgrades</h2>
                    <div class="grid-color">
                        <img class="col1 row2" src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux capacitor upgrade">
                    </div>
                    <a href="#" class="col1 row3">Flux Capacitor</a>
                    <div class="grid-color">
                        <img class="col2 row2" src="/phpmotors/images/upgrades/flame.jpg" alt="Flame decals upgrade">
                    </div>
                    <a href="#" class="col2 row3">Flame Decals</a>
                    <div class="grid-color">
                        <img class="col1 row4" src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper stickers upgrade">
                    </div>
                    <a href="#" class="col1 row5">Bumper Stickers</a>
                    <div class="grid-color">
                        <img class="col2 row4" src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub caps upgrade">
                    </div>
                    <a href="#" class="col2 row5">Hub Caps</a>
                </div>
            </div>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>

</html>