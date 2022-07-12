<?php
/*
* Custom functions library
*/

// Validates email address
function checkEmail($clientEmail)
{
    $validEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $validEmail;
}


// Validates password
// Check the password for a minimum of 8 characters,
// at least 1 capital letter
// at least 1 number
// at least 1 special character
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}


// Receive the carclassifications array as a parameter and build the navigation bar
function buildNav($classifications)
{
    $navList = "<ul>";
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= "</ul>";
    return $navList;
    // echo $navList;
    // exit;
}


// Build the classifications select list
function buildClassificationList($classifications)
{
    $classificationList = "<select name='classificationId' id='classificationList'>";
    $classificationList .= '<option disabled selected value="">Choose a Classification</option>';
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= "</select>";
    return $classificationList;
}


// Build a display of vehicles winith an unordered list
// dv - stands for Display Vehicles
function buildVehiclesDisplay($vehicles)
{
    $dv = "<ul id='inv-display'>";
    foreach ($vehicles as $vehicle) {
        $price = number_format($vehicle["invPrice"]);
        $dv .= "<li>";

        $dv .= "<a href='/phpmotors/vehicles/?action=getVehicle&vehicleId=$vehicle[invId]'><img src='$vehicle[imgPath]' alt='$vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
        $dv .= "<a href='/phpmotors/vehicles/?action=getVehicle&vehicleId=$vehicle[invId]'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
        $dv .= "<span>$$price</span>";

        $dv .= "</li>";
    }
    $dv .= "</ul>";
    return $dv;
}


// Build a detailed display for a specific vehicle
// dv - stands for Display Vehicle
function buildDetailedVehicleDisplay($vehicle)
{
    $price = number_format($vehicle["invPrice"]);

    $dv = "<div id='vehicle-image'>";
    $dv .= "<img src='$vehicle[imgPath]' alt='$vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= "</div>";

    $dv .= "<div id='vehicle-details'>";
    $dv .= "<p><strong>$vehicle[invMake] $vehicle[invModel] Details</strong></p>";
    $dv .= "<p>Price: $$price</p>";
    $dv .= "<p>$vehicle[invDescription]</p>";
    $dv .= "<p>Color: $vehicle[invColor]</p>";
    $dv .= "<p># in Stock: $vehicle[invStock]</p>";
    $dv .= "</div>";

    return $dv;
}


/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image)
{
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}


// Build thumbnail display for vehicle-detail view
function buildThumbnailDisplay($imgThumbnail)
{
    $tn = '<h2 id="thumbnail-header">Vehicle Thumbnails</h2>';
    $tn .= '<ul id="thumbnail-display">';
    foreach ($imgThumbnail as $thumbnail) {
        $tn .= '<li>';
        $tn .= "<img src='$thumbnail[imgPath]' alt='Thumbnail of $thumbnail[invMake] $thumbnail[invModel] on PHP Motors.com'>";
        $tn .= '</li>';
    }
    $tn .= '</ul>';
    return $tn;
}


// Build images display for image management view
function buildImageDisplay($imageArray)
{
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
        $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}


// Build the vehicles select list
function buildVehiclesSelect($vehicles)
{
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
        $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}


// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name)
{
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]["name"];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}


// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename)
{
    // Set up the variables
    $dir = $dir . '/';

    // Set up the image path
    $image_path = $dir . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}


// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height)
{

    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    } // ends the swith

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
} // ends resizeImage function


// Build a Review Form under the vehicle-detail view
function buildReviewForm($vehicle)
{
    if (isset($_SESSION["loggedin"])) {
        $userFirst = ucfirst($_SESSION["clientData"]["clientFirstname"]);
        $userLast = ucfirst($_SESSION["clientData"]["clientLastname"]);

        // Combine first initial with last name
        $username = substr($userFirst, 0, 1) . $userLast;

        $vehicleId = $vehicle["invId"];

        if (isset($_SESSION['clientData']['clientId'])) {
            $userId = $_SESSION['clientData']['clientId'];
        } elseif (isset($clientId)) {
            $userId = $clientId;
        }

        $rf = "<h3>Review the $vehicle[invMake] $vehicle[invModel]</h3>";
        $rf .= "<div id='review-form'>";
        $rf .= "<form class='review-form' action='/phpmotors/reviews/index.php' method='POST'>";
        $rf .= "<label for='screenName'>Screen Name:</label><br>";
        $rf .= "<input type='text' id='screenName' name='screenName' value='$username' readonly><br><br>";
        $rf .= "<label for='reviewText'>Review:</label><br>";
        $rf .= "<input type='textarea' id='reviewText' name='reviewText' required><br><br>";
        $rf .= "<input type='hidden' id='invId' name='invId' value='$vehicleId'>";
        $rf .= "<input type='hidden' id='clientId' name='clientId' value='$userId'>";
        $rf .= "<input type='submit' class='formSubmit' value='Submit Review'>";
        $rf .= "<input type='hidden' name='action' value='addReview'>";
        $rf .= "</form>";
        $rf .= "</div>";

        return $rf;
    }
}


// Build Reviews Display in the vehicle-detail view
function buildReviewsDisplay($getUserReviews)
{
    if (!empty($getUserReviews)) {
        $rd = "<ul>";
        foreach ($getUserReviews as $review) {
            $dateFormat = date("j F, Y", strtotime($review["reviewDate"]));
            $userFirst = ucfirst($review["clientFirstname"]);
            $userLast = ucfirst($review["clientLastname"]);
            // Combine first initial with last name
            $username = substr($userFirst, 0, 1) . $userLast;

            $rd .= "<li>";
            $rd .= "<p>$username wrote on $dateFormat:</p>";
            $rd .= "<p>$review[reviewText]</p>";
            $rd .= "</li>";
        }
        $rd .= "</ul>";
        return $rd;
    } elseif (empty($getUserReviews)) {
        $rd = "<p><em>Be the first to write a review!</em></p>";
        return $rd;
    }
}


// Build specific reviews display for a logged in user in admin view
function buildSpecificClientReviews($getReviews)
{
    $cr = "<ul>";
    foreach ($getReviews as $reviews) {
        $cr .= '<li>';
        $cr .= "<p>$reviews[invMake] $reviews[invModel] (Reviewed on " . date("j F, Y", strtotime($reviews["reviewDate"])) . "): ";
        $cr .= "<a href='/phpmotors/reviews?action=revEdit&reviewId=$reviews[reviewId]'>Edit</a> | <a href='/phpmotors/reviews?action=revDelete&reviewId=$reviews[reviewId]'>Delete</a></p>";
        $cr .= '</li>';
    }
    $cr .= "</ul>";

    return $cr;
}


// Build an Edit Review display under the review-update view.
function buildReviewUpdate($reviewInfo)
{
    $ru = "<h1>Update $reviewInfo[invMake] $reviewInfo[invModel] Review</h1>";
    $ru .= "<p>Reviewed on " . date('j F, Y', strtotime($reviewInfo["reviewDate"])) . "</p>";
    $ru .= "<form class='form' action='/phpmotors/reviews/index.php' method='POST'>";
    $ru .= "<label for='reviewText'><strong>Review Text</strong></label><br>";
    $ru .= "<textarea rows='3' cols='25' id='reviewText' name='reviewText' required>$reviewInfo[reviewText]</textarea><br>";
    $ru .= "<input type='submit' class='formSubmit' name='submit' value='Update Vehicle'>";
    $ru .= "<input type='hidden' name='action' value='updateReview'>";
    $ru .= "<input type='hidden' name='reviewId' value=$reviewInfo[reviewId]";
    $ru .= "</form>";

    return $ru;
}


// Build an Delete Review display under the review-delete view.
function buildReviewDelete($reviewInfo)
{
    $rd = "<h1>Delete $reviewInfo[invMake] $reviewInfo[invModel] Review</h1>";
    $rd .= "<p>Reviewed on " . date('j F, Y', strtotime($reviewInfo["reviewDate"])) . "</p>";
    $rd .= "<p class='notice'>Deletes cannot be undone. Are you sure you want to delete this review?";
    $rd .= "<form class='form' action='/phpmotors/reviews/index.php' method='POST'>";
    $rd .= "<p><strong>Review Text</strong></p>";
    $rd .= "<p id='delete-notice'>$reviewInfo[reviewText]</p><br>";
    $rd .= "<input type='submit' class='formSubmit' name='submit' value='Delete Vehicle'>";
    $rd .= "<input type='hidden' name='action' value='deleteReview'>";
    $rd .= "<input type='hidden' name='reviewId' value=$reviewInfo[reviewId]";
    $rd .= "</form>";

    return $rd;
}
