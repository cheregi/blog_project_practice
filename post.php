<?php

include 'dbconnect.php';
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST') {


    $uname = "qaz";
    $stmt = $connection->prepare('SELECT id FROM users WHERE username=:USERNAME');
    $stmt->bindParam(':USERNAME', $uname, PDO::PARAM_STR);
    if (!$stmt->execute()) {
        print_r($stmt->errorInfo());
    }
    $userId = $stmt->fetchColumn();

    $stmt = $connection->prepare('INSERT INTO posts(title, body, user_id) VALUES (:TITLE, :BODY, :USERID)');
    $stmt->bindParam(':TITLE', $_POST["title"], PDO::PARAM_STR);
    $stmt->bindParam(':BODY', $_POST["body"], PDO::PARAM_STR);
    $stmt->bindParam(':USERID', $userId, PDO::PARAM_STR);

    if (!$stmt->execute()) {
        print_r($stmt->errorInfo());
    }

    $stmt = $connection->prepare('SELECT id FROM posts WHERE title=:TITLE AND user_id=:USERID AND body=:BODY');
    $stmt->bindParam(':TITLE', $_POST["title"], PDO::PARAM_STR);
    $stmt->bindParam(':BODY', $_POST["body"], PDO::PARAM_STR);
    $stmt->bindParam(':USERID', $userId, PDO::PARAM_STR);
    if (!$stmt->execute()) {
        print_r($stmt->errorInfo());
    }
    $postId = $stmt->fetchColumn();

    if (count($_FILES) > 0) {
        $pathID = "./storage/" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $pathID);
        $stmt = $connection->prepare('INSERT INTO pictures(path, post_id) VALUES (:PATH, :POSTID)');
        $stmt->bindParam(':PATH', $pathID, PDO::PARAM_STR);
        $stmt->bindParam(':POSTID', $postId, PDO::PARAM_STR);

        echo '4';
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
        }
    }
header("Location: account.php");

}





?>
<form method="POST" action="post.php" enctype="multipart/form-data">

    <div class="title">
        <label for="title">Type here the title of your message:</label><br>
        <input  type="text" name="title" value=""/>
    </div>

    <div class="message">
        <label for="body">Add your message here:</label><br>
        <textarea name="body" rows="5" cols="40"></textarea>
    </div>

    <div class="image">
        <label for="image">Choose a file to upload for your message:</label><br>
        <input type="file" name="image"/>

    </div>
    <div class="submit">
        <button type="submit">Submit</button>
    </div>
</form>
