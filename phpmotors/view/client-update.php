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
    <title>Content Title | PHP Motors</title>

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
            <h1>Manage Account</h1><br>

            <?php
            if (isset($messageAccount)) {
                echo $messageAccount;
            }
            ?>
            <h2>Update Account</h2>
            <form class="form" action="/phpmotors/accounts/index.php" method="POST">
                <label for="clientFirstname">First Name:</label><br>
                <input type="text" id="clientFirstname" name="clientFirstname" required <?php if (isset($clientFirstname)) {
                                                                                            echo "value='$clientFirstname'";
                                                                                        } elseif (isset($_SESSION['clientData']['clientFirstname'])) {
                                                                                            echo "value=" . $_SESSION['clientData']['clientFirstname'];
                                                                                        } ?>><br><br>
                <label for="clientLastname">Last Name:</label><br>
                <input type="text" id="clientLastname" name="clientLastname" required <?php if (isset($clientLastname)) {
                                                                                            echo "value='$clientLastname'";
                                                                                        } elseif (isset($_SESSION['clientData']['clientLastname'])) {
                                                                                            echo "value=" . $_SESSION['clientData']['clientLastname'];
                                                                                        } ?>><br><br>
                <label for="clientEmail">Email:</label><br>
                <input type="email" id="clientEmail" name="clientEmail" required <?php if (isset($clientEmail)) {
                                                                                        echo "value='$clientEmail'";
                                                                                    } elseif (isset($_SESSION['clientData']['clientEmail'])) {
                                                                                        echo "value=" . $_SESSION['clientData']['clientEmail'];
                                                                                    } ?>><br><br>
                <input type="submit" class="formSubmit" value="Update Info"><br>
                <input type="hidden" name="action" value="updateAccount">
                <input type="hidden" name="clientId" value="
                <?php if (isset($_SESSION['clientData']['clientId'])) {
                    echo $_SESSION['clientData']['clientId'];
                } elseif (isset($clientId)) {
                    echo $clientId;
                } ?>
                ">
            </form>
            <br>

            <?php
            if (isset($messagePassword)) {
                echo $messagePassword;
            }
            ?>

            <h2>Update Password</h2>
            <form class="form" action="/phpmotors/accounts/index.php" method="POST">
                <span>*Password must be at least 8 characters long, and have at least 1 capital letter, 1 number, and 1 special character</span><br><br>
                <span>*Note: Your original password will be changed</span><br><br>
                <label for="clientPassword">Password:</label><br>
                <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
                <input type="submit" class="formSubmit" value="Update Password"><br>
                <input type="hidden" name="action" value="updatePassword">
                <input type="hidden" name="clientId" value="
                <?php if (isset($_SESSION['clientData']['clientId'])) {
                    echo $_SESSION['clientData']['clientId'];
                } elseif (isset($clientId)) {
                    echo $clientId;
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