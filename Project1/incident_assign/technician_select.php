<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>
<?php
    function get_number_of_incidents($technicianId){
        global $db;
        $query = 'SELECT COUNT(*) AS num_incidents FROM incidents WHERE techID = :technicianId';
        $statement = $db->prepare($query);
        $statement->bindValue(':technicianId', $technicianId);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result['num_incidents'];
    }    
?>


<h2>Technician List</h2>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Open Incidents</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php 

            if(isset($_POST['submit_button'])){
                session_start();
                $_SESSION['selectedIncidentID'] = $_POST['incidentID'];
                $_SESSION['selectedIncidentCustomerID'] = $_POST['customerID'];
            }

            include "../model/technician_db.php";
            $technicians = get_technicians();

            foreach ($technicians as $technician) {
                echo '<tr>';
                echo '<td>'.$technician['firstName'].' '.$technician['lastName'].'</td>';
                echo '<td>'.get_number_of_incidents($technician['techID']).'</td>';
                echo '<td>
                        <form action="incident_assign.php" method="post">
                            <input type="hidden" name="techID" value="'.$technician['techID'].'">
                            <input type="hidden" name="techfName" value="'.$technician['firstName'].'">
                            <input type="hidden" name="techlName" value="'.$technician['lastName'].'">
                            <button type="submit" name="submit_tech">Select</button>
                        </form>
                      </td>';
                echo '</tr>';
            } 
        ?>
        </tbody>
    </table>

    <a href="incident_select.php">Incidents</a>

</main>


<?php include '../view/footer.php'; ?>