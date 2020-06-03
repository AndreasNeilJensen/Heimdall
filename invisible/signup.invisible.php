<?php
    // We want to make sure that the user have pressed the signup button in order to get here and didn't just type the address in the address bar.
    if (isset($_POST['signup'])){
        // Add connection information.
        require 'database.invisible.php';

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirmer = $_POST['passwordConfirmer'];

        // Field Validation.
        // Please no empty fields.
        if (empty($username) || empty($email) || empty($password) || empty($passwordConfirmer)){
            header("Location: ../signup.php?error=emptyFieldsDetected");
            exit();
        }
        // Please match the passwords.
        else if ($password != $passwordConfirmer){
            header("Location: ../signup.php?error=passwordDoesNotMatch");
            exit();
        }
        // pliz no fake emailz.
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../signup.php?error=invalidEmail");
            exit();
        }
        // Please provide a normie username.
        else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("Location: ../signup.php?error=invalidUsername");
            exit();
        }
        // Please no sql injections... please?
        else {
            // The query for the database.
            $query = "SELECT username FROM users WHERE username = ?";

            // initialize connection for prepare statement.
            // preventing any other calls except prepare.
            $statement = mysqli_stmt_init($connection);

            // run the query on the database without the parameter
            // and check if it works.
            if (!mysqli_stmt_prepare($statement, $query)){
                header("Location: ../signup.php?error=sqlError");
                exit();
            }
            // Now bind the parameter and run the prepared statement.
            else {
                mysqli_stmt_bind_param($statement, "s", $username);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $result = mysqli_stmt_num_rows($statement);

                // Check if the username already exists within the database.
                if ($result > 0){
                    header("Location: ../signup.php?error=usernameAlreadyExists");
                    exit();
                }
                else{
                    // The new query for the database.
                    $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

                    // initialize connection for prepare statement.
                    // preventing any other calls except prepare.
                    $statement = mysqli_stmt_init($connection);

                    // run the query on the database without the parameters
                    // and check if it works.
                    if (!mysqli_stmt_prepare($statement, $query)){
                        header("Location: ../signup.php?error=sqlError");
                        exit();
                    }
                    // Now bind the parameter and run the prepared statement.
                    else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPassword);
                        mysqli_stmt_execute($statement);
                        header("Location: ../signup.php?signup=success");
                    }
                }
            }
        }
        // Close the statement.
        mysqli_stmt_close($statement);
        
        // Close the connection to the database.
        mysqli_close($connection);
    }
    else{
        header("Location: ../signup.php");
        exit();
    }
?>