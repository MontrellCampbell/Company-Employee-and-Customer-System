<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>
    <h2>Customer Login</h2>
    <p>You must login before you can register a product.</p>
    <!-- display a search form -->
    <form action="product_register.php" method="post">
        <input type="hidden" name="action" value="display_register">
        <label>Email:</label>
        <input type="text" name="email">
        <input type="submit" value="Login" name ="submit_email">
    </form>

</main>
<?php include '../view/footer.php'; ?>