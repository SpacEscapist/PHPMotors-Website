<?php
// Check if user is NOT logged in or if user DOES NOT have level access
if ((!$_SESSION["loggedin"]) || !($_SESSION["clientData"]["clientLevel"] > 1)) {
    header("Location: /phpmotors/");
    exit;
}
// Build the dropdown menu from the Car Classifications table
$classificationList = "<select id='classificationId' name='classificationId' required>";
$classificationList .= '<option disabled selected value="">Select Classification</option>';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification["classificationId"] == $classificationId) {
            $classificationList .= " selected ";
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= "</select>";
// echo $classificationList;
// exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Template for PHP Motors Website">
    <meta name="author" content="Branden Torrance">
    <title>Add Vehicle | PHP Motors</title>

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
            <h1>Add Vehicle</h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form class="form" action="/phpmotors/vehicles/index.php" method="POST">
                <p><strong>Note: All fields are required</strong></p>
                <label for='classificationId'>Classification</label><br>
                <?php echo $classificationList; ?><br><br>

                <label for="invMake">Make</label><br>
                <input type="text" id="invMake" name="invMake" <?php if (isset($invMake)) {
                                                                    echo "value='$invMake'";
                                                                } ?> required><br>
                <label for="invModel">Model</label><br>
                <input type="text" id="invModel" name="invModel" <?php if (isset($invModel)) {
                                                                        echo "value='$invModel'";
                                                                    } ?> required><br>
                <label for="invDescription">Description</label><br>
                <textarea rows="3" cols="25" id="invDescription" name="invDescription" required><?php if (isset($invDescription)) {
                                                                                                    echo "$invDescription";
                                                                                                } ?></textarea><br><br>
                <label for="invImage">Image Path</label><br>
                <input type="text" id="invImage" name="invImage" value="/phpmotors/images/vehicles/no-image.png" <?php if (isset($invImage)) {
                                                                                                                        echo "value='$invImage'";
                                                                                                                    } ?> required><br>
                <label for="invThumbnail">Thumbnail Path</label><br>
                <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/vehicles/no-image-tn.png" <?php if (isset($invThumbnail)) {
                                                                                                                                echo "value='$invThumbnail'";
                                                                                                                            } ?> required><br>
                <label for="invPrice">Price</label><br>
                <input type="number" step="0.01" id="invPrice" name="invPrice" <?php if (isset($invPrice)) {
                                                                                    echo "value='$invPrice'";
                                                                                } ?> required><br><br>
                <label for="invStock"># In Stock</label><br>
                <input type="number" id="invStock" name="invStock" <?php if (isset($invStock)) {
                                                                        echo "value='$invStock'";
                                                                    } ?> required><br><br>
                <label for="invColor">Color</label><br>
                <input type="text" id="invColor" name="invColor" <?php if (isset($invColor)) {
                                                                        echo "value='$invColor'";
                                                                    } ?> required><br><br>
                <input type="submit" class="formSubmit" name="submit" value="Add Vehicle">
                <input type="hidden" name="action" value="addVehicle">
            </form>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>

</html>