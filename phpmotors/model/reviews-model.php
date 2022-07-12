<?php
// Reviews Model for PHP Motors


// This function will handle adding new reviews
function addReview($reviewText, $reviewDate, $invId, $clientId)
{
    // Create a connnection object using the phpmotors connection function
    $db = phpmotorsConnect();

    //The SQL statement
    $sql = "INSERT INTO reviews (reviewText, reviewDate, invId, clientId)
        VALUES (:reviewText, :reviewDate, :invId, :clientId)";

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next 4 lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(":reviewText", $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(":reviewDate", $reviewDate, PDO::PARAM_STR);
    $stmt->bindValue(":invId", $invId, PDO::PARAM_INT);
    $stmt->bindValue(":clientId", $clientId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}


// Get review information by clientId
function getUserReviews($clientId)
{
    $db = phpmotorsConnect();
    $sql = "SELECT * FROM reviews INNER JOIN inventory ON reviews.invId = inventory.invId WHERE clientId = :clientId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":clientId", $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewInfo;
}


// Get review information by reviewId
function getReviewTextInfo($reviewId)
{
    $db = phpmotorsConnect();
    $sql = "SELECT * FROM reviews INNER JOIN inventory ON reviews.invId = inventory.invId WHERE reviewId = :reviewId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":reviewId", $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewText = $stmt->fetch();
    $stmt->closeCursor();
    return $reviewText;
}


// This function will handle updating reviews
function updateReview($reviewText, $reviewId)
{
    // Create a connnection object using the phpmotors connection function
    $db = phpmotorsConnect();

    //The SQL statement
    $sql = "UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId";

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next line replaces the placeholder in the SQL
    // statement with the actual value in the variable
    // and tells the database the type of data it is
    $stmt->bindValue(":reviewText", $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(":reviewId", $reviewId, PDO::PARAM_INT);

    // Execute the SQL statement
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}


// This function will handle deleting reviews
function deleteReview($reviewId)
{
    // Create a connnection object using the phpmotors connection function
    $db = phpmotorsConnect();

    //The SQL statement
    $sql = "DELETE FROM reviews WHERE reviewId = :reviewId";

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next line replaces the placeholder in the SQL
    // statement with the actual value in the variable
    // and tells the database the type of data it is
    $stmt->bindValue(":reviewId", $reviewId, PDO::PARAM_INT);

    // Execute the SQL statement
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}


// Get reviews for a specific inventory item
function getReviewTextForDisplay($invId)
{
    $db = phpmotorsConnect();
    $sql = "SELECT * FROM reviews INNER JOIN clients ON reviews.clientId = clients.clientId WHERE invId = :invId ORDER BY reviewId DESC";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":invId", $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewTextDisplay = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewTextDisplay;
}
