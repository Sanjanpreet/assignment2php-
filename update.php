<?php
include 'config.php';

if (isset($_POST['update'])) {
    $ID = $_POST['Id'];
    $NAME = $_POST['name'];
    $PRICE = $_POST['price'];
    $IMAGE = $_FILES['image'];
    
    // Handle image upload
    $img_loc = $_FILES['image']['tmp_name'];
    $img_name = $_FILES['image']['name'];
    $img_des = "uploadImage/".$img_name;
    if (!empty($img_name)) {
        move_uploaded_file($img_loc, $img_des);
        $query = "UPDATE `phpchart` SET `Name`='$NAME', `Price`='$PRICE', `Image`='$img_des' WHERE `Id`=$ID";
    } else {
        $query = "UPDATE `phpchart` SET `Name`='$NAME', `Price`='$PRICE' WHERE `Id`=$ID";
    }

    if (mysqli_query($con, $query)) {
        header("location: index.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}

if (isset($_GET['Id'])) {
    $ID = $_GET['Id'];
    $Record = mysqli_query($con, "SELECT * FROM `phpchart` WHERE Id = $ID");
    $data = mysqli_fetch_array($Record);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        input {
            margin: 10px;
        }
    </style>
</head>
<body>
<center>
    <div class="main">
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="">Name</label>
            <input type="text" value="<?php echo $data['Name'] ?>" name="name"><br>
            <label for="">Price</label>
            <input type="text" value="<?php echo $data['Price'] ?>" name="price" id=""><br>
            <label for="">Image:</label>
            <input type="file" name="image">
            <img src="<?php echo $data['Image'] ?>" width="200px" height="70px" alt=""><br>
            <input type="hidden" name="Id" value="<?php echo $data['Id'] ?>">
            <button type="submit" name="update" class='btn btn-danger m-2'>Update</button>
        </form>
    </div>
</center>
</body>
</html>
