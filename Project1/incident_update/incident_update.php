<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>

<?php 
    session_start();

    if(isset($_POST['update_incident'])){

        $_SESSION['incidentID'] = $_POST['incidentID'];
        $_SESSION['incidentProductCode'] = $_POST['incidentProductCode'];
        $_SESSION['incidentDateOpened'] = $_POST['incidentDateOpened'];
        $_SESSION['incidenttitle'] = $_POST['incidentTitle'];
        $_SESSION['incidentDesc'] = $_POST['incidentDescription'];

        echo '<h2>Update Incident</h2>
            <form id="registerForm" method="post">
                <input type="hidden" name="action" value="display_register"><br>
                <label>Incident ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . htmlspecialchars($_SESSION['incidentID']) . '</label><br><br>
                <label>Product Code:&nbsp;&nbsp;&nbsp;&nbsp; ' . htmlspecialchars($_SESSION['incidentProductCode']) . '</label><br><br>
                <label>Date Opened:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . htmlspecialchars($_SESSION['incidentDateOpened']) . '</label><br><br>
                <label>Date Closed:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input name="dateClosed"></input><br><br>
                <label>Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ' . htmlspecialchars($_SESSION['incidenttitle']) . '</label><br><br>
                <label>Description:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <textarea id="description" name="description" rows="4" cols="50" style="vertical-align: top;">'.$_SESSION['incidentDesc'].'</textarea><br><br>
                <button type="submit" name="submit_update_incident">Update Incident</button>
            </form>
            <p>You are logged in as ' . htmlspecialchars($_SESSION["techloginemail"]) . '</p>
            <button onclick="window.location.href = \'../main_menu/index.php\'">Logout</button>';
    }

    if(isset($_POST['submit_update_incident'])){
        include '../model/incident_db.php';
        update_incident($_SESSION['incidentID'],$_POST['dateClosed'],$_POST['description']);
        echo '<h2>Update Incident</h2><br>';
        echo '<p>This incident was updated.</p><br>';
        echo '<a href="incident_update_select.php">Select Another Incident</a><br>';
        echo '<p>You are logged in as '.htmlspecialchars($_SESSION["techloginemail"]).'</p><br>';
        echo '<button onclick="window.location.href = \'../main_menu/index.php\'">Logout</button>';
    }

    
?>

 
<?php include '../view/footer.php'; ?>