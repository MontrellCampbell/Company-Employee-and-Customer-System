<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>
<body>
        <?php
            session_start();
            function get_incident($incident_ID){
                global $db;
                $query = 'SELECT * FROM incidents
                        WHERE incidentID = :incident_ID';
                $statement = $db->prepare($query);
                $statement->bindValue(':incident_ID', $incident_ID);
                $statement->execute();
                $incident = $statement->fetch();
                $statement->closeCursor();
                return $incident;
            }
             if(isset($_POST['submit_tech'])){
                include "../model/customer_db.php";
                $technicianID = $_POST['techID'];
                $_SESSION['selectedTechnicianID'] = $technicianID;
                $technicianfName = $_POST['techfName'];
                $technicianlName = $_POST['techlName'];
                $customer = get_customer($_SESSION['selectedIncidentCustomerID']);
                $incident = get_incident($_SESSION['selectedIncidentID']);

                echo '
                    <h2>Register Product</h2>
                    <form action="'. htmlspecialchars($_SERVER["PHP_SELF"]) .'" id="registerForm" method="post">
                        <input type="hidden" name="action" value="display_register">
                        <br>
                        <label>Customer:&nbsp;&nbsp;&nbsp;&nbsp;'. htmlspecialchars($customer["firstName"]) . ' ' . htmlspecialchars($customer["lastName"]) .'</label><br><br>
                        <label>Product:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $incident['productCode'] .'<br><br>
                        <label>Technician:&nbsp;&nbsp;'. htmlspecialchars($technicianfName) .' '. htmlspecialchars($technicianlName) .'</label><br><br>
                        <button type="submit" name="assign_incident">Assign Incident</button>
                    </form>';

            }
            if(isset($_POST['assign_incident'])){
                include "../model/incident_db.php";
                echo '<h2>Assign Incident</h2><br>
                <p>This incident was assign to a technician.</p><br>
                <a href="incident_select.php">Select Another Incident</a>';
                assign_incident($_SESSION['selectedTechnicianID'],$_SESSION['selectedIncidentID']);
            }
        ?>
</body>        
</main>
<?php include '../view/footer.php'; ?>