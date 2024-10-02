<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css" />

    <link rel="stylesheet" href="../CSS/admin_.css">
    <title>Contact Datas</title>
</head>

<body>
    <h3 class="desc">Datas recieved from the contact form in the home page.</h3>
    <br>
    <?php
    // Include database connection file
    include "db.php";

    // Function to delete record from the database
    function deleteRecord($conn, $SN)
    {
        $sql = "DELETE FROM contact_datas WHERE SN = $SN";
        if (mysqli_query($conn, $sql)) {
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
            echo "<script>window.location.href = 'contact_datas.php';</script>";
            exit;
        } else {
            echo "<script>alert('Failed to delete record!');</script>";
        }
    }

    // Fetch all data from the database table
    $sql = "SELECT * FROM contact_datas";
    $result = mysqli_query($conn, $sql);

    // Check if any data exists
    if (mysqli_num_rows($result) > 0) {
        // Output table header
        echo "<table border='0' cellspacing='0'>";
        echo "<tr><th>Id</th><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Action</th></tr>";

        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr id='" . urldecode($row["SN"]) . "'>";
            echo "<td>" . urldecode($row["SN"]) . "</td>";
            echo "<td>" . urldecode($row["Name"]) . "</td>";
            echo "<td>" . urldecode($row["Email"]) . "</td>";
            echo "<td>" . urldecode($row["Phone"]) . "</td>";
            echo "<td>" . urldecode($row["Message"]) . "</td>";
            echo "<td><a href='?delete_id=" . $row["SN"] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'><button class='del'>Delete</button></a>&nbsp;&nbsp;&nbsp;<a onclick='expand(" . $row["SN"] . ")'><button class='show'>Expand</button></a></td>";
            echo "</tr>";
        }

        // Close table
        echo "</table>";
    } else {
        echo "No data found.";
    }

    // Close database connection
    mysqli_close($conn);
    ?>
    <script>
           document.querySelectorAll(".show").forEach(x => {
        x.click()
    });
        function expand(id_) {
            elem = document.getElementById(JSON.stringify(id_));
            arr_ = elem.children;

            for (let x of arr_) {
                if (x.style.whiteSpace == "nowrap") {
                    x.style.whiteSpace = "normal";
                }
                else {
                    x.style.whiteSpace = "nowrap";
                }
            }
        }
    </script>

</body>

</html>