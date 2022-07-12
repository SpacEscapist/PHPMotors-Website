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
    <title><?php if (isset($invInfo['invMake'])) {
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
            } ?> | PHP Motors</title>

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
            <h1>
                <?php if (isset($invInfo['invMake'])) {
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";
                } ?>
            </h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form class="form" action="/phpmotors/vehicles/index.php" method="POST">
                <p><strong>Confirm Vehicle Deletion.<br>Note: This deletion is permanent</strong></p>
                <label for="invMake">Make</label><br>
                <input type="text" id="invMake" name="invMake" readonly <?php if (isset($invInfo['invMake'])) {
                                                                            echo "value='$invInfo[invMake]'";
                                                                        } ?>><br>
                <label for="invModel">Model</label><br>
                <input type="text" id="invModel" name="invModel" readonly <?php if (isset($invInfo['invModel'])) {
                                                                                echo "value='$invInfo[invModel]'";
                                                                            } ?>><br>
                <label for="invDescription">Description</label><br>
                <textarea rows="3" cols="25" id="invDescription" name="invDescription" readonly><?php if (isset($invInfo['invDescription'])) {
                                                                                                    echo $invInfo["invDescription"];
                                                                                                } ?></textarea><br><br>
                <input type="submit" class="formSubmit" name="submit" value="Delete Vehicle">
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="
                <?php if (isset($invInfo['invId'])) {
                    echo $invInfo['invId'];
                } ?>
                ">
            </form>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>

</html>