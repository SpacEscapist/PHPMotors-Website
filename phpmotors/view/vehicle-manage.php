<?php
// Check if user is NOT logged in or if user DOES NOT have level access
if ((!$_SESSION["loggedin"]) || !($_SESSION["clientData"]["clientLevel"] > 1)) {
    header("Location: /phpmotors/");
    exit;
}
// Check for SESSION message
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Template for PHP Motors Website">
    <meta name="author" content="Branden Torrance">
    <title>Vehicle Management | PHP Motors</title>

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
            <h1>Vehicle Management</h1>

            <ul>
                <li><a href="/phpmotors/vehicles/?action=add-classification">Add Classification</a></li>
                <li><a href="/phpmotors/vehicles/?action=add-vehicle">Add Vehicle</a></li>
            </ul>

            <?php
            if (isset($message)) {
                echo $message;
            }
            if (isset($classificationList)) {
                echo "<h2>Vehicles By Classification</h2>";
                echo "<p>Choose a classification to see those vehicles</p>";
                echo $classificationList;
            }
            ?>

            <noscript>
                <p><strong>JavaScript Must Be Enabled to Use this Page</strong></p>
            </noscript>

            <table id="inventoryDisplay"></table>

        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>