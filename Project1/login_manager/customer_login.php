<?php include '../view/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
    <style> 
    </style>
</head>
<main>
    <h2>Customer Login</h2><br>
    <form action="../product_register/product_register.php" method="post">
        <div class="login">
            <input type="hidden" name="action" value="display_register">

            <label>Email:</label>
            <input type="text" name="email"><br><br>

            <label>Password:</label>
            <input type="text" name="password"><br>
        </div>
        <input type="submit" value="Login" name ="customer_login">
    </form>
</main>
<?php include '../view/footer.php'; ?>