<?php
if (!$_SESSION["loggedin"]) {
    header("Location: /phpmotors/");
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
    <title>Admin | PHP Motors</title>

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
            <h1><?php echo $_SESSION["clientData"]["clientFirstname"] . " " . $_SESSION["clientData"]["clientLastname"]; ?></h1>

            <?php
            if (isset($_SESSION["message"])) {
                echo $_SESSION["message"];
            } ?>

            <p><strong>You are logged in as:</strong></p>
            <ul>
                <li>First name: <?php echo $_SESSION["clientData"]["clientFirstname"]; ?></li>
                <li>Last name: <?php echo $_SESSION["clientData"]["clientLastname"]; ?></li>
                <li>Email: <?php echo $_SESSION["clientData"]["clientEmail"]; ?></li>
            </ul><br>

            <h2>Account Management</h2>
            <p>Use the link below to update account information</p>
            <a href="/phpmotors/accounts/?action=modify">Update Account Information</a><br><br>

            <h2>Manage Your Product Reviews</h2>
            <?php if (isset($specificReviews)) {
                echo $specificReviews;
            } elseif (empty($specificReviews)) {
                echo "<p>You have no reviews.</p>";
            }
            ?>
            <br><br>

            <?php if ($_SESSION["clientData"]["clientLevel"] > 1) {
                echo "<h2>Inventory Management</h2>
                <p>Use the links below to manage the inventory</p>
                <a href='/phpmotors/vehicles/'>Vehicle Management</a><br><br>
                <a href='/phpmotors/uploads/'>Image Management</a>";
            }
            ?><br><br>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
<?php unset($_SESSION["message"]); ?>