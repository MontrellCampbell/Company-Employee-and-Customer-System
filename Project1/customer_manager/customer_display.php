<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>
<body>
       <?php 
       
       session_start();

       $fnameError = $lnameError = $addressError = $cityError = $stateError = $postalError = $phoneError = $emailError = $passwordError = "";
       $updated = false;

       if(isset($_POST["submit_button"])){

              include "../model/customer_db.php";
              include "../model/country_db.php";

              $customerID = $_POST["customerID"];
              $customer = get_customer($customerID);
              $updated = true;
              $_SESSION['custID'] = $customerID;
              $_SESSION['fname'] = $customer['firstName'];
              $_SESSION['lname'] = $customer['lastName'];
              $_SESSION['address'] = $customer['address'];
              $_SESSION['city'] = $customer['city'];
              $_SESSION['state'] = $customer['state'];
              $_SESSION['postal'] = $customer['postalCode'];
              $_SESSION['phone'] = $customer['phone'];
              $_SESSION['email'] = $customer['email'];
              $_SESSION['password'] = $customer['password'];
              $_SESSION['countrycode'] = $customer['countryCode'];
              $customer_country = get_country_by_country_code($customer['countryCode']);
              $_SESSION['country'] = $customer_country[0];
              $_SESSION['updateoradd'] = 'update';
       }
       else if(isset($_POST["add_customer_button"])){
              include "../model/country_db.php";
              $updated = true;
              $_SESSION['fname'] = "";
              $_SESSION['lname'] = "";
              $_SESSION['address'] = "";
              $_SESSION['city'] = "";
              $_SESSION['state'] = "";
              $_SESSION['postal'] = "";
              $_SESSION['phone'] = "";
              $_SESSION['email'] = "";
              $_SESSION['password'] = "";
              $_SESSION['countrycode'] = "";
              $_SESSION['country'] = "";
              $_SESSION['updateoradd'] = 'add';
       }

       if($_SERVER['REQUEST_METHOD'] == 'POST' && $updated === false)
       {
              include "../model/customer_db.php";
              include "../model/country_db.php";

              if(empty(trim($_POST['first_name']))){
                     $fnameError = 'Required.';
                     $_SESSION['fname'] = "";
              }
              else if(strlen($_POST['first_name']) > 50){
                     $fnameError = 'Too long.';
                     $_SESSION['fname'] = $_POST['first_name'];
              }
              else{
                     $fnameError = '';
                     $_SESSION['fname'] = $_POST['first_name'];
              }

              if(empty(trim($_POST['last_name']))){
                     $lnameError = 'Required.';
                     $_SESSION['lname'] = "";
              }
              else if(strlen($_POST['last_name']) > 50){
                     $lnameError = 'Too long.';
                     $_SESSION['lname'] = $_POST['last_name'];
              }
              else{
                     $lnameError = '';
                     $_SESSION['lname'] = $_POST['last_name'];
              }

              if(empty(trim($_POST['address']))){
                     $addressError = 'Required.';
                     $_SESSION['address'] = "";
              }
              else if(strlen($_POST['address']) > 50){
                     $addressError = 'Too long.';
                     $_SESSION['address'] = $_POST['address'];
              }
              else{
                     $addressError = '';
                     $_SESSION['address'] = $_POST['address'];
              }

              if(empty(trim($_POST['city']))){
                     $cityError = 'Required.';
                     $_SESSION['city'] = "";

              }
              else if(strlen($_POST['city']) > 50){
                     $cityError = 'Too long.';
                     $_SESSION['city'] = $_POST['city'];
              }
              else{
                     $cityError = '';
                     $_SESSION['city'] = $_POST['city'];
              }

              if(empty(trim($_POST['state']))){
                     $stateError = 'Required.';
                     $_SESSION['state'] = "";
              }
              else if(strlen($_POST['state']) > 50){
                     $stateError = 'Too long.';
                     $_SESSION['state'] = $_POST['state'];
              }
              else{
                     $stateError = '';
                     $_SESSION['state'] = $_POST['state'];
              }

              if(empty(trim($_POST['postal_code']))){
                     $postalError = 'Required.';
                     $_SESSION['postal'] = "";
              } 
              else if(strlen($_POST['postal_code']) > 20){
                     $postalError = 'Too long.';
                     $_SESSION['postal'] = $_POST['postal_code'];
              }
              else{
                     $postalError = '';
                     $_SESSION['postal'] = $_POST['postal_code'];
              }

              if(preg_match("/^\(\d{3}\) \d{3}-\d{4}$/",$_POST['phone'])){
                    $phoneError = "";
                    $_SESSION['phone'] = $_POST['phone'];
              }
              else{
                     $phoneError = "Use (999) 999-9999 format.";
                    $_SESSION['phone'] = $_POST['phone'];
              }

              if(empty(trim($_POST['email']))){
                     $emailError = 'Required.';
                     $_SESSION['email'] = "";
              }
              else if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

                     $emailError = '';
                     $_SESSION['email'] = $_POST['email'];
              }
              else{
                     $emailError = 'Invalid email address.';
                     $_SESSION['email'] = $_POST['email'];
              }

              if(empty(trim($_POST['password']))){
                     $passwordError = 'Required.';
                     $_SESSION['password'] = "";
              }
              else if(strlen($_POST['password']) < 6){
                     $passwordError = 'Too short.';
                     $_SESSION['password'] = $_POST['password'];
              }
              else if(strlen($_POST['password']) > 20){
                     $passwordError = 'Too long.';
                     $_SESSION['password'] = $_POST['password'];
              }
              else{
                     $passwordError = '';
                     $_SESSION['password'] = $_POST['password'];
              }

              if($_SESSION['updateoradd'] === 'update')
              {
                     if ($fnameError === "" && $lnameError === "" && $addressError === "" && $cityError === "" && $stateError === "" && $postalError === "" && $phoneError === "" && $emailError === "" && $passwordError === "") {
                            update_customer($_SESSION['custID'], $_SESSION['fname'], $_SESSION['lname'], $_SESSION['address'], $_SESSION['city'], 
                            $_SESSION['state'], $_SESSION['postal'], $_SESSION['countrycode'], $_SESSION['phone'], $_SESSION['email'], $_SESSION['password']);

                            $_SESSION['fname'] = "";
                            $_SESSION['lname'] = "";
                            $_SESSION['address'] = "";
                            $_SESSION['city'] = "";
                            $_SESSION['state'] = "";
                            $_SESSION['postal'] = "";
                            $_SESSION['phone'] = "";
                            $_SESSION['email'] = "";
                            $_SESSION['password'] = "";
                            $_SESSION['countrycode'] = "";
                            $_SESSION['country'] = "";
                            $_SESSION['updateoradd'] = "";
                            header('Location: customer_search.php');
                            
                     }
              }
              if($_SESSION['updateoradd'] === 'add')
              {
                     if ($fnameError === "" && $lnameError === "" && $addressError === "" && $cityError === "" && $stateError === "" && $postalError === "" && $phoneError === "" && $emailError === "" && $passwordError === "") {
                            add_customer($_SESSION['fname'], $_SESSION['lname'], $_SESSION['address'], $_SESSION['city'], 
                            $_SESSION['state'], $_SESSION['postal'], $_SESSION['countrycode'], $_SESSION['phone'], $_SESSION['email'], $_SESSION['password']);

                            $_SESSION['fname'] = "";
                            $_SESSION['lname'] = "";
                            $_SESSION['address'] = "";
                            $_SESSION['city'] = "";
                            $_SESSION['state'] = "";
                            $_SESSION['postal'] = "";
                            $_SESSION['phone'] = "";
                            $_SESSION['email'] = "";
                            $_SESSION['password'] = "";
                            $_SESSION['countrycode'] = "";
                            $_SESSION['country'] = "";
                            $_SESSION['updateoradd'] = "";
                            header('Location: customer_search.php');
                     }
              }  
       }
       ?>

    <!-- display a table of customer information -->
    <h2>View/Update Customer</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="aligned" onsubmit="return validate()">
        <input type="hidden" name="action" value="update_customer">

        <label>First Name:</label>
        <input type="text" name="first_name" id="first_name"
               value="<?php echo htmlspecialchars($_SESSION['fname']); ?>">
               <span style="color:red;"><?php echo $fnameError ?></span><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" id = "last_name"
               value="<?php echo htmlspecialchars($_SESSION['lname']); ?>">
               <span style="color:red;"><?php echo $lnameError ?></span><br>

        <label>Address:</label>
        <input type="text" name="address" id="address"
               value="<?php echo htmlspecialchars($_SESSION['address']); ?>" 
               size="50">
               <span style="color:red;"><?php echo $addressError ?></span><br>

        <label>City:</label>
        <input type="text" name="city" id="city"
               value="<?php echo htmlspecialchars($_SESSION['city']); ?>">
               <span style="color:red;"><?php echo $cityError ?></span><br>

        <label>State:</label>
        <input type="text" name="state" id="state"
              value="<?php echo htmlspecialchars($_SESSION['state']); ?>">
              <span style="color:red;"><?php echo $stateError ?></span><br>

        <label>Postal Code:</label>
        <input type="text" name="postal_code" id="postal_code"
               value="<?php echo htmlspecialchars($_SESSION['postal']); ?>">
               <span style="color:red;"><?php echo $postalError ?></span><br>

        <label>Country:</label>
        <?php echo '<select name="countries" style="width: 200px;">'; 
              $countries = get_countries();
              echo "<option value='" . $_SESSION['countrycode'] . "'>" . $_SESSION['country'] . "</option>";
              foreach ($countries as $country) {
                     echo "<option value='" . $country["countryCode"] . "'>" . $country["countryName"] . "</option>";
              }
              echo '</select><br>';
        ?>
        <label>Phone:</label>
        <input type="text" name="phone" id="phone"
               value="<?php echo htmlspecialchars($_SESSION['phone']); ?>">
               <span style="color:red;"><?php echo $phoneError ?></span><br>

        <label>Email:</label>
        <input type="text" name="email" id="email"
               value="<?php echo htmlspecialchars($_SESSION['email']); ?>" 
               size="50">
               <span style="color:red;"><?php echo $emailError ?></span><br>

        <label>Password:</label>
        <input type="text" name="password" id="password"
               value="<?php echo htmlspecialchars($_SESSION['password']); ?>">
               <span style="color:red;"><?php echo $passwordError ?></span><br>

        <label>&nbsp;</label>
       
        <?php

              if($_SESSION['updateoradd'] === 'update'){

                     echo'<input type="submit" name= "updateCustomer" value="Update Customer"><br>';
              }
              else{
                     echo'<input type="submit" name= "addCustomer" value="Add Customer"><br>';
              }
                
        ?>

    </form>
    <p><a href="customer_search.php">Search Customers</a></p>
</main>
<?php include '../view/footer.php'; ?>