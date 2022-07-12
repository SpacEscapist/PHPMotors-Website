<?php
// Check if user is NOT logged in or if user DOES NOT have level access
if ((!$_SESSION["loggedin"]) || !($_SESSION["clientData"]["clientLevel"] > 1)) {
    header("Location: /phpmotors/");
    exit;
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
    <title>Add Car Classification | PHP Motors</title>

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
            <h1>Add Car Classification</h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form class="form" action="/phpmotors/vehicles/index.php" method="POST">
                <label for="classificationName">Classification Name</label><br>
                <span>*Classification name field is limited to 30 characters</span><br>
                <input type="text" id="classificationName" name="classificationName" maxlength="30" required><br><br>
                <input type="submit" class="formSubmit" name="submit" value="Add Classification">
                <input type="hidden" name="action" value="addClass">
            </form>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>

</html>