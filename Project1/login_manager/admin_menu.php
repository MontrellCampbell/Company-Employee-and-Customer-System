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

    if (isset($_POST['submit_button'])) 
    {
        include '../model/incident_db.php';
        $techID = $_POST['techID'];
        $incidentID = $_POST['incID'];
        assign_incident($techID, $incidentID);
    }

    if(isset($_POST['admin_login'])){

        $user = $_POST['username'];
        $pass = $_POST['password'];

        include '../model/database.php';

        function get_Admin($user, $pass){
            global $db;
            $query = 'SELECT * FROM administrators
                      WHERE username = :user AND password = :pass';
            $statement = $db->prepare($query);
            $statement->bindValue(':user', $user);
            $statement->bindValue(':pass', $pass);
            $statement->execute();
            $admin = $statement->fetch();
            $statement->closeCursor();
            
            return $admin;
        }
    
        $admin = get_Admin($user,$pass);

        if($admin == false){
            header('Location: admin_login.php');
            exit;
        }

        $_SESSION['user'] = $user;
    }

    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }
    ?>

    <nav>
        
    <h2>Admin Menu</h2>
    <ul>
        <li><a href="../product_manager/product_list.php">Manage Products</a></li>
        <li><a href="../technician_manager/technician_list.php">Manage Technicians</a></li>
        <li><a href="../customer_manager/customer_search.php">Manage Customers</a></li>
        <li><a href="../incident_create/customer_get.php">Create Incident</a></li>
        <li><a href="../incident_assign/incident_select.php">Assign Incident</a></li>
        <li><a href="../incident_create/unassigned_incidents.php">Display Incidents</a></li>
        <h2>Login Status</h2>
        <?php
            echo "<p>You are logged in as $user</p>"
        ?>

        <button onclick="window.location.href = '../main_menu/index.php';">Logout</button>
        
    </ul>
    
    </nav>
</section>
</body>
</main>
<?php include '../view/footer.php'; ?>