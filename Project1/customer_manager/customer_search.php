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

<h2>Customer Search</h2>

<form method="post" onsubmit="return validateForm()">
    <input type="hidden" name="action" value="get_customer">
    <label>Last name:</label>&nbsp;
    <input type="input" name="lastName" id="lastName">
    <button type="submit" name="search_customer">Search</button>
</form>

<script>
    function validateForm() {
        var lastName = document.getElementById("lastName").value.trim();
        
        if (lastName === "") {
            
            return false;
        } else {
            
            return true; 
        }
    }
</script>
<?php

if(isset($_POST['search_customer'])) {
    
    include "../model/customer_db.php";

    echo'
        <table>
            <thead>
            <tr>
            <th>Name</th>
            <th>Email Address</th>
            <th>City</th>
            <th></th>
            </tr>
            </thead>
            <tbody>';
                
                        $lastName = $_POST['lastName'];
                        $customers = get_customers_by_last_name($lastName);

                        foreach ($customers as $customer) {
                            echo '<tr>';
                            echo '<td>'.$customer['firstName']." ".$customer['lastName'].'</td>';
                            echo '<td>'.$customer['email'].'</td>';
                            echo '<td>'.$customer['city'].'</td>';
                            echo '<td>
                                    <form action="customer_display.php" method="post">
                                        <input type="hidden" name="customerID" value="'.$customer['customerID'].'">
                                        <button type="submit" name="submit_button">Select</button>
                                    </form>
                                </td>';
                            echo '</tr>';
                        }
    echo'             
            </tbody>
        </table>';
    }
?>
    <h2>Add a new customer</h2>
    <form action="customer_display.php" method="post">
        <button type="submit" name="add_customer_button">Add Customer</button><br><br>
    </form>
    <a href="../login_manager/admin_menu.php">Admin Menu</a>        

</main>
<?php include '../view/footer.php'; ?>