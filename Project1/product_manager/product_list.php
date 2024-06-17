<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>
<h2>Product List</h2>
    <table>
        <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php 

            include "../model/product_db.php";
            $products = get_products();

            foreach ($products as $product) {
                echo '<tr>';
                echo '<td>'.$product['productCode'].'</td>';
                echo '<td>'.$product['name'].'</td>';
                echo '<td>'.$product['version'].'</td>';
                echo '<td>'.$product['releaseDate'].'</td>';
                echo '<td>
                        <form method="post">
                            <input type="hidden" name="productCode" value="'.$product['productCode'].'">
                            <button type="submit" name="submit_button">Delete</button>
                        </form>
                      </td>';
                echo '</tr>';
            }
            
            if (isset($_POST['submit_button'])) {
                $productCode = $_POST['productCode'];
                delete_product($productCode);
                header("Refresh:0");
            }
            

        ?>
        </tbody>
    </table>

    <a href="../product_manager/product_add.php">Add Product</a><br>
    <a href="../login_manager/admin_menu.php">Admin Menu</a>

</main>


<?php include '../view/footer.php'; ?>