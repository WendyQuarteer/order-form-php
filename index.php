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
$products = [
    ['name' => 'Fish-bathtub', 'price' => 45.80],
    ['name' => 'Fish-shampoo', 'price' => 12.50],
    ['name' => 'fish-comb', 'price' => 7.00],
    ['name' => 'fish-blow-dryer', 'price' => 35.00],
    ['name' => 'fish-wax', 'price' => 8.25],
    ['name' => 'fish-fake-pony-tail', 'price' => 21.15]
];
//get selected products:
function selected($products)
{
    if (isset($_POST['products'])) {
        $totalPrice = 0;
        foreach ($_POST['products'] as $product) {
            $selection = implode(": ", $products[$product]);
            print_r( $selection . "€<br>");
            $price = $products[$product]['price'];
            $totalPrice += $price;
        }
        return $totalPrice;
    }
}

$totalValue = selected($products);

function validate()
{
    // TODO: This function will send a list of invalid fields back
    return [];
}

function handleForm()
{
    // TODO: form related tasks (step 1)
    //get contact-details:
    $street = $_POST["street"];
    $streetNumber = $_POST["streetnumber"];
    $zipcode = $_POST["zipcode"];
    $city = $_POST["city"];
    echo "Thank you for your order: " . "We will soon ship to your address: " . $street
        . " " . $streetNumber . " in " . $zipcode . " " . $city . "." . "<br>";


    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
}

// TODO: replace this if by an actual check
if (isset($_POST["submit"])) {
    handleForm();
}

require 'form-view.php';