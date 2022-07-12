<?php
// Reviews Controller

// Create or access a Session
session_start();

// Get the database connection file
require_once "../library/connections.php";
// Get the custom functions library
require_once "../library/functions.php";
// Get the PHP Motors model for use as needed
require_once "../model/main-model.php";
// Get the reviews model
require_once "../model/reviews-model.php";
// Get the vehicles model
require_once "../model/vehicles-model.php";


// Get carclassifications array and pass into buildNav function as a parameter
$classifications = getClassifications();
$navList = buildNav($classifications);

// Set time zone to Mountain Time
date_default_timezone_set("America/Denver");

// $action variable is equal to whatever is in the POST method, if the POST is empty, $action variable is equal to the GET method. 
// it looks for "?action=" at the end of the URL
$action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

// Control structure to determine which view to show, depending on the URL parameters passed through the GET method
switch ($action) {
    case "addReview":
        $reviewText = trim(filter_input(INPUT_POST, "reviewText", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, "invId", FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, "clientId", FILTER_SANITIZE_NUMBER_INT));
        $reviewDate = date("Y-m-d H:i:s");

        // Check for missing data
        if (empty($reviewText)) {
            $reviewMessage = "<p class='messageFail'>Please fill in all empty fields before submitting.</p>";
            $_SESSION['reviewMessage'] = $reviewMessage;
            header("Location: /phpmotors/vehicles/?action=getVehicle&vehicleId=" . $invId);
            exit;
        }

        // Send data to the model
        $reviewOutcome = addReview($reviewText, $reviewDate, $invId, $clientId);

        // Check and report the result
        if ($reviewOutcome === 1) {
            $reviewMessage = "<p class='messagePass'>Thank you for the review, it is displayed below.</p>";
            $_SESSION['reviewMessage'] = $reviewMessage;
            header("Location: /phpmotors/vehicles/?action=getVehicle&vehicleId=" . $invId);
            exit;
        } else {
            $reviewMessage = "<p class='messageFail'>Your review submission was unsuccessful.</p>";
            $_SESSION['reviewMessage'] = $reviewMessage;
            header("Location: /phpmotors/vehicles/?action=getVehicle&vehicleId=" . $invId);
            exit;
        }
        break;

    case "revEdit":
        // Show the Add Review view
        $reviewId = filter_input(INPUT_GET, "reviewId", FILTER_VALIDATE_INT);
        $reviewInfo = getReviewTextInfo($reviewId);
        $buildRevEdit = buildReviewUpdate($reviewInfo);
        include "../view/review-update.php";
        exit;
        break;

    case "updateReview":
        $reviewText = trim(filter_input(INPUT_POST, "reviewText", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $reviewId = filter_input(INPUT_POST, "reviewId", FILTER_SANITIZE_NUMBER_INT);

        // Check for missing data
        if (empty($reviewText)) {
            $message = "<p class='messageFail'>Please provide information for ALL empty form fields.</p>";
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/accounts/");
            exit;
        }

        // Send data to the model
        $updateResult = updateReview($reviewText, $reviewId);

        // Check and report the result
        if ($updateResult) {
            $message = "<p class='messagePass'>Your review was updated successfully!</p>";
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/accounts/");
            exit;
        } else {
            $message = "<p class='messageFail'>Your review failed to update. Please try again.</p>";
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/accounts/");
            exit;
        }
        break;

    case "revDelete":
        // Show the Delete Review view
        $reviewId = filter_input(INPUT_GET, "reviewId", FILTER_VALIDATE_INT);
        $reviewInfo = getReviewTextInfo($reviewId);
        $buildRevDelete = buildReviewDelete($reviewInfo);
        include "../view/review-delete.php";
        exit;
        break;

    case "deleteReview":
        $reviewId = trim(filter_input(INPUT_POST, "reviewId", FILTER_SANITIZE_NUMBER_INT));

        // Send data to the model
        $deleteResult = deleteReview($reviewId);

        // Check and report the result
        if ($deleteResult) {
            $message = "<p class='messagePass'>Your review was deleted successfully!</p>";
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/accounts/");
            exit;
        } else {
            $message = "<p class='messageFail'>Your review failed to delete. Please try again.</p>";
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/accounts/");
            exit;
        }
        break;

    default:
        if (isset($_SESSION["loggedin"])) {
            include "../view/admin.php";
        } elseif (!isset($_SESSION["loggedin"])) {
            include "../view/home.php";
        }
}
