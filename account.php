<?php
include 'dbconnect.php';
session_start();
$_SESSION['logedin']=true;
$_SESSION['name']='diana';
if(isset($_SESSION['logedin'])&& $_SESSION['logedin']==true) {
    echo '<h2>welcome '.$_SESSION['name'].'!</h2>';
}else{
   header("Location: login.php");
}


//FillIn SQL //////////////////////
$SQL = $connection->prepare('SELECT * FROM posts LEFT JOIN pictures on pictures.post_id=posts.id WHERE posts.user_id=2');
$SQL->execute();
$SQL->setFetchMode(PDO::FETCH_ASSOC);
//print_r($SQL->rowCount());
$result = $SQL->fetchAll();


if (isset($_SESSION['logedin'])) {
    if ($_SESSION["logedin"] == true){
        echo "<div class='row'><p><a href='post.php'> new.php</a> </p></div>";
    }

}

for ($count = 0; $count < count($result); $count++) {
    //////////////////****************
    echo "<div class='row'>";
    if(is_array($result[$count]) == true ) {

        echo"<a href='account.php?id=".$result[$count]['id']."'><h1>".$result[$count]['title']."</h1></a>";
        echo'<p>'.$result[$count]['body'].'</p>';


    if(isset($result[$count]['path'])){

        echo'<img src="'.$result[$count]['path'].'"</img>';

    }
    }
    echo "</div>";
}



