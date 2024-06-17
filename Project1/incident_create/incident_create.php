<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>

<?php
    
    $customer = null;

    if(isset($_POST['submit_email'])){
        include "../model/customer_db.php";
        $email = $_POST["email"];
        $customer = get_customer_by_email($email);
        
    }

?>
    <h2>Create Incident</h2>

    <?php
        
        if($customer != null){
                echo '
                <form id="registerForm" method="post">
                    <input type="hidden" name="action" value="display_register">
                    <br>
                    <label>Customer:&nbsp;&nbsp;&nbsp;&nbsp; ' . htmlspecialchars($customer["firstName"]) . ' ' . htmlspecialchars($customer["lastName"]) . '</label><br><br>
                    <label>Product:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="products" style="width: 200px;">';
                    
                        include "../model/product_db.php";
                        $customerID = $customer["customerID"];
                        $customerEmail = $customer["email"];
                        $products = get_products_by_customer($customerEmail);
                        foreach ($products as $product) {
                            echo "<option value='" . $product["productCode"] . "'>" . $product["name"] . "</option>";
                        }
                echo '
                    </select><br><br>

                    <label>Title:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" id="title" name="title"><br><br>

                    <label>Description:</label>
                    <textarea id="description" name="description" rows="4" cols="50" style="vertical-align: top;"></textarea><br><br>


                    <input type="hidden" name="customerID" value="'.$customerID.'">
                    <input type="submit" value="Create Incident" name="product_register">
                </form>';
        }
    ?>


    <?php

        if(isset($_POST["products"])){
            include "../model/incident_db.php";
            $selectedProduct = $_POST["products"];
            $customerID = $_POST['customerID'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            add_incident($customerID, $selectedProduct, $title, $description);
            echo "<br>";
            echo "The incident was added to our database";
        }
    ?>