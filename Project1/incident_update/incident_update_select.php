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
    include '../model/customer_db.php';

    if(isset($_POST['technician_login'])){

        $_SESSION['recentIncidentUpdate'] = false;
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $_SESSION['techEmailSignin'] = $email;
        $_SESSION['techPasswordSignin'] = $pass;

        include '../model/database.php';

        function get_technician($email, $pass){
            global $db;
            $query = 'SELECT * FROM technicians
                      WHERE email = :email AND password = :pass';
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':pass', $pass);
            $statement->execute();
            $technician = $statement->fetch();
            $statement->closeCursor();
            
            return $technician;
        }
    
        $technician = get_technician($_SESSION['techEmailSignin'],$_SESSION['techPasswordSignin']);

        if($technician == false){
            header('Location:../login_manager/technician_login.php');
            exit;
        }

        $_SESSION['techIDSignin'] = $technician['techID'];
    }
    
    $email = $_SESSION['techEmailSignin'];

    function get_incidents($techID){
        global $db;
        $query = 'SELECT * FROM incidents
                    WHERE techID = :techID AND dateClosed IS NULL';
        $statement = $db->prepare($query);
        $statement->bindValue(':techID', $techID);
        $statement->execute();
        $incidents = $statement->fetchAll();
        $statement->closeCursor();
    
        return $incidents;
    }
    

    $incidents = get_incidents($_SESSION['techIDSignin']);

    if($incidents == false){
        echo '<h2>Select Incident<h2>';
        echo "There are no open incidents for this technician.<br>";
        echo '<a href="" onclick="window.location.reload();">Refresh List of Incidents</a>';
        echo "<p>You are logged in as $email</p>";
        echo '<button onclick="window.location.href = \'../main_menu/index.php\';">Logout</button>';

    }
    else{
        echo '<h2>Select Incident</h2>';
        echo '
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>ProductCode</th>
                    <th>Date Opened</th>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>';
        
        foreach ($incidents as $incident) {
            $customer = get_customer($incident['customerID']);
            echo '
            <tr>
                <td>'.$customer['firstName'].' '.$customer['lastName'].'</td>
                <td>'.$incident['productCode'].'</td>
                <td>'.$incident['dateOpened'].'</td>
                <td>'.$incident['title'].'</td>
                <td>'.$incident['description'].'</td>
                <td>
                    <form action="incident_update.php" method="post">
                        <input type="hidden" name="incidentID" value="'.$incident['incidentID'].'">
                        <input type="hidden" name="incidentProductCode" value="'.$incident['productCode'].'">
                        <input type="hidden" name="incidentDateOpened" value="'.$incident['dateOpened'].'">
                        <input type="hidden" name="incidentTitle" value="'.$incident['title'].'">
                        <input type="hidden" name="incidentDescription" value="'.$incident['description'].'">
                        <button type="submit" name="update_incident">Select</button>
                    </form>
                </td>
            </tr>';
        }
        
        echo '
            </tbody>
        </table>';

        echo "<p>You are logged in as $email</p>";
        echo '<button onclick="window.location.href = \'../main_menu/index.php\';">Logout</button>';
    }
    ?>
</section>
</body>
</main>
<?php include '../view/footer.php'; ?>