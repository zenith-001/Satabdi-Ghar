<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css" />
    <link rel="stylesheet" href="../CSS/admin_.css">
    <link rel="stylesheet" href="../CSS/admin_.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css" />
    <title>Contact Datas</title>
</head>

<body>
<h2 class="desc">List of events listed on the site.</h2>

    <?php
    // Include database connection file
    include "db.php";

    // Function to delete record from the database
    function deleteRecord($conn, $id)
    {

        $sql = "DELETE FROM events_list WHERE ID = $id";
        if (mysqli_query($conn, $sql)) {
            echo "Deleting...";
            $folder_path = "../db_images/events/$id";

            // Delete the associated folder and its contents
            if (is_dir($folder_path)) {
                // Use recursive deletion to delete folder and its contents
                $success = deleteDir($folder_path);
                if ($success) {
                    echo "Folder and its contents deleted successfully.";
                } else {
                    echo "Failed to delete folder and its contents.";
                }
            } else {
                echo "Folder does not exist.";
            }
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }

    }

    // Check if a record deletion is requested
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        if (deleteRecord($conn, $delete_id)) {
            echo "<script>alert('Record deleted successfully!');</script>";
            // Refresh the page or redirect to update the view
            echo "<script>window.location.href = 'manage_events.php';</script>";
            exit;
        } else {
            echo "<script>alert('Failed to delete record!');</script>";
        }
    }

    // Fetch all data from the database table
    $sql = "SELECT * FROM events_list";
    $result = mysqli_query($conn, $sql);

    // Check if any data exists
    if (mysqli_num_rows($result) > 0) {
        // Output table header
        echo "<table border='0'>";
        echo "<tr><th>Title</th><th>Date</th><th>Description</th><th>Resources</th><th>Total Files</th><th>Action</th></tr>";

        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr id='".$row["ID"]."'>";
            echo "<td>" . urldecode($row["Title"]) . "</td>";
            echo "<td>" . $row["Date"] . "</td>";
            echo "<td>" . urldecode($row["Description"]) . "</td>";
            echo "<td>" . $row["Resources"] . "</td>";
            echo "<td>" . $row["Resources_Index"] . "</td>";
            echo "<td><a href='?delete_id=" . $row["ID"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'><button class='del'>Delete</button></a>&nbsp;&nbsp;&nbsp;<a onclick='expand(" . $row["ID"] . ",this)'><button class='show'>Expand</button></a></td>";
            echo "</tr>";
        }

        // Close table
        echo "</table>";
    } else {
        echo "No data found.";
    }
    function deleteDir($dirPath) {
        if (!is_dir($dirPath)) {
            return false;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
        return true;
    }
    // Close database connection
    mysqli_close($conn);
    ?>
    <script>
           document.querySelectorAll(".show").forEach(x => {
        x.click()
    });
        function expand(id_,z) {
            elem = document.getElementById(JSON.stringify(id_));
            arr_ = elem.children;
            // console.log([typeof (arr_), elem.children.constructor.name]);
            // arr_.forEach(x => {
               
            // });

            for (let x of arr_) {
                if (x.style.whiteSpace == "nowrap") {
                    x.style.whiteSpace = "normal";
                    z.querySelector("button").innerText = "Retract"
                }
                else {
                    x.style.whiteSpace = "nowrap";
                    z.querySelector("button").innerText = "Expand"
                }
            }
        }
    </script>
</body>

</html>