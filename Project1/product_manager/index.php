<?php include '../view/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>
<main>
    <?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../model/product_db.php";
        $version = filter_var($_POST['version'], FILTER_VALIDATE_FLOAT);

        if(!is_float($version)){
            echo '<h2>Error</h2>';
            echo 'add_product(): Argument #3 (Sversion) must be of type float,' .gettype($_POST['version']). " given, called in " . __FILE__ . " on line " . __LINE__;
        }else{
                
                add_product($_POST['code'], $_POST['name'], $_POST['version'], $_POST['release_date']);
                echo "<h2>Success</h2>";
                echo "Product '".$_POST['code']."' has been added.";
        }
    }
    ?>
<?php include '../view/footer.php'; ?>