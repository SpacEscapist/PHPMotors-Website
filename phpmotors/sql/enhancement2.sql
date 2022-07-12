/* Insert new record */
INSERT INTO clients (
        clientFirstname,
        clientLastname,
        clientEmail,
        clientPassword,
        clientLevel,
        comment
    )
VALUES (
        "Tony",
        "Stark",
        "tony@starkent.com",
        "Iam1ronM@n",
        1,
        "I am the real Ironman"
    );
/* Change client level for clientId 1 */
UPDATE clients
SET clientLevel = 3
WHERE clientFirstname = "Tony"
    AND clientLastname = "Stark";
/* Update Hummer description */
UPDATE inventory
SET invDescription = replace(
        invDescription,
        'small interiors',
        'spacious interior'
    )
WHERE invModel = 'Hummer';
/* Query database with INNER JOIN to get model and classification name */
SELECT inventory.invModel,
    carclassification.classificationName
FROM inventory
    INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId
WHERE classificationName = "SUV";
/* Remove record with the name "Wrangler" */
DELETE FROM inventory
WHERE invModel = "Wrangler";
/* Update ALL records to add /phpmotors to Image and Thumbnail file paths */
UPDATE inventory
SET invImage = CONCAT('/phpmotors', invImage),
    invThumbnail = CONCAT('/phpmotors', invThumbnail);