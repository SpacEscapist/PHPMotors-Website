<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Template for PHP Motors Website">
    <meta name="author" content="Branden Torrance">
    <title>Registration | PHP Motors</title>

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
            <h1>Register</h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form class="form" action="/phpmotors/accounts/index.php" method="POST">
                <p><strong>Note: All fields are required</strong></p>
                <label for="clientFirstname">First Name:</label><br>
                <input type="text" id="clientFirstname" name="clientFirstname" <?php if (isset($clientFirstname)) {
                                                                                    echo "value='$clientFirstname'";
                                                                                } ?> required><br>
                <label for="clientLastname">Last Name:</label><br>
                <input type="text" id="clientLastname" name="clientLastname" <?php if (isset($clientLastname)) {
                                                                                    echo "value='$clientLastname'";
                                                                                } ?> required><br>
                <label for="clientEmail">Email:</label><br>
                <input type="email" id="clientEmail" name="clientEmail" <?php if (isset($clientEmail)) {
                                                                            echo "value='$clientEmail'";
                                                                        } ?> required><br><br>
                <label for="clientPassword">Password:</label><br>
                <span>Password must be at least 8 characters long, and have at least 1 capital letter, 1 number, and 1 special character</span><br>
                <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
                <input type="submit" class="formSubmit" id="regbtn" name="submit" value="Register">
                <input type="hidden" name="action" value="register">
            </form>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>
</body>

</html>