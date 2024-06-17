<?php include '../view/header.php'; ?>
<main>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>   
<h2>Technician List</h2>
    <table>
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php 

            include "../model/technician_db.php";
            $technicians = get_technicians();

            foreach ($technicians as $technician) {
                echo '<tr>';
                echo '<td>'.$technician['firstName'].'</td>';
                echo '<td>'.$technician['lastName'].'</td>';
                echo '<td>'.$technician['email'].'</td>';
                echo '<td>'.$technician['phone'].'</td>';
                echo '<td>'.$technician['password'].'</td>';
                echo '<td>
                        <form method="post">
                            <input type="hidden" name="techID" value="'.$technician['techID'].'">
                            <button type="submit" name="submit_button">Delete</button>
                        </form>
                      </td>';
                echo '</tr>';
            }
            
            if (isset($_POST['submit_button'])) {
                $id = $_POST['techID'];
                delete_technician($id);
                header("Refresh:0");
            }
            

        ?>
        </tbody>
    </table>

    <a href="technician_add.php">Add Technician</a><br>
    <a href="../login_manager/admin_menu.php">Admin Menu</a>

</main>


<?php include '../view/footer.php'; ?>