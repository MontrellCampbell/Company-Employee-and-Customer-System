<?php
include 'database.php';

function get_countries() {
    global $db;
    $query = 'SELECT * FROM countries
              ORDER BY countryName';
    $statement = $db->prepare($query);
    $statement->execute();
    $countries = $statement->fetchAll();
    $statement->closeCursor();
    return $countries;
}

function get_country_by_country_code($country_code) {
    global $db;
    $query = 'SELECT * FROM countries
              WHERE countryCode = :country_code';
    $statement = $db->prepare($query);
    $statement->bindValue(':country_code', $country_code);
    $statement->execute();
    $country = $statement->fetch();
    $statement->closeCursor();
    return $country;
}

?>