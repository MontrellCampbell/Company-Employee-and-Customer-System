<?php 
if(isset($_POST['add_technician'])) {

    include "../model/technician_db.php";
    addNewTechnician();
    $technician = get_technicians();
    header("Location: technician_list.php");
}
?>