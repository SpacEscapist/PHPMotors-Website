<?php
// Vehicles Model for PHP Motors

// This function will handle adding new classifications
function addClass($classificationName)
{
    // Create a connnection object using the phpmotors connection function
    $db = phpmotorsConnect();

    //The SQL statement
    $sql = "INSERT INTO carclassification (classificationName)
        VALUES (:classificationName)";

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next line replaces the placeholder in the SQL
    // statement with the actual value in the variable
    // and tells the database the type of data it is
    $stmt->bindValue(":classificationName", $classificationName, PDO::PARAM_STR);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
};


// This function will handle adding new vehicles
function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId)
{
    // Create a connnection object using the phpmotors connection function
    $db = phpmotorsConnect();

    //The SQL statement
    $sql = "INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
        VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)";

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next 9 lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(":invMake", $invMake, PDO::PARAM_STR);
    $stmt->bindValue(":invModel", $invModel, PDO::PARAM_STR);
    $stmt->bindValue(":invDescription", $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(":invImage", $invImage, PDO::PARAM_STR);
    $stmt->bindValue(":invThumbnail", $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(":invPrice", $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(":invStock", $invStock, PDO::PARAM_INT);
    $stmt->bindValue(":invColor", $invColor, PDO::PARAM_STR);
    $stmt->bindValue(":classificationId", $classificationId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}


// Get vehicles by classificationId
function getInventoryByClassification($classificationId)
{
    $db = phpmotorsConnect();
    $sql = "SELECT * FROM inventory WHERE classificationId = :classificationId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":classificationId", $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}


// Get vehicle information by invId
function getInvItemInfo($invId)
{
    $db = phpmotorsConnect();
    $sql = "SELECT * FROM inventory INNER JOIN images ON inventory.invId = images.invId WHERE imgPrimary = 1 AND images.imgPath NOT LIKE '%-tn.___%' AND inventory.invId = :invId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":invId", $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}


// This function will handle updating vehicles
function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId)
{
    // Create a connnection object using the phpmotors connection function
    $db = phpmotorsConnect();

    //The SQL statement
    $sql = "UPDATE inventory 
        SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription,
        invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice,
        invStock = :invStock, invColor = :invColor, classificationId = :classificationId
        WHERE invId = :invId";

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next 10 lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(":invMake", $invMake, PDO::PARAM_STR);
    $stmt->bindValue(":invModel", $invModel, PDO::PARAM_STR);
    $stmt->bindValue(":invDescription", $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(":invImage", $invImage, PDO::PARAM_STR);
    $stmt->bindValue(":invThumbnail", $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(":invPrice", $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(":invStock", $invStock, PDO::PARAM_INT);
    $stmt->bindValue(":invColor", $invColor, PDO::PARAM_STR);
    $stmt->bindValue(":classificationId", $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(":invId", $invId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}


// This function will handle deleting vehicles
function deleteVehicle($invId)
{
    // Create a connnection object using the phpmotors connection function
    $db = phpmotorsConnect();

    //The SQL statement
    $sql = "DELETE FROM inventory WHERE invId = :invId";

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next line replaces the placeholder in the SQL
    // statement with the actual value in the variable
    // and tells the database the type of data it is
    $stmt->bindValue(":invId", $invId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}


// This function will get a list of vehicles based on the classification
function getVehiclesByClassification($classificationName)
{
    $db = phpmotorsConnect();
    $sql = "SELECT * FROM inventory INNER JOIN images ON inventory.invId = images.invId WHERE images.imgPrimary = 1 AND images.imgName LIKE '%-tn.___%' AND classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":classificationName", $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}


// This function will obtain information about all vehicles in inventory
function getVehicles()
{
    $db = phpmotorsConnect();
    $sql = 'SELECT invId, invMake, invModel FROM inventory';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}
