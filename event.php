<!DOCTYPE html>
<html lang="en">
    
    <head>
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />
        <link rel="stylesheet" href="./CSS/blog.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            div.gallery {
            border: 1px solid #ccc;
        }
        
        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }

        .responsive * {
            box-sizing: border-box;
        }

        .responsive {
            padding: 0 6px;
            float: left;
            width: 24.99999%;
        }

        @media only screen and (max-width: 700px) {
            .responsive {
                width: 49.99999%;
                margin: 6px 0;
            }
        }
        
        @media only screen and (max-width: 500px) {
            .responsive {
                width: 100%;
            }
        }
        
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }
        .content{
            padding: 50px;
        }
    </style>
    <title>Kushma Art Project | Events</title>
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
</head>

<body>
    <!-- <script>location.href = location.href.split("?")[0];</script> -->
    <div class="nav">
        <img src="./images/tralogo.webp" class="logo">

        <div class="right">
            <a href="events.php" class="nav-items"><i class="fa-solid fa-calendar"></i> &nbsp; Events</a>
            <br><br>
        </div>
    </div>

    <?php
    include "admin/db.php";
    if (isset($_GET['id'])) {
        echo "<div class='content'>";
        $result = mysqli_query($conn, "SELECT * FROM events_list where ID = " . $_GET['id'] . "");
        $row = mysqli_fetch_array($result);
        $date = urldecode($row["Date"]);
        echo "<h1 style='text-align:left;'>" . urldecode($row["Title"]) . "</h1>\n";
        echo "<h3><i class='fa fa-calendar'></i>&nbsp;&nbsp;$date</h3>\n";
        echo "<p>" . urldecode($row['Description']) . "</p>\n";
        $folder = substr($row["Resources"], 3);
        $files = scandir($folder);

        // Remove '.' and '..' from the list
        $files = array_diff($files, array('.', '..'));

        // Now $files contains an array of filenames in the folder
        foreach ($files as $f) {
            $file = $folder . $f;
            echo "<div class='responsive'>\n";

            echo "<div class='gallery'>\n";

            echo "<a target='_blank' href='$file'>\n";

            echo "<img src='$file' alt='$file' width='600' height='400'>\n";

            echo "</a>\n";
            echo "</div>\n";
            echo "</div>\n";
        }
        echo"</div>";

    } else {
        header("location:events.php");
    }
    ?>

    <script src="JS/searcher.js"></script>
    <div class="footer">
        <p class="text">&copy; &nbsp;All rights reserved. kushma art project</p>
    </div>
</body>

</html>