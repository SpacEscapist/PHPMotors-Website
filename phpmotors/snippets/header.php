<div class="header-top">
    <img src="/phpmotors/images/site/logo.png" alt="phpmotors.com logo">
    <?php
    if (isset($_SESSION["loggedin"])) {
        echo "<span class='account-login'><a href='/phpmotors/accounts/'>" . $_SESSION["clientData"]["clientFirstname"] . "</a>" . " | " . "<a href='/phpmotors/accounts?action=Logout'>Logout</a></span>";
    } else if (!isset($_SESSION["loggedin"])) {
        echo "<span class='account-login'><a href='/phpmotors/accounts?action=login'>My Account</a></span>";
    }
    ?>
</div>