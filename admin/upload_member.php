<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "db.php";
 
    $blogdir = "../db_images/members/";
    if (!file_exists($blogdir)) {
        mkdir($blogdir, 0777, true);
        chmod($blogdir, 0777);
    }
    // Check if the form was submitted and an image was uploaded
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
        // Directory where images will be stored
        $targetDir = $blogdir . "res/";

        // Create the uploads directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Get the uploaded image details
        $name = $_FILES["image"]["name"];
        $tmp_name = $_FILES["image"]["tmp_name"];
        $imageFileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        // Generate a unique filename for the image (3-digit random number)
        $randomNumber = rand(100, 999); // Generate a random 3-digit number
        $targetFile = $targetDir . $randomNumber . "." . $imageFileType;

        // Check if file is an actual image
        $check = getimagesize($tmp_name);
        if ($check !== false) {
            // Allow certain file formats
            if ($imageFileType === "jpg" || $imageFileType === "png" || $imageFileType === "jpeg" || $imageFileType === "gif") {
                // Attpt to move uploaded file to designated folder
                if (move_uploaded_file($tmp_name, $targetFile)) {
                    echo "The file " . basename($name) . " has been uploaded.<br>";
                    // Remove "../" from the image path
                    $image = substr($targetFile, 3);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        echo "No file was uploaded.";
    }
    $name = filter_var($_REQUEST['name'],FILTER_SANITIZE_ENCODED);
    $role = filter_var($_REQUEST['role'],FILTER_SANITIZE_ENCODED);
    $phone = filter_var($_REQUEST['phone'],FILTER_SANITIZE_ENCODED);
    $location = filter_var($_REQUEST['location'],FILTER_SANITIZE_ENCODED);
    $special = filter_var($_REQUEST['special'],FILTER_SANITIZE_ENCODED);
    // Insert record into database
    $sql = "INSERT into members_list (`Name`,`Role`,`Phone`,`Location`,`Image`,`Special`) VALUES ('$name','$role','$phone','$location','$image','$special')";
    $request = mysqli_query($conn, $sql);
    if ($request) {
        $status = "Successful";
    } else {
        $status = "Error: " . mysqli_error($conn);
        echo $status;
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css" />
    <link rel="stylesheet" href="../CSS/admin_.css">
    <link rel="stylesheet" href="../CSS/form_design.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css" />
    <title>Contact Datas</title>
</head>

<body>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <h3 class="desc">Write content to be published as a event in the events page.</h3>
    <br>
    <form action="upload_member.php" method="POST" enctype="multipart/form-data">
        Name:<br>
        <input maxlength="25" minlength="5" required placeholder="Name" type="text" name="name"><br><br>
        Role:<br>
        <input maxlength="25" minlength="5" required placeholder="Role" type="text" name="role"><br><br>
        Phone:<br>
        <input maxlength="25" minlength="5" required placeholder="Phone" type="text" name="phone"><br><br>
        Location:<br>
        <input maxlength="25" minlength="5" required placeholder="Location" type="text" name="location"><br><br>
        Special: <br>
        <input maxlength="1" max="1" min="0" required placeholder="Special" type="number" name="special"><br><br>
        Profile Image: <br>
        <!-- <label for="file">Upload Files</label> -->
        <input required id="file" type="file" name="image" accept="images/*"><br><br>
        <input type="submit" value="Submit">
        <div class="status">
            <?php
            if (isset($status)) {
                echo $status;
            }
            ?>
        </div>
    </form>
</body>

</html>
