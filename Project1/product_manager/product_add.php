<?php include '../view/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>
<main>
    <h1>Add Product</h1>
    <form action="index.php" method="POST" id="aligned">
        <input type="hidden" name="action" value="add_product">

        <label>Code:</label>
        <input type="text" name="code" id="code"><br>
        <span></span>

        <label>Name:</label>
        <input type="text" name="name" id="name"><br>
        <span> </span>

        <label>Version:</label>
        <input type="text" name="version" id="version"><br>
        <span> </span>

        <label>Release Date:</label>
        <input type="text" name="release_date" id="release_date">
        <label class="message">Use 'yyyy-mm-dd' format</label><br>
        <span> </span>

        <label>&nbsp;</label>
        <button type="submit" name="add_product">Add Product</button>
    </form>
    <p><a href="product_list.php">View Product List</a></p>

    </main>
    <?php include '../view/footer.php'; ?>