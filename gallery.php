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
      <div class="lab">Albums</div>

      <form class="content">
        <input type="text" name="search" placeholder="Search Here...">
        <button><i class="fa fa-search"></i></button>
      </form>
    </div>
    <div class="main">
      <?php
      include "admin/db.php";
      if (isset($_GET['search']) && $_GET['search'] !== "") {
        echo "<h3 style='margin-left:40px; color:grey;'>Search Results for " . $_GET["search"] . "</h3>";
        $result = mysqli_query($conn, "SELECT * FROM gallery_albums WHERE LOWER(Title) LIKE '%" . filter_var($_GET["search"], FILTER_SANITIZE_ENCODED) . "%' OR Title = '" . filter_var($_GET["search"], FILTER_SANITIZE_ENCODED) . "';");

        while ($row = mysqli_fetch_array($result)) {
          $array[] = $row;
        }
        if (!isset($array)) {
          $count = 0;
        } else {
          $count = count($array);
        }
        // print_r($array);
        if ($count >= 1) {
          echo "\n\n\n<section>";
          for ($i = 0; $i < $count; $i++) {
            $c = $i + 1;
            $row = $array[$i];
            echo "<div class='card' onclick='location.href=`post.php?id=" . $row["ID"] . "`'>\n";
            echo "<div class='card__img'>\n";
            $directory = substr($row["Resource"], 3);
            $files = scandir($directory);
            $firstFile = $directory . $files[2];
            echo "<img src='$firstFile'>\n";
            echo "<div class='card__overlay'>\n";
            echo "<h3>" . urldecode($row["Title"]) . "</h3>\n";
            echo "<p>" . $row["Date"] . "</p>\n";
            echo "</div>\n";
            echo "</div>\n";
            echo "</div>\n";
            $row["firstFile"] = $firstFile;
            $array[$i] = $row;
            if (($c % 6 == 0) && $i != 0) {
              echo "</section>\n\n\n";
              echo "\n\n\n<section>";
            }
            if ($c == $count) {
              echo "\n\n\n</section>";
            }
          }
        } else {
          echo "<h3 style='margin-left:40px; color:grey;'>Sorry No Results Matched Your Query</h3>";
        }
      } else {
        $result = mysqli_query($conn, "SELECT * FROM `gallery_albums`");
        while ($row = mysqli_fetch_array($result)) {
          $array[] = $row;
        }
        $count = count($array);
        // print_r($array);
        echo "\n\n\n<section>";

        for ($i = 0; $i < $count; $i++) {
          $c = $i + 1;
          $row = $array[$i];
          echo "<div class='card' onclick='location.href=`album.php?id=" . $row["ID"] . "`'>\n";
          echo "<div class='card__img'>\n";
          $directory = substr($row["Resource"], 3);
          $files = scandir($directory);
          $firstFile = $directory . $files[2];
          echo "<img src='$firstFile'>\n";
          echo "<div class='card__overlay'>\n";
          echo "<h3>" . urldecode($row["Title"]) . "</h3>\n";
          echo "<p>" . $row["Date"] . "</p>\n";
          echo "</div>\n";
          echo "</div>\n";
          echo "</div>\n";
          $row["firstFile"] = $firstFile;
          $array[$i] = $row;
          if (($c % 6 == 0) && $i != 0) {
            echo "</section>\n\n\n";
            echo "\n\n\n<section>";
          }
          if ($c == $count) {
            echo "\n\n\n</section>";
          }
        }
        $x = json_encode($array);
        // echo "<h1>".$x."</h1>";
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


</script>

</html>