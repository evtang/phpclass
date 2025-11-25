<?php

if (empty($_GET["id"])) {


    include "../includes/db.php";
    $con = getDBConnection();

    $customerID = $_GET["id"];

    $txtFirstName = $_GET["txtFirstName"];
    $txtLastName = $_GET["txtLastName"];
    $txtAddress = $_GET["txtAddress"];
    $txtCity = $_GET["txtCity"];
    $txtState = $_GET["txtState"];
    $txtZip = $_GET["txtZip"];
    $txtPhone = $_GET["txtPhone"];
    $txtEmail = $_GET["txtEmail"];
    $txtPassword = $_GET["txtPassword"];

    try {
        $query = "DELETE FROM customers WHERE CustomerID = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $customerID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);
    } catch (mysqli_sql_exception $ex) {
        echo $ex;
    }
}
header("Location: /customer-list");

