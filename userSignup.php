<?php
    $username=$_POST['username'];
    $passwd=$_POST['passwd'];
    $passwd2=$_POST['passwd2'];

    if ($passwd != $passwd2) {
        
    }
    else {
        require("connectdb.php");
        $query = "INSERT INTO Auteurs (user, password) VALUES ('".$username."','".$passwd."')";
        echo $query;
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        mysqli_free_result($result) or die(mysqli_error($link));
        mysqli_close($link) or die(mysqli_error($link));
    }
    echo "<form action='index.php' method='post'>";
?>
