<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css" />

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="CSS/gallery.css" />
    <title>Kushma Art Project | Gallery</title>
</head>

<body>
    <div onmouseover="hovering(this)" onmouseleave="stopped(this)" class="left-portion">
        <div class="logo">
            <img src="images/logo.webp" alt="" height="60px" />
        </div>
        <div class="nav_">
            <div class="pointer"></div>
            <div onclick="klick(this)" class="item_ active">
                <i class="fa-duotone fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="text_">Home</span>
            </div>
            <div onclick="klick(this)" class="item_">
                <i class="fa-duotone fa-address-card"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="text_">About</span>
            </div>
            <div onclick="klick(this)" class="item_">
                <i class="fa-duotone fa-circle-dollar"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="text_">Donate</span>
            </div>
            <div onclick="klick(this)" class="item_ kick">
                <i class="fa-duotone fa-images"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="text_">Gallery</span>
            </div>
            <div onclick="klick(this)" class="item_">
                <i class="fa-duotone fa-phone"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="text_">Contact</span>
            </div>
        </div>
    </div>
    <div class="right-portion">
        <div class="nav">
            <div class="lab">
                <?php
                include "admin/db.php";

                echo urldecode(mysqli_fetch_array(mysqli_query($conn, "SELECT Title FROM `gallery_albums` where ID = " . $_GET["id"] . ""))[0]);
                ?>
            </div>

            <div class="content">
                <a href="gallery.php" style="color:black;text-decoration:none;font-size:20px;"><i class="fa fa-arrow-left"></i> Go Back</a>
            </div>
        </div>
        <div class="main">
            <?php
            if (isset($_GET["id"])) {
                $result = mysqli_query($conn, "SELECT * FROM `gallery_albums` where ID = " . $_GET["id"] . "");
                while ($row = mysqli_fetch_array($result)) {
                    $array[] = $row;
                }
                echo "<h3 style='margin-left:30px; color:grey;'>".urldecode($array[0]["Description"])."</h3>";
                $count = $array[0]["Resources_Index"];
                // print_r($array);
                echo "\n\n\n<section>";
                $folder = substr($array[0]["Resource"], 3);
                $files = scandir($folder);

                // Remove '.' and '..' from the list
                $files = array_diff($files, array('.', '..'));
                $i = 0;
                foreach ($files as $file) {
                    $c = $i + 1;
                    // $row = $array[0][$i];
                    $ff = $folder . $file;
                    echo "<div class='card' onclick='location.href=`" . $ff . "`'>\n";
                    echo "<div class='card__img'>\n";
                    echo "<img src='$ff'>\n";
                    echo "</div>\n";
                    echo "</div>\n";
                    $array[$i] = $row;
                    if (($c % 6 == 0) && $i != 0) {
                        echo "</section>\n\n\n";
                        echo "\n\n\n<section>";
                    }
                    if ($c == $count) {
                        echo "\n\n\n</section>";
                    }
                    $i++;
                }
            }

            ?>
        </div>
    </div>


</body>

<script>
    x = 20;
    for (let i = 0; i < 10; i++) {
        x += 37;
    }
    document.querySelector(".kick").click();
    function klick(x) {
        c = 0;
        document.querySelectorAll(".item_").forEach((z) => {
            z.classList.remove("active");
            if (z == x) {
                v = c;
            }
            c++;
        });

        document.querySelector(".pointer").style.opacity = 1;
        document.querySelector(".pointer").style.top = 41 + v * 37 + "px";
        x.classList.add("active");
        fram = document.querySelector(".iframe_");
        if (v == 0) {
            location.href = "index.php";
        } else if (v == 1) {
            location.href = "index.php#about";
        } else if (v == 2) {
            location.href = "donate.html";
        } else if (v == 3) {
            // location.href = "gallery.html";
        } else if (v == 4) {
            location.href = "index.php#contact";
        }
    }

    function hovering(x) {
        document.querySelector(".left-portion").style.width = "23vw";
        document.querySelector(".right-portion").style.width = "77vw";
        setTimeout(() => {
            document.querySelectorAll(".text_").forEach((z) => {
                z.style.display = "inline-block";
            });
            document.querySelector(".logo").querySelector("img").style.height = "60px"
        }, 100);
    }

    function stopped(x) {
        document.querySelector(".left-portion").style.width = "5vw";
        document.querySelector(".right-portion").style.width = "95vw";
        setTimeout(() => {
            document.querySelectorAll(".text_").forEach((z) => {
                z.style.display = "none";
            });
            document.querySelector(".logo").querySelector("img").style.height = "30px"
        }, 100);
    }
</script>

</html>