<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>
<h2>Select Incident</h2>
    <table>
        <thead>
        <tr>
            <th>Customer</th>
            <th>Title</th>
            <th>ProductCode</th>
            <th>Date Opened</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>

        <?php 

            include "../model/incident_db.php";
            include "../model/customer_db.php";
            $incidents = get_unassigned_incidents();

            foreach ($incidents as $incident) {
            $customer = get_customer($incident['customerID']);

                echo '<tr>';
                echo '<td>'.$customer['firstName'].' '.$customer['lastName'].'</td>';
                echo '<td>'.$incident['title'].'</td>';
                echo '<td>'.$incident['productCode'].'</td>';
                echo '<td>'.$incident['dateOpened'].'</td>';
                echo '<td>'.$incident['description'].'</td>';
                echo '<td>
                        <form action="technician_select.php" method="post">
                            <input type="hidden" name="incidentID" value="'.$incident['incidentID'].'">
                            <input type="hidden" name="customerID" value="'.$customer['customerID'].'">
                            <button type="submit" name="submit_button">Select</button>
                        </form>
                      </td>';
                echo '</tr>';
            }
        ?>
        </tbody>
    </table>

    <a href="../login_manager/admin_menu.php">Admin Menu</a>

</main>


<?php include '../view/footer.php'; ?>