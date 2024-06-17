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
    <h2>Admin Login</h2><br>
    <form action="admin_menu.php" method="post">
        <div class="login">
            <input type="hidden" name="action" value="display_register">

            <label>Username:</label>
            <input type="text" name="username"><br><br>

            <label>Password:</label>
            <input type="text" name="password"><br>

        </div>
        <input type="submit" value="Login" name ="admin_login">
    </form>

    <script>
       
    <script>
</main>
<?php include '../view/footer.php'; ?>


