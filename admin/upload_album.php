<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "db.php";
    $title = filter_var($_REQUEST['title'], FILTER_SANITIZE_ENCODED);
    $date = $_REQUEST['date'];
    $identity = $_REQUEST['identity'];
    $content = filter_var($_REQUEST['content'], FILTER_SANITIZE_ENCODED);
    $blogdir = "../db_images/album/$identity";
    if (!file_exists($blogdir)) {
        mkdir("../db_images/album/" . $identity, 0777, true);
        mkdir("../db_images/album/" . $identity."/res", 0777, true);
        chmod($blogdir, 0777);
        chmod($blogdir."/res", 0777);
    }
    $xxx= "";
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["images"])) {
        // Directory where images will be stored
        $targetDir = "$blogdir/res/";
        $xxx = "$blogdir/res";
            
        // Create the uploads directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Counter for renaming images
        $counter = 1;

        // Loop through each uploaded file
        foreach ($_FILES["images"]["tmp_name"] as $key => $tmp_name) {
            $name = $_FILES["images"]["name"][$key];
            $targetFile = $targetDir . $counter . "." . pathinfo($name, PATHINFO_EXTENSION);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if file already exists
            if (file_exists($targetFile)) {
                echo "Sorry, file already exists.";
            } else {
                // Check if file is an actual image
                $check = getimagesize($tmp_name);
                if ($check !== false) {
                    // Allow certain file formats
                    if ($imageFileType === "jpg" || $imageFileType === "png" || $imageFileType === "jpeg" || $imageFileType === "gif") {
                        // Attempt to move uploaded file to designated folder
                        if (move_uploaded_file($tmp_name, $targetFile)) {
                            echo "The file " . basename($name) . " has been uploaded as " . $counter . "." . $imageFileType . "<br>";
                            $counter++; // Increment counter for the next file
                        } else {    
                            echo "Sorry, there was an error uploading your file.";
                        }
                    } else {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    }
                } else {
                    echo "File is not an image.";
                }
            }
        }
    } 
    else {
        echo "No files were uploaded.";
    }
    $files = scandir($xxx);
    $totalFiles = count($files) - 2;
    $sql = "INSERT into gallery_albums (`Title`,`ID`,`Date`,`Description`,`Resource`,`Resources_Index`) VALUES ('$title','$identity','$date','$content','$targetDir','$totalFiles')";
    $request = mysqli_query($conn, $sql);
    if ($request) {
        $status = "Successful";
    } else {
        $status = ("Error" . (mysqli_error($conn)));
        echo $status;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../CSS/admin_.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css" />
    <link rel="stylesheet" href="../CSS/form_design.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css" />
    <title>Contact Datas</title>
</head>

<body>
    <!-- <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script> -->
    <h2 class="desc">Upload images for the gallery page.</h2>
    <br>
    <form action="upload_album.php" method="POST" enctype="multipart/form-data">
        Album Title:<br>
        <input maxlength="55" minlength="5" required placeholder="Album Title" type="text" name="title"><br><br>
        Album Images:<br>
        <input required id="file" type="file" name="images[]" accept="images/*" multiple><br><br>
        Content:<br>
        <input type="hidden" name="date">
        <input type="hidden" name="identity">
        <textarea minlength="10" maxlength="250" required placeholder="Content" type="text"
            name="content"></textarea><br><br>
        <input type="submit" value="Submit">
        <div class="status">
            <?php
            if (isset($status)) {
                echo $status;
            }
            ?>
        </div>
        <script>
            x = new Date()
            document.getElementsByName("date")[0].value = `${x.getUTCFullYear()}/${x.getUTCMonth() + 1}/${x.getUTCDate()}`
            document.getElementsByName("identity")[0].value = Date.now();
        </script>
    </form>
</body>

</html>