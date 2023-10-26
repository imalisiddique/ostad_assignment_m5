<?php
session_start();

if ( !isset( $_SESSION["role"] ) || $_SESSION["role"] != "manager" ) {
    header( "Location: login.php" );
}

$error = "";

$usernames = [];
$emails = [];
$passwords = [];
$roles = [];
$id = [];
$fp = fopen( "./data.txt", "r" );
$counter = 1;
while ( $line = fgets( $fp ) ) {
    $value = explode( ",", $line );
    array_push( $id, $counter );
    array_push( $usernames, trim( $value[0] ) );
    array_push( $emails, trim( $value[1] ) );
    array_push( $passwords, trim( $value[2] ) );
    array_push( $roles, trim( $value[3] ) );
    $counter++;
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
            <?php echo $_SESSION["email"]; ?> | <a href="logout.php">Logout</a>
        </div>
        <div class="column column-75">
            <h4>Manager Panel</h4>

            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ( $i = 0; $i < count( $roles ); $i++ ) {?>
                    <tr>
                        <td><?php echo "$usernames[$i]"; ?></td>
                        <td><?php echo "$emails[$i]"; ?></td>
                        <td><?php echo "$roles[$i]"; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $id[$i]; ?>">Edit</a>
                        </td>

                    </tr>
                    <?php }?>
                </tbody>
            </table>


        </div>
    </div>

</div>
</body>
</html>