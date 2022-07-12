<?php
// Accounts Controller


// Create or access a Session
session_start();


// Get the database connection file
require_once "../library/connections.php";
// Get the custom functions library
require_once "../library/functions.php";
// Get the PHP Motors model for use as needed
require_once "../model/main-model.php";
// Get the accounts model
require_once "../model/accounts-model.php";
// Get the reviews model
require_once "../model/reviews-model.php";

// Get carclassifications array and pass into buildNav function as a parameter
$classifications = getClassifications();
$navList = buildNav($classifications);

// $action variable is equal to whatever is in the POST method, if the POST is empty, $action variable is equal to the GET method. 
// it looks for "?action=" at the end of the URL
$action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

// Control structure to determine which view to show, depending on the URL parameters passed through the GET method
switch ($action) {
    case "login":
        // Show the Login view
        include "../view/login.php";
        break;
    case "registration":
        // Show the Registration view
        include "../view/registration.php";
        break;
    case "register":
        // Trim, filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, "clientFirstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, "clientLastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, "clientEmail", FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, "clientPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for existing email
        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the database table
        if ($existingEmail) {
            $message = '<p class="messageFail">That email address already exists. Please try logging in.</p>';
            include '../view/login.php';
            exit;
        }


        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = "<p class='messageFail'>Please provide information for ALL empty form fields.</p>";
            include "../view/registration.php";
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if ($regOutcome === 1) {
            // Set Cookie for new-registering user
            setcookie("firstname", $clientFirstname, strtotime("+1 year"), "/");
            // Display success message for new-registering user
            $_SESSION["message"] = "<p class='messagePass'>Success! Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header("Location: /phpmotors/accounts/?action=login");
            exit;
        } else {
            $message = "<p class='messageFail'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include "../view/registration.php";
            exit;
        }
        break;
    case "Login":
        // Trim, filter and store the data
        $clientEmail = trim(filter_input(INPUT_POST, "clientEmail", FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, "clientPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // Check that email validates requirements in a proper email format
        $clientEmail = checkEmail($clientEmail);
        // Check that password matches the password requirements
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientEmail) || empty($checkPassword)) {
            $message = "<p class='messageFail'>Please provide information for ALL empty form fields.</p>";
            include "../view/login.php";
            exit;
        }

        // If a valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Check if clientData array is empty (in case User Email does not exist in database)
        if (!$clientData) {
            $message = "<p class='messageFail'>Email/Password do not match. Please enter a valid Email or Password.</p>";
            include "../view/login.php";
            exit;
        }
        // Compare the password that was just submitted against the
        // hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match, create an error and
        // return to the login view
        if (!$hashCheck) {
            $message = "<p class='messageFail'>Email/Password do not match. Please enter a valid Email or Password.</p>";
            include "../view/login.php";
            exit;
        }

        // If a valid user exists, create a "flag" in the session named "loggedin"
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array -
        // - the array_pop function removes the last element
        // from an array
        array_pop($clientData);
        // Store the array into the session named "clientData"
        $_SESSION['clientData'] = $clientData;

        // load user reviews, if any
        $userId = $_SESSION['clientData']['clientId'];
        $getReviews = getUserReviews($userId);
        if (!empty($getReviews)) {
            $specificReviews = buildSpecificClientReviews($getReviews);
        }

        // Send the user to the admin view
        include "../view/admin.php";
        exit;
    case "Logout":
        // Clear all stored variables
        $_SESSION = array();
        // Destroy Session
        session_destroy();
        // Send the user to the phpmotors home view
        header("Location: /phpmotors/");
        exit;
    case "modify":
        // Show the client-update view
        include "../view/client-update.php";
        break;
    case "updateAccount":
        $clientFirstname = trim(filter_input(INPUT_POST, "clientFirstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, "clientLastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, "clientEmail", FILTER_SANITIZE_EMAIL));
        $clientId = trim(filter_input(INPUT_POST, "clientId", FILTER_SANITIZE_NUMBER_INT));

        // Check if email address is different than email address in current SESSION
        if ($clientEmail !== $_SESSION["clientData"]["clientEmail"]) {
            // Validate Email
            $clientEmail = checkEmail($clientEmail);
            // Check for existing email
            $existingEmail = checkExistingEmail($clientEmail);
            // Check for existing email address in the database table
            if ($existingEmail) {
                $messageAccount = '<p class="messageFail">That email address already exists.</p>';
                include '../view/client-update.php';
                exit;
            }
        }

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $messageAccount = "<p class='messageFail'>Please provide information for ALL empty form fields.</p>";
            include "../view/client-update.php";
            exit;
        }

        // Send data to the model
        $updateAccount = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // Check and report the result
        if ($updateAccount) {
            $message = "<p class='messagePass'>$clientFirstname, your information has been updated</p>";
            $_SESSION['message'] = $message;
        } else {
            $message = "<p class='messageFail'>$clientFirstname, your information failed to update. Please try again.</p>";
            $_SESSION['message'] = $message;
        }

        // Query client data from the database
        $clientData = getClientInfo($clientId);

        // Store the $clientData array into the session named "clientData"
        $_SESSION['clientData'] = $clientData;

        // Send the user to the admin view
        include "../view/admin.php";
        exit;
        break;
    case "updatePassword":
        $clientPassword = trim(filter_input(INPUT_POST, "clientPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = trim(filter_input(INPUT_POST, "clientId", FILTER_SANITIZE_NUMBER_INT));

        // Check that password meets requirements
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($checkPassword)) {
            $messagePassword = "<p class='messageFail'>Please provide information for ALL empty form fields.</p>";
            include "../view/client-update.php";
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send data to the model
        $updatePassword = updatePassword($hashedPassword, $clientId);

        // Check and report the result
        if ($updatePassword) {
            // Display success message for new-registering user
            $message = "<p class='messagePass'>" . $_SESSION['clientData']['clientFirstname'] . ", your password has been updated successfully</p>";
            $_SESSION["message"] = $message;
        } else {
            $message = "<p class='messageFail'>" . $_SESSION['clientData']['clientFirstname'] . ", your password failed to update. Please try again.</p>";
            $_SESSION["message"] = $message;
        }

        // Send the user to the admin view
        include "../view/admin.php";
        exit;
        break;

    default:
        $userId = $_SESSION['clientData']['clientId'];
        $getReviews = getUserReviews($userId);
        if (!empty($getReviews)) {
            $specificReviews = buildSpecificClientReviews($getReviews);
        }
        include "../view/admin.php";
}
