<!-- upload_project/upload.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directory to save uploaded files
    $uploadDir = 'uploads/';
    // Create uploads directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Create a new zip archive
    $zip = new ZipArchive();
    $zipFileName = $uploadDir . 'uploads_' . time() . '.zip';

    if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
        die("Could not open archive");
    }

    // Loop through each file uploaded
    foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
        // Get the original file name
        $fileName = $_FILES['files']['name'][$key];

        // Get the path of the uploaded file
        $relativePath = $fileName;

        // Add the file to the zip archive while preserving the directory structure
        if (is_uploaded_file($tmpName)) {
            $zip->addFile($tmpName, $relativePath);
        }
    }

    // Close the zip archive
    $zip->close();

    echo "Files have been uploaded and compressed into: <a href='$zipFileName'>$zipFileName</a>";
} else {
    echo "No files uploaded.";
}
?>
