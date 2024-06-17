<?php include '../view/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
    <style> 
    </style>
</head>
<main>
    <h2>Technician Login</h2>
    <p>You must login before you can update an incident.</p>
    <form action="../incident_update/incident_update_select.php" method="post">
        <div class="login">
            <input type="hidden" name="action" value="display_register">

            <label>Email:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="email"><br><br>

            <label>Password:</label>&nbsp;&nbsp;&nbsp;
            <input type="text" name="password"><br>
        </div>
        <input type="submit" value="Login" name ="technician_login">
    </form>
</main>
<?php include '../view/footer.php'; ?>