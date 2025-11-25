<?php

$memberKey = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
session_start();

$errorMessage = "";

$formSubmitted = isset($_POST["hidden"]);

$txtUsername = $_POST["txtUsername"];
$txtEmail = $_POST["txtEmail"];
$txtPassword = $_POST["txtPassword"];
$txtPassword2 = $_POST["txtPassword2"];
$cboRole = $_POST["cboRole"];


$ADMIN_ID = 3;

if (!isset($_SESSION["memberID"]) || $_SESSION['roleID'] != $ADMIN_ID) {
    header("Location: /login");
}

if ($formSubmitted) {
    if ($txtPassword != $txtPassword2) {
        $errorMessage = "Your password must match verify password.";
    } // todo: check username, email, etc... (separate else-if's)
    else {
        include "../includes/db.php";
        $con = getDBConnection();


        try {
            $hashedPassword = md5($txtPassword . $memberKey);
            $query = "INSERT INTO members (memberName, memberEmail, memberPassword, memberKey, roleID) VALUES (?, ?, ?, ?, ?);";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sssss", $txtUsername, $txtEmail, $hashedPassword, $memberKey, $cboRole);
            mysqli_stmt_execute($stmt);

            $txtUsername = "";
            $txtEmail = "";
            $txtPassword = "";
            $txtPassword2 = "";
            $cboRole = "";

        } catch (mysqli_sql_exception $ex) {
            //echo $ex;
            $errorMessage = $ex;
        }
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
    <link rel="stylesheet" href="css/grid.css">
    <style>
        .grid-container {
            grid-template-areas:
                "grid-header grid-header"
                "username username-input"
                "email email-input"
                "password password-input"
                "password2 password-input2"
                "role role-input"
                "error-message error-message"
                "grid-footer grid-footer"
        ;

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
        <form method="post">
            <div class="grid-container">

                <div class="grid-header">
                    <h3>Add new member</h3>
                </div>

                <div class="username">
                    <label for="txtUsername">Username</label>
                </div>

                <div class="username-input">
                    <input type="text" name="txtUsername" id="txtUsername" value="<?=$txtUsername?>">
                </div>
                <div class="email">
                    <label for="txtEmail">Email</label>
                </div>

                <div class="email-input">
                    <input type="text" name="txtEmail" id="txtEmail" value="<?=$txtEmail?>">
                </div>

                <div class="password">
                    <label for="txtPassword">Password</label>
                </div>

                <div class="password-input">
                    <input type="password" name="txtPassword" id="txtPassword" value="<?=$txtPassword?>">
                </div>
                <div class="password2">
                    <label for="txtPassword2">Verify Password</label>
                </div>

                <div class="password-input2">
                    <input type="password" name="txtPassword2" id="txtPassword2" value="<?=$txtPassword?>">
                </div>
                <div class="role">
                    <label for="cboRole">Role</label>
                </div>

                <div class="role-input">
                   <select id="cboRole" name="cboRole">
                       <?php
                       include "../includes/db.php";
                       $con = getDBConnection();
                       $result = mysqli_query($con, "SELECT * FROM roles");

                       while ($row = mysqli_fetch_array($result)) {

                           $runner = $row["RunnerID"];
                           $promoter = $row["PromoterID"];
                           $admin = $row["AdminID"];


                           echo " <option>$runner</option>";
                           echo " <option>$promoter</option>";
                           echo " <option>$admin</option>";

                       }

                       ?>

                   </select>
                </div>

                <div class="error <?php echo $errorMessage == "" ? "hidden" : "" ?>">
                    <p><?=$errorMessage;?></p>
                </div>

                <div class="grid-footer">
                    <input type="hidden" value="hidden" name="hidden" id="hidden">
                    <input type="submit" value="Add Member">
                </div>


            </div>
        </form>
    </main>
</div>
<?php
include "../includes/footer.php";
?>
</body>
</html>


