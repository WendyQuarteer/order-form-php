<?php
// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html
// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables, so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//whatIsHappening();

// TODO: provide some products (you may overwrite the example)
###Products###
$products = [
    ['name' => 'Fish-bathtub', 'price' => 45.80],
    ['name' => 'Fish-shampoo', 'price' => 12.50],
    ['name' => 'fish-comb', 'price' => 7.00],
    ['name' => 'fish-blow-dryer', 'price' => 35.00],
    ['name' => 'fish-wax', 'price' => 8.25],
    ['name' => 'fish-fake-pony-tail', 'price' => 21.15]
];

function selected($products)
{
    if (isset($_POST['products'])) {
        foreach ($_POST['products'] as $key => $product) {
            var_dump($product);
            $selection = implode(": ", $products[$key]);
            echo $selection . "€<br>";
            return $selection;
        }

    }
}
function total($products)
{
    if (isset($_POST['products'])) {
        $totalPrice = 0;
        foreach ($_POST['products'] as $product) {
            $price = $products[$product]['price'];
            $totalPrice += floatval($price);
        }
        return $totalPrice;
    }
}
$totalValue = total($products);

/*function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}*/

###Validation###
function validate()
{
###contact-details###
    $_SESSION["streetNumber"] = $_POST["streetnumber"];
    $_SESSION["zipcode"] = $_POST["zipcode"];
    $_SESSION["street"] = $_POST["street"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["city"] = $_POST["city"];

###Errors###
    $emailErr = "This field is required! - Valid email format only!";
    $noAbcErr = "This field is required! - Input must be alphabetic only!";
    $noNumberErr = "This field is required! - Input must be numbers only!";

    // TODO: This function will send a list of invalid fields back
    $return = [];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!is_numeric($_SESSION["streetNumber"]) || empty($_SESSION["streetNumber"])) {
            $return["StreetNumber"] = $noNumberErr;
        }
        if (!is_numeric($_SESSION["zipcode"]) || empty($_SESSION["zipcode"])) {
            $return["Zipcode"] = $noNumberErr;
        }
        if (!ctype_alpha($_SESSION["street"]) || empty($_SESSION["street"])) {
            $return["Street"] = $noAbcErr;
        }
        if (!ctype_alpha($_SESSION["city"]) || empty($_SESSION["city"])) {
            $return["City"] = $noAbcErr;
        }
        if (!filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL) || empty($_SESSION["email"])) {
            $return["Email"] = $emailErr;
        }
    }
    return $return;
}

function handleForm($products)
{
    // TODO: form related tasks (step 1)
    // Validation (step 2)
    global $products;

    // TODO: handle errors
    $invalidFields = validate();
    if ($invalidFields) {
        foreach ($invalidFields as $key => $error) {
            echo "<div class='alert alert-warning'>" . "<strong>Warning: </strong>" . "<br>" . $key . ": " . $error . "</div>";
        }
    } // TODO: handle successful submission
    else {
        echo "<div class='alert alert-success alert-dismissible'>" . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . "<strong>Thank you for your order!</strong>"
            . "<br>" . "Confirmation will be sent to: " . $_SESSION["email"] . ".<br>" .
            "We will soon ship to your address: " . $_SESSION["street"] . " " . $_SESSION["streetNumber"]
            . " in " . $_SESSION["zipcode"] . " " . $_SESSION["city"] . "." . "<br>" . selected($products) . total($products) . "</div>";
    }
}

// TODO: replace this if by an actual check
if (isset($_POST["submit"])) {
    validate();
    handleForm($products);
}
require 'form-view.php';