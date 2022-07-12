<?php
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
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
    <title>Image Management | PHP Motors</title>

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
            <h1>Image Management</h1>
            <p>Welcome to the Image Management page<br>Please choose one of the options below:</p><br>

            <h2>Add New Vehicle Image</h2>
            <?php
            if (isset($message)) {
                echo $message;
            } ?>

            <form class="form" action="/phpmotors/uploads/" method="POST" enctype="multipart/form-data">
                <label for="invItem"><strong>Vehicle</strong></label><br>
                <?php echo $prodSelect; ?>
                <br><br><br>

                <label><strong>Main image for vehicle?</strong></label><br>
                <label for="priYes" class="pImage">Yes</label>
                <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                <label for="priNo" class="pImage">No</label>
                <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0"><br><br><br>

                <label><strong>Upload Image:</strong></label>
                <input type="file" name="file1"><br><br>
                <input type="submit" class="formSubmit" id="regbtn" value="Upload">
                <input type="hidden" name="action" value="upload">
            </form>

            <hr>

            <h2>Existing Images</h2>
            <p class="notice">If deleteing an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
                echo $imageDisplay;
            } ?>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>

</html>
<?php unset($_SESSION["message"]); ?>