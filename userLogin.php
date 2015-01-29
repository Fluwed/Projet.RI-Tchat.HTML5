<?php
    $username=$_POST['username'];
    $password=$_POST['password'];
    $remember=$_POST['remember'];

    require("connectdb.php");
    $query = "SELECT * FROM Auteurs WHERE user='".$username."'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    mysqli_free_result($result) or die(mysqli_error($link));
    mysqli_close($link) or die(mysqli_error($link));
?>
