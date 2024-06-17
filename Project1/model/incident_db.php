<?php
include "database.php";
function add_incident($customer_id, $product_code, $title, $description) {
    global $db;
    $date_opened = date('Y-m-d');  // get current date in yyyy-mm-dd format
    $query =
        'INSERT INTO incidents
            (customerID, productCode, dateOpened, title, description)
        VALUES (
               :customer_id, :product_code, :date_opened,
               :title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':product_code', $product_code);
    $statement->bindValue(':date_opened', $date_opened);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

function get_incidents(){
    global $db;
    $query = 'SELECT * FROM incidents';
    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll();
    $statement->closeCursor();
    return $incidents;
}

function get_unassigned_incidents(){
    global $db;
    $query = 'SELECT * FROM incidents
                WHERE techID IS NULL';
    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll();
    $statement->closeCursor();
    return $incidents;
}

function assign_incident($tec_id, $incident_id){
    global $db;
    $query = 'UPDATE incidents
              SET techID = :tec_id
              WHERE incidentID = :incident_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':tec_id', $tec_id);
    $statement->bindValue(':incident_id', $incident_id);
    $statement->execute();
    $statement->closeCursor();
}

function update_incident($incident_id,$date_closed,$incident_description) {
    global $db;
    $query = 'UPDATE incidents
              SET dateClosed = :date_closed,
                  description = :incident_description
              WHERE incidentID = :incident_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':date_closed', $date_closed);
    $statement->bindValue(':incident_description', $incident_description);
    $statement->bindValue(':incident_id', $incident_id);
    $statement->execute();
    $statement->closeCursor();
}
?>