<?php
if (isset($_POST['login'])){
    require 'database.invisible.php';    

    $loginText = $_POST['loginText'];
    $password = $_POST['password'];

    // Field Validation.
    // Please no empty fields.
    if (empty($loginText) || empty($password)){
        header("Location: ../index.php?error=emptyFieldsDetected");
        exit();
    }
    else {
        // The query for the database.
        $query = "SELECT * FROM users WHERE username = ? OR email = ?";

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
            mysqli_stmt_bind_param($statement, "ss", $loginText, $loginText);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            // Get the first row of the results.
            if ($row = mysqli_fetch_assoc($result)){
                // Verify password.
                $passwordCheck = password_verify($password, $row['password']);
                if ($passwordCheck != true){
                    // Wrong password provided.
                    header("Location: ../index.php?error=wrongLoginInformationProvided");
                    exit();
                }
                else {
                    // Yay, login succeded, store id, email and username in session memory.
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
            else {
                // No such username/email found.
                header("Location: ../index.php?error=wrongLoginInformationProvided");
                exit();
            }
        }
    }
}
else {
    header("Location: ../index.php");
    exit();
}
?>