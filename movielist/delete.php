<?php

if (empty($_GET["id"])) {


    include "../includes/db.php";
    $con = getDBConnection();

    $movieID = $_GET["id"];

    $txtTitle = $_GET["txtTitle"];
    $txtRating = $_GET["txtRating"];

    try {
        $query = "DELETE FROM movielist WHERE MovieID = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $MovieID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);
    } catch (mysqli_sql_exception $ex) {
        echo $ex;
    }
}
header("Location: /movielist");
