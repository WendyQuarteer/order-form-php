<?php // This file is mostly containing things for your view / html ?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>The Hairy-Fish-Store</title>
</head>
<body>
<div class="container">
    <h1>The Hairy-Fish-Store: Everything to take care of your hairy fish</h1>
    <h2>Place your order:</h2>
    <?php // Navigation for when you need it ?>
    <?php /*
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    */ ?>
    <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" value = "<?php if (isset($_REQUEST['email'])) echo $_REQUEST['email']?>"/>
                <?php echo $emailErr ?>

            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value = "<?php if (isset($_REQUEST['street'])) echo $_REQUEST['street']?>">
                    <?php echo $streetErr ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value = "<?php if (isset($_REQUEST['streetnumber'])) echo $_REQUEST['streetnumber']?>">
                     <?php echo $streetNrErr ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value = "<?php if (isset($_REQUEST['city'])) echo $_REQUEST['city']?>">
                    <?php echo $cityErr ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value = "<?php if (isset($_REQUEST['zipcode'])) echo $_REQUEST['zipcode']?>">
                    <?php echo $zipcodeErr ?>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products as $i => $product): ?>
                <label>
					<?php // <?= is equal to <?php echo ?>
                    <input type="checkbox" value=<?php echo $i ?> name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?= number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" name="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in The Hairy-Fish-Store.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>
