<?php
session_start();

if ( isset( $_SESSION['email'] ) ) {
    header( 'Location: index.php' );
}

$username = $_POST["name"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";
$user = "user";

$sanitizedUserInput = htmlspecialchars( $username, FILTER_SANITIZE_SPECIAL_CHARS );

$userDetail = [$sanitizedUserInput, $email, $password, $user];
$dataString = implode( ",", $userDetail );

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    if ( isset( $_POST["signup"] ) ) {

        $fp = fopen( './data.txt', 'a' );
        fwrite( $fp, $dataString . "\n" );
        fclose( $fp );

        header( "Location: login.php" );
    }

}
?>
<!DOCTYPE html>
<html lang="en">

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
            Sign Up
            <br>

        </div>
        <div class="column column-75">

            <form action="" method="POST" >
                <fieldset>
                    <label for="name">Username</label>
                    <input type="text" placeholder="Name" id="name" name="name" required>

                    <label for="email">Email</label>
                    <input type="email" placeholder="Email" id="email" name="email" required>

                    <label for="password">Password</label>
                    <input type="password" placeholder="Password" id="password" name="password" required>

                    <p>Have account <a href="login.php">Login Here</a></p>

                    <input class="button-primary" type="submit" name="signup" value="Sign Up">
                </fieldset>
            </form>

        </div>
    </div>

</div>
</body>
</html>