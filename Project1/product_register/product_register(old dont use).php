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
    <h2>Register Product</h2>

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
                        $products = get_products();
                        foreach ($products as $product) {
                            echo "<option value='" . $product["productCode"] . "'>" . $product["name"] . "</option>";
                        }
                echo '
                    </select><br><br>
                    <input type="hidden" name="customerID" value="'.$customerID.'">
                    <input type="submit" value="Register Product" name="product_register">
                </form>';
        }
    ?>


    <?php

        if(isset($_POST["products"])){
            include "../model/registration_db.php";
            $selectedProduct = $_POST["products"];
            $customerID = $_POST['customerID'];
            add_registration($customerID, $selectedProduct);
            echo "Product (".$selectedProduct.") was registered successfully.";
        }
    ?>





    <!--<p style="display:none;" id="success">Product:(<span id="selectedProduct"></span>) was registered successfully</p>
    
    <script>
        function hideForm(event){
            event.preventDefault();
            var form = document.getElementById("registerForm");
            var success = document.getElementById("success");
            form.style.display = "none";
            success.style.display ="block";

            var selectedProductId = document.querySelector("select[name='products']").value;
            document.getElementById("selectedProduct").textContent = selectedProductId;
        }
    </script>
    -->

</main>
<?php include '../view/footer.php'; ?>