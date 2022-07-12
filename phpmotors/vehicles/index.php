<?php
// Vehicles Controller


// Create or access a Session
session_start();


// Get the database connection file
require_once "../library/connections.php";
// Get the custom functions library
require_once "../library/functions.php";
// Get the PHP Motors model for use as needed
require_once "../model/main-model.php";
// Get the vehicles model
require_once "../model/vehicles-model.php";
// Get the uploads model
require_once "../model/uploads-model.php";
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
    case "add-classification":
        // Show the Add Classification view
        include "../view/add-classification.php";
        break;
    case "add-vehicle":
        // Show the Add Vehicle view
        include "../view/add-vehicle.php";
        break;
    case "addClass":
        $classificationName = trim(filter_input(INPUT_POST, "classificationName", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        // Check for missing data
        if (empty($classificationName)) {
            $message = "<p class='messageFail'>Please provide information for ALL empty form fields.</p>";
            include "../view/add-classification.php";
            exit;
        }

        // Send data to the model
        $classOutcome = addClass($classificationName);

        // Check and report the result
        if ($classOutcome === 1) {
            header("Location: /phpmotors/vehicles/");
            exit;
        } else {
            $message = "<p class='messageFail'>The $classificationName failed to be added. Please try again.</p>";
            include "../view/add-classification.php";
            exit;
        }
        break;
    case "addVehicle":
        $invMake = trim(filter_input(INPUT_POST, "invMake", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, "invModel", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, "invDescription", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, "invImage", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, "invThumbnail", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, "invPrice", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, "invStock", FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, "invColor", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, "classificationId", FILTER_SANITIZE_NUMBER_INT));

        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = "<p class='messageFail'>Please provide information for ALL empty form fields.</p>";
            include "../view/add-vehicle.php";
            exit;
        }

        // Send data to the model
        $addOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        // Check and report the result
        if ($addOutcome === 1) {
            $message = "<p class='messagePass'>The $invMake $invModel was added successfully!</p>";
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/vehicles/");
            exit;
        } else {
            $message = "<p class='messageFail'>The $invMake $invModel failed to be added. Please try again.</p>";
            include "../view/add-vehicle.php";
            exit;
        }
        break;

        /* ********************************************
    * Get vehicles by classificationId
    * Used for starting Update & Delete process
    * *********************************************/
    case "getInventoryItems":
        // Get the classificationId
        $classificationId = filter_input(INPUT_GET, "classificationId", FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the database
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back
        echo json_encode($inventoryArray);
        break;
    case "mod":
        $invId = filter_input(INPUT_GET, "invId", FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = "Sorry, no vehicle information could be found.";
        }
        include "../view/vehicle-update.php";
        exit;
        break;
    case "updateVehicle":
        $invMake = trim(filter_input(INPUT_POST, "invMake", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, "invModel", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, "invDescription", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, "invImage", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, "invThumbnail", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, "invPrice", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, "invStock", FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, "invColor", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, "classificationId", FILTER_SANITIZE_NUMBER_INT));
        $invId = trim(filter_input(INPUT_POST, "invId", FILTER_SANITIZE_NUMBER_INT));

        // Check for missing data
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = "<p class='messageFail'>Please provide information for ALL empty form fields.</p>";
            include "../view/vehicle-update.php";
            exit;
        }

        // Send data to the model
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

        // Check and report the result
        if ($updateResult) {
            $message = "<p class='messagePass'>The $invMake $invModel was updated successfully!</p>";
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/vehicles/");
            exit;
        } else {
            $message = "<p class='messageFail'>The $invMake $invModel failed to update. Please try again.</p>";
            include "../view/vehicle-update.php";
            exit;
        }
        break;
    case "del":
        $invId = filter_input(INPUT_GET, "invId", FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = "Sorry, no vehicle information could be found.";
        }
        include "../view/vehicle-delete.php";
        exit;
        break;
    case "deleteVehicle":
        $invMake = trim(filter_input(INPUT_POST, "invMake", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, "invModel", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = trim(filter_input(INPUT_POST, "invId", FILTER_SANITIZE_NUMBER_INT));

        // Send data to the model
        $deleteResult = deleteVehicle($invId);

        // Check and report the result
        if ($deleteResult) {
            $message = "<p class='messagePass'>The $invMake $invModel was deleted successfully!</p>";
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/vehicles/");
            exit;
        } else {
            $message = "<p class='messageFail'>The $invMake $invModel failed to delete. Please try again.</p>";
            $_SESSION['message'] = $message;
            header("Location: /phpmotors/vehicles/");
            exit;
        }
        break;
    case "classification":
        $classificationName = filter_input(INPUT_GET, "classificationName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);

        if (!count($vehicles)) {
            $message = "<p class='messageFail'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }

        // echo $vehicleDisplay;
        // exit;

        include "../view/classification.php";
        break;
    case "getVehicle":
        $vehicleId = filter_input(INPUT_GET, "vehicleId", FILTER_SANITIZE_NUMBER_INT);
        $vehicle = getInvItemInfo($vehicleId);
        $reviewForm = buildReviewForm($vehicle);
        $imgThumbnail = getThumbnailImageInfo($vehicleId);
        $getUserReviews = getReviewTextForDisplay($vehicleId);
        $buildReviewsDisplay = buildReviewsDisplay($getUserReviews);
        if (!$vehicle) {
            $message = "<p class='messageFail'>Sorry, the $vehicle[invMake] $vehicle[invModel] could not be found.</p>";
        } else {
            $detailedVehicle = buildDetailedVehicleDisplay($vehicle);
            $buildThumbnails = buildThumbnailDisplay($imgThumbnail);
        }

        include "../view/vehicle-detail.php";
        break;

    default:
        $classificationList = buildClassificationList($classifications);

        // Show the Vehicle Management view by default
        include "../view/vehicle-manage.php";
}
