<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="This is a fully functioning signup and login system provided free of charge by Andreas Neil Jensen under the MIT license.">
        <title>Login System</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        
        <!-- Custom CSS -->
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <header>
            <nav class="topnav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                </ul>
                <div>
                    <?php
                        session_start();
                        if (isset($_SESSION['id'])){
                            echo '  <form action="invisible/logout.invisible.php" method="POST">
                                        <input type="submit" name="logout" value="Logout">
                                    </form>';
                        }
                        else {
                            echo '  <form action="invisible/login.invisible.php" method="POST">
                                        <input type="text" name="loginText" id="usernameInput" placeholder="Username or Email">
                                        <input type="password" name="password" id="usernameInput" placeholder="Password">
                                        <input type="submit" name="login" value="Login">
                                    </form>
                                    <ul><li><a href="signup.php">Sign up</a></li></ul>';
                        }
                    ?>
                </div>
            </nav>
        </header>