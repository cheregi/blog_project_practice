<?php

include 'dbconnect.php';
    if(isset($_SESSION['logedin'])&& $_SESSION['logedin']==true) {
        header("Location: account.php");
    }else{
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = $_POST['user'];
            $password = $_POST['pass'];

            $query = "SELECT * FROM users WHERE username=:qwe";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':qwe', $username);
            $stmt->execute();

            $result = $stmt->fetch();

            if ($result['username']) {
                if ($password == $result['password']) {
                    session_start();
                    $_SESSION['logedin'] = true;
                    $_SESSION['name'] = $result['name'];

                    header("Location: account.php");
                }
            }


        }
    }


?>

<div>
    <h2>Login</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

        <label>Username:</label>
        <input type="text" name="user" value=""><br>

        <label>Password:</label>
        <input type="password" name="pass"><br>

        <input type="submit" value="Login">

    </form>
</div>


