<?php
// This is the Main controller


// Create or access a Session
session_start();


// Get the database connection file
require_once "library/connections.php";
// Get the custom functions library
require_once "library/functions.php";
// Get the PHP Motors model for use as needed
require_once "model/main-model.php";

// Get carclassifications array and pass into buildNav function as a parameter
$classifications = getClassifications();
$navList = buildNav($classifications);

// $action variable is equal to whatever is in the POST method, if the POST is empty, $action variable is equal to the GET method. 
// it looks for "?action=" at the end of the URL
$action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

// Check for the existence of a cookie with "firstname"
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

// Control structure to determine which view to show, depending on the URL parameters passed through the GET method
switch ($action) {
    case "template":
        include "view/template.php";
        break;
    default:
        include "view/home.php";
}
