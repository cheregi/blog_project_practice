<?php
include 'dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name=$_POST['name'];
    $username=$_POST['user'];
    $email=$_POST['email'];
    $password=$_POST['pass'];

    $insertQuery='INSERT INTO users (name, username, email, password) VALUES (:abc, :def, :ghi, :jkl)';

    $stmt = $connection->prepare($insertQuery);
    $stmt->bindParam(':abc', $name);
    $stmt->bindParam(':def', $username);
    $stmt->bindParam(':ghi', $email);
    $stmt->bindParam(':jkl', $password);
    $stmt->execute();

    header("Location: login.php");

}

?>

<div>
    <h2>Register</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

        <label>Name:</label>
        <input type="text" name="name" value=""><br>

        <label>Username:</label>
        <input type="text" name="user" value=""><br>

        <label>Email:</label>
        <input type="text" name="email" value=""><br>

        <label>Password:</label>
        <input type="password" name="pass"><br>

        <input type="submit" value="Register">

    </form>
</div>

