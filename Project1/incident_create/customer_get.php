<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>   
    <h2>Get Customer</h2>
    <p>You must enter the customer's email address to select the customer.</p>
    <!-- display a search form -->
    <form action="incident_create.php" method="post">
        <input type="hidden" name="action" value="get_customer">
        <label>Email:</label>&nbsp;
        <input type="input" name="email">
        <input type="submit" value="Get Customer" name="submit_email">
    </form>
    <a href="../login_manager/admin_menu.php">Admin Menu</a>

</main>
<?php include '../view/footer.php'; ?>