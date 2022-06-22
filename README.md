# order-form-php

## Preparation
- [x] Have a look at the provided structure: you get both an index file and another file containing a form. 
How are these two working together?
  Index.php is about creating objects that contain both data and functions that will be used in the form-view.php file.
- [x] Think of a funny / surprising / original name for a store that should definitely exist. (fancy suits for cats? 
bongo for dates? you name it!)
  The Hairy-Fish-Store
- [x] Think of some products to sell (feel free to be creative) and update the products array with these.
  fish-wax, fish-comb, fish-shampoo, fish-blow-dryer, fish-fake-pony-tail
- [x] Check if all the products & prices are currently visible in the form.

## Step 1: accepting orders
- [x] Show an order confirmation when the user submits the form. This should contain the chosen products and delivery address.
We will learn how to save this information to a database later, so no need to do this now.

## Step 2: validation
Use PHP to check the following:
- [x] Required fields are not empty.
- [x] Zip code are only numbers.
- [x] Email address is valid.
- [X] Show any problems (empty or invalid data) with the fields at the top of the form. Tip: use the bootstrap alerts for 
inspiration. 
- [] If they are valid, the confirmation of step 1 is shown.
- [x] If the form was not valid, show the previous values in the form so that the user doesn't have to retype everything.
Usually, validation is a combination of server side checks (for security, these can't be bypassed) and checks in 
html / JS (can be bypassed but can give live user feedback).