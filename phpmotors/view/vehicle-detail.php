<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Template for PHP Motors Website">
    <meta name="author" content="Branden Torrance">
    <title><?php echo $vehicle["invMake"] . " " . $vehicle["invModel"]; ?> | PHP Motors</title>

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
            <h1><?php echo $vehicle["invMake"] . " " . $vehicle["invModel"]; ?></h1>

            <?php if (isset($message)) {
                echo $message;
            } ?>
            <div id="container-details">
                <?php if (isset($detailedVehicle)) {
                    echo $detailedVehicle;
                } ?>

                <?php if (isset($buildThumbnails)) {
                    echo $buildThumbnails;
                } ?>
            </div>

            <hr>

            <h2>Customer Reviews</h2>

            <?php if (isset($_SESSION["reviewMessage"])) {
                echo $_SESSION["reviewMessage"];
            } ?>

            <?php if (!isset($_SESSION["loggedin"])) {
                echo "<p>You must <a href='/phpmotors/accounts/?action=login'>login</a> to write a review.</p>";
            } else if (isset($_SESSION["loggedin"])) {
                echo $reviewForm;
            }
            ?>
            <br>
            <hr>
            <br>
            <?php echo $buildReviewsDisplay; ?>

        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
<?php unset($_SESSION["reviewMessage"]); ?>