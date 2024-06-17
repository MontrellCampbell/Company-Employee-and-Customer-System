<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
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
<h2>Assigned Incidents</h2>
<a href="unassigned_incidents.php">View unassigned Incidents</a>
    <table>
        <thead>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Technician</th>
            <th>Incident</th>
        </tr>
        </thead>
        <tbody>

        <?php

            function get_technician($tech_ID) {
                global $db;
                $query = 'SELECT * FROM technicians
                        WHERE techID = :tech_ID';
                $statement = $db->prepare($query);
                $statement->bindValue(':tech_ID', $tech_ID);
                $statement->execute();
                $technician = $statement->fetch();
                $statement->closeCursor();
                return $technician;
            }

            function get_assigned_incidents(){
                global $db;
                $query = 'SELECT * FROM incidents
                WHERE techID IS NOT NULL';
                $statement = $db->prepare($query);
                $statement->execute();
                $incidents = $statement->fetchAll();
                $statement->closeCursor();
                return $incidents;
            }

            include "../model/incident_db.php";
            include "../model/customer_db.php";
            include "../model/product_db.php";

            $incidents = get_assigned_incidents();
        
            foreach ($incidents as $incident) {
                $customer = get_customer($incident['customerID']);
                $product = get_product($incident['productCode']);
                $technician = get_technician($incident['techID']);

                echo '<tr>';
                echo '<td>'.$customer['firstName'].' '.$customer['lastName'].'</td>';
                echo '<td>'.$product['name'].'</td>';
                echo '<td>'.$technician['firstName'].' '.$technician['lastName'].'</td>';

                echo '<td>
                <div class="container"><div class="box">
                    ID:<br><br>
                    Opened:<br><br>
                    Closed:<br><br>
                    Title:<br><br>
                    Description:
                    </div>
                    <div class="box">
                    '.$incident['incidentID'].'<br><br>
                    '.$incident['dateOpened'].'<br><br>';

                    if($incident['dateClosed'] === NULL){
                        echo 'OPEN<br><br>';
                    }else{
                        echo ''.$incident['dateClosed'].'<br><br>';
                    }

                echo'
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