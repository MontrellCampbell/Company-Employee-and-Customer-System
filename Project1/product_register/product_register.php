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
    session_set_cookie_params(0);
    session_start();
    
    if(isset($_POST['customer_login'])){

        $visibleBody = true;

        $email = $_POST['email'];
        $pass = $_POST['password'];

        include '../model/database.php';

        function get_customer($email, $pass){
            global $db;
            $query = 'SELECT * FROM customers
                      WHERE email = :email AND password = :pass';
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':pass', $pass);
            $statement->execute();
            $customer = $statement->fetch();
            $statement->closeCursor();
            
            return $customer;
        }
    
        $customer = get_customer($email,$pass);

        if(!$customer){
            header('Location: customer_login.php');
            exit;
        }

        $firstname = $customer['firstName'];
        $lastname = $customer['lastName'];
        $id = $customer['customerID'];

        $_SESSION['customer'] = $customer;
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['id'] = $id;
        $_SESSION['visbody'] = $visibleBody;

        echo '<h2>Register Product</h2>';

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
                <input type="hidden" name="customerID" value="' . $customerID . '">
                <input type="submit" value="Register Product" name="product_register">
            </form>
            <p>You are logged in as ' . $email . '</p>
            <button onclick="window.location.href = \'../main_menu/index.php\';">Logout</button>';
    }

    if(isset($_SESSION['email'])){

        $customer = $_SESSION['customer'];
        $email = $_SESSION['email'];
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        $id = $_SESSION['id'];
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
</main>
<?php include '../view/footer.php'; ?>