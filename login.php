<?php
session_start();

if ( isset( $_SESSION['email'] ) ) {
    header( 'Location: index.php' );
}

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

$error = "";

$emails = [];
$passwords = [];
$roles = [];

$fp = fopen( "./data.txt", "r" );

while ( $line = fgets( $fp ) ) {
    $value = explode( ",", $line );

    array_push( $emails, trim( $value[1] ) );
    array_push( $passwords, trim( $value[2] ) );
    array_push( $roles, trim( $value[3] ) );

}
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    for ( $i = 0; $i < count( $roles ); $i++ ) {

        if (  ( $email == $emails[$i] ) && ( $password == $passwords[$i] ) ) {
            $_SESSION["email"] = $emails[$i];
            $_SESSION["role"] = $roles[$i];

            header( "Location: index.php" );
        } else {
            $error = "Wrong Email and Password";
        }
    }
}
?>

<html>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

<body>
<div class="container">

    <div class="" style="padding-top: 32px;">
        <h3>User Authentication and Role Management System</h3>
    </div>
    <hr>

    <div class="row">
        <div class="column column-25">
            Login
        </div>
        <div class="column column-75">

            <form action="" method="POST">
                <fieldset>

                    <label for="email">Email</label>
                    <input type="email" placeholder="Email" id="email" name="email" required>

                    <label for="password">Password</label>
                    <input type="password" placeholder="Password" id="password" name="password" required>

                    <p style="color: red;">
                    <?php
if ( isset( $error ) ) {echo $error;}
?>
                    </p>

                    <p>Don't have account <a href="signup.php">Sign Up</a></p>

                    <input class="button-primary" type="submit" value="Login">
                </fieldset>
            </form>

        </div>
    </div>

</div>
</body>
</html>