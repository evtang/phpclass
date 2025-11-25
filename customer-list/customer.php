<?php

if (empty($_GET["id"]))
{
    header("Location: /customer-list");
}

include "../includes/db.php";
$con = getDBConnection();

$customerID = $_GET["id"];

try {
    $query = "SELECT * FROM customers WHERE CustomerID = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $CustomerID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);


    $txtFirstName = $row["firstName"];
    $txtLastName = $row["lastName"];
    $txtAddress = $row["address"];
    $txtCity = $row["city"];
    $txtState = $row["state"];
    $txtZip = $row["zip"];
    $txtPhone = $row["phone"];
    $txtEmail = $row["email"];
    $txtPassword = $row["password"];
}
catch(mysqli_sql_exception $ex) {
    echo $ex;
}

// do the update (update the db)


if (!empty($_POST["txtFirstName"]) && !empty($_POST["txtLastName"]) && !empty($_POST["txtAddress"])
    && !empty($_POST["txtCity"]) && !empty($_POST["txtState"]) && !empty($_POST["txtZip"]) &&
    !empty($_POST["txtPhone"]) && !empty($_POST["txtEmail"]) && !empty($_POST["txtPassword"])) {

    $txtFirstName = $_POST["txtFirstName"];
    $txtLastName = $_POST["txtLastName"];
    $txtAddress = $_POST["txtAddress"];
    $txtCity = $_POST["txtCity"];
    $txtState = $_POST["txtState"];
    $txtZip = $_POST["txtZip"];
    $txtPhone = $_POST["txtPhone"];
    $txtEmail = $_POST["txtEmail"];
    $txtPassword = $_POST["txtPassword"];
    try {
        $query = "INSERT INTO customers ( FirstName, LastName, Address, City, State, Zip, Phone, Email, Password)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sssssssss", $txtFirstName, $txtLastName, $txtAddress,
            $txtCity, $txtState, $txtZip, $txtPhone, $txtEmail, $txtPassword);
        mysqli_stmt_execute($stmt);

        header("Location: /customers");
    }
    catch(mysqli_sql_exception $ex) {
        echo $ex;
    }
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eddie's website</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="./css/grid.css">

</head>
<body>
<?php
include "../includes/header.php";
?>
<div id="three-column">
    <?php
    include "../includes/navigation.php";
    ?>
    <main>

        <form method="post">
            <div class="grid-container">

                <div class="grid-header">
                    <h3>Update Customer:</h3>
                </div>

                <div class="customerId">
                    <label for="txtCustomerId">Customer ID:</label>
                </div>

                <div class="customer-input">
                    <input type="text" name="txtCustomerId" id="txtCustomerId" value="<?=$customerID;?>">
                </div>
                <div class="first-name">
                    <label for="txtFirstName">First Name:</label>
                </div>

                <div class="firstName-input">
                    <input type="text" name="txtFirstName" id="txtFirstName" value="<?=$txtFirstName;?>">
                </div>

                <div class="last-name">
                    <label for="txtLastName">Last Name:</label>
                </div>

                <div class="lastName-input">
                    <input type="text" name="txtLastName" id="txtLastName" value="<?=$txtLastName;?>">
                </div>

                <div class="address">
                    <label for="txtAddress">Address:</label>
                </div>

                <div class="address-input">
                    <input type="text" name="txtAddress" id="txtAddress" value="<?=$txtAddress;?>">
                </div>

                <div class="city">
                    <label for="txtCity">City:</label>
                </div>

                <div class="city-input">
                    <input type="text" name="txtCity" id="txtCity" value="<?=$txtCity;?>">
                </div>

                <div class="state">
                    <label for="txtState">State:</label>
                </div>

                <div class="state-input">
                    <input type="text" name="txtState" id="txtState" value="<?=$txtState;?>">
                </div>

                <div class="zip">
                    <label for="txtZip">Zip:</label>
                </div>

                <div class="zip-input">
                    <input type="text" name="txtZip" id="txtZip" value="<?=$txtZip;?>">
                </div>

                <div class="phone">
                    <label for="txtPhone">Phone:</label>
                </div>

                <div class="phone-input">
                    <input type="text" name="txtPhone" id="txtPhone" value="<?=$txtPhone;?>">
                </div>

                <div class="email">
                    <label for="txtEmail">Email:</label>
                </div>

                <div class="email-input">
                    <input type="text" name="txtEmail" id="txtEmail" value="<?=$txtEmail;?>">
                </div>

                <div class="password">
                    <label for="txtPassword">Password:</label>
                </div>

                <div class="password-input">
                    <input type="text" name="txtPassword" id="txtPassword" value="<?=$txtPassword;?>">
                </div>

                <div class="grid-footer">
                    <input type="submit" value="Update Customer">
                    <input type="button" value="Delete Customer" id="delete">
                </div>


            </div>
        </form>
    </main>
</div>
<?php
include "../includes/footer.php";
?>
<script>

    const deleteButton = document.querySelector('#delete')
    deleteButton.addEventListener('click', () => {
        window.location = `./delete.php?id=<?=$customerID?>`
    })
</script>
</body>
</html>
