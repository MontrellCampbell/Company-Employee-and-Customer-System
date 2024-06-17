<?php include '../view/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customer Display</title>
    <link rel="stylesheet" type="text/css" href="../view/main.css">
</head>
<body>
<h1>Add Technician</h1>
    <form action="index.php" method="post" id="aligned">
        <input type="hidden" name="action" value="add_technician">

        <label>First Name:</label>
        <input type="text" name="first_name" id="fname"><br>
        <p id="firstNameError" style="display:none;">First name is Required</p>

        <label>Last Name:</label>
        <input type="text" name="last_name" id ="lname"><br>
        <p id="lastNameError" style="display:none;">Last name is Required</p>


        <label>Email:</label>
        <input type="text" name="email" id="email"><br>
        <p id="emailError" style="display:none;">Email is Required</p>


        <label>Phone:</label>
        <input type="text" name="phone" id="phone"><br>
        <p id="phoneError" style="display:none;">Phone number is Required</p>


        <label>Password:</label>
        <input type="text" name="password" id="password"><br>
        <p id="passwordError" style="display:none;">Password is Required</p>

        <label>&nbsp;</label>

    <label>&nbsp;</label>
    <button type="submit" name="add_technician" onsubmit="return validateForm()">Add Technician</button>
</form>
<p><a href="product_list.php">View Product List</a></p>

<script>
    function validateForm() {
        var fname = document.getElementById("fname").value.trim();
        var lname = document.getElementById("lname").value.trim();
        var email = document.getElementById("email").value.trim();
        var phone = document.getElementById("phone").value.trim();
        var password = document.getElementById("password").value.trim();


        var firstNameError = document.getElementById("firstNameError");
        var lastNameError = document.getElementById("lastNameError");
        var emailError = document.getElementById("emailError");
        var phoneError = document.getElementById("phoneError");
        var passwordError = document.getElementById("passwordError");

        var isValid = true;

        if (fname === "") {
            firstNameError.style.display = "block";
            isValid = false;
        } else {
            firstNameError.style.display = "none";
        }

        if (lname === "") {
            lastNameError.style.display = "block";
            isValid = false;
        } else {
            lastNameError.style.display = "none";
        }

        if (email === "") {
            emailError.style.display = "block";
            isValid = false;
        } else {
            emailError.style.display = "none";
        }

        if (phone === "") {
            phoneError.style.display = "block";
            isValid = false;
        } else {
            releaseDateError.style.display = "none";
        }
        if (password === "") {
            passwordError.style.display = "block";
            isValid = false;
        } else {
            passwordError.style.display = "none";
        }

        return isValid;
    }
</script>

</main>
<?php include '../view/footer.php'; ?>