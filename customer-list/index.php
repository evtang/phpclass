<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eddie's website</title>
    <link rel="stylesheet" href="/css/base.css">
    <style>
        table {
            border: 1px solid black;
            width: 80%;
            margin: 10px auto;
            table-layout: fixed;
        }
        table a {
            color:#005366;
        }
        table a:hover {
            text-decoration: underline;
        }
        th, td{
            border: 1px solid black;
            padding: .2rem;
        }
    </style>
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
        <h2>Customer Listing</h2>
        <table class="customers">
            <tr>
                <th>ID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
            <?php
            include "../includes/db.php";
            $con = getDBConnection();
            $result = mysqli_query($con, "SELECT * FROM customers");

            while ($row = mysqli_fetch_array($result)) {

                $customerID = $row["CustomerID"];
                $firstName = $row["FirstName"];
                $lastName = $row["LastName"];
                $address = $row["Address"];
                $city = $row["City"];
                $state = $row["State"];
                $zip = $row["Zip"];
                $phone = $row["Phone"];
                $email = $row["Email"];
                $password = $row["Password"];

                echo "<tr>";
                echo "    <td>$customerID</td>";
                echo "    <td>";
                echo "        <a href=\"customer.php?id=$customerID\">$firstName</a>";
                echo "      </td>";
                echo "    <td>$lastName</td>";
                echo "    <td>$address</td>";
                echo "    <td>$city</td>";
                echo "    <td>$state</td>";
                echo "    <td>$zip</td>";
                echo "    <td>$phone</td>";
                echo "    <td>$email</td>";
                echo "    <td>$password</td>";
                echo "</tr>";
            }

            ?>

        </table>
        <div>
            <a href="addcustomer.php">Add a new customer</a>
        </div>

    </main>
</div>
<?php
include "../includes/footer.php";
?>
</body>
</html>