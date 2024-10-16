<!-- upload_project/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
</head>
<body>
    <h1>Upload Files and Folders</h1>
    <form action="uppload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="files[]" multiple webkitdirectory mozdirectory />
        <br>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
