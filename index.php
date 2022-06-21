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
        $totalPrice = 0;
        foreach ($_POST['products'] as $product) {
            $selection = implode(": ", $products[$product]);
            echo $selection . "€<br>";
            $price = $products[$product]['price'];
            $totalPrice += $price;
        }
        echo "Total: " . $totalPrice . "€<br>";
        return $totalPrice;
    }
}

$totalValue = selected($products);

/*function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}*/

/*echo "Thank you for your order!" . "<br>" . "Confirmation will be sent to: " . $email . ".<br>" .
    "We will soon ship to your address: " . $street
    . " " . $streetNumber . " in " . $zipcode . " " . $city . "." . "<br>";*/

###Validation###
function validate()
{
###contact-details###
    $streetNumber = $_POST["streetnumber"];
    $zipcode = $_POST["zipcode"];
    $street = $_POST["street"];
    $email = $_POST["email"];
    $city = $_POST["city"];

###Errors###
    $emailErr = "This field is required! - Valid email format only!";
    $noAbcErr = "This field is required! - Input must be alphabetic only!";
    $noNumberErr = "This field is required! - Input must be numbers only!";

    // TODO: This function will send a list of invalid fields back
    $return = [];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!is_numeric($streetNumber) || empty($streetNumber)) {
            $return["StreetNumber"] = $noNumberErr;
        }
        if (!is_numeric($zipcode) || empty($zipcode)) {
            $return["Zipcode"] = $noNumberErr;
        }
        if (!ctype_alpha($street) || empty($street)) {
            $return["Street"] = $noAbcErr;
        }
        if (!ctype_alpha($city) || empty($city)) {
            $return["City"] = $noAbcErr;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($email)) {
            $return["Email"] = $emailErr;
        }
    }
    return $return;
}

function handleForm()
{
    // TODO: form related tasks (step 1)
    // Validation (step 2)

    // TODO: handle errors
    $invalidFields = validate();
    //var_dump([$invalidFields]);
    echo "<div class='alert alert-warning'>" . "Warning: " . "<br>" . $invalidFields . "</div>";


    // TODO: handle successful submission

}

// TODO: replace this if by an actual check
if (isset($_POST["submit"])) {
    validate();
    handleForm();
}
require 'form-view.php';