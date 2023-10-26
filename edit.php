<?php
session_start();

if ( !isset( $_SESSION["role"] ) || $_SESSION["role"] != "admin" ) {
    header( "Location: login.php" );
}

$usernames = [];
$emails = [];
$passwords = [];
$roles = [];
$id = $_GET["id"] - 1;

$fp = fopen( "./data.txt", "r" );

while ( $line = fgets( $fp ) ) {
    $value = explode( ",", $line );

    array_push( $usernames, trim( $value[0] ) );
    array_push( $emails, trim( $value[1] ) );
    array_push( $passwords, trim( $value[2] ) );
    array_push( $roles, trim( $value[3] ) );

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
        <h2>User Authentication and Role Management System</h2>
    </div>
    <hr>

    <div class="row">
        <div class="column column-25">
            <?php echo $_SESSION["email"]; ?> | <a href="logout.php">Logout</a>
        </div>
        <div class="column column-75">
            <h4>Admin Panel</h4>

            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>

                    </tr>
                </thead>
                <tbody>
                    <?php //for ( $i = 0; $i < count( $roles ); $i++ ) {?>
                    <tr>
                        <td><?php echo "$usernames[$id]"; ?></td>
                        <td><?php echo "$emails[$id]"; ?></td>
                        <td><?php echo "$roles[$id]"; ?></td>
                    </tr>
                    <?php //}?>
                </tbody>
            </table>


            <form action="" method="POST">
                <fieldset>


                    <label for="name">Username</label>
                    <input type="text" placeholder="Name" id="name" name="name" value="<?php echo "$usernames[$id]"; ?>" required>

                    <label for="email">Email</label>
                    <input type="email" placeholder="Email" id="email" name="email" value="<?php echo "$emails[$id]"; ?>" required>

                    <label for="role">Role: Current role :<?php echo "$roles[$id]"; ?></label>
                    <select id="roleID" name="roleSelect">
                        <option name="admin" value="admin">Admin</option>
                        <option name="manager" value="manager">Manager</option>
                        <option name="user" value="manager">User</option>
                    </select>
                    <input class="button-primary" type="submit" name="update" value="Update">
                </fieldset>
            </form>

        </div>
    </div>

</div>
</body>
</html>