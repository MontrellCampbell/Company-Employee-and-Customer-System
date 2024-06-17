<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
    <style>
        .container{
            display:flex;
            
        }
        .box{
            margin: 10px;
        }
    </style>
</head>
<h2>Unassigned Incidents</h2>
<a href="assigned_incidents.php">View Assigned Incidents</a>
    <table>
        <thead>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Incident</th>
        </tr>
        </thead>
        <tbody>

        <?php 

            include "../model/incident_db.php";
            include "../model/customer_db.php";
            include "../model/product_db.php";

            $incidents = get_unassigned_incidents();
        
            foreach ($incidents as $incident) {
                $customer = get_customer($incident['customerID']);
                $product = get_product($incident['productCode']);
                echo '<tr>';
                echo '<td>'.$customer['firstName'].' '.$customer['lastName'].'</td>';
                echo '<td>'.$product['name'].'</td>';

                echo '<td><div class="container"><div class="box">ID:<br><br>
                    Opened:<br><br>
                    Title:<br><br>
                    Description:</div>
                    <div class="box">'.$incident['incidentID'].'<br><br>
                    '.$incident['dateOpened'].'<br><br>
                    '.$incident['title'].'<br><br>
                    '.$incident['description'].'
                    </div></div>
                </td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>

    <a href="../product_add.php">Add Product</a><br>
    <a href="../login_manager/admin_menu.php">Admin Menu</a>

</main>


<?php include '../view/footer.php'; ?>