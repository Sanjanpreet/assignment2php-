<?php
 include 'config.php';
 echo $ID = $_GET['Id'];
 mysqli_query($con, "DELETE FROM `phpchart` WHERE Id = $ID ");

 header('location:index.php');




?>