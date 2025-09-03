<?php
include "db.php";
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql=$conn->prepare("delete from blogs where id=?;");
    $sql->bind_param('i',$id);
    $sql->execute();
    header("Location:dashboard.php");
}


?>