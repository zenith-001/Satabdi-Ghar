<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css" />
  <link rel="stylesheet" href="./CSS/blog.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kushma Art Project | Blog</title>
  <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
</head>

<body>
  <!-- THIS IS MANDATORY TO READ THIS----|
    NEVER LOSE HOPE, TRY TRY BUT DONT CRY -->
  <div class="nav">
    <img src="./images/tralogo.webp" class="logo">

    <div class="right">
      <a href="index.php" class="nav-items"><i class="fa-solid fa-home"></i> &nbsp; Home</a>
      <form action="blog.php" method="get" class="search">
        <input name="search" type="text" class="searcher" placeholder="Enter your query here...">
        <button style="cursor:pointer;" class="search_"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
      <br><br>
    </div>
  </div>
  <!-- nav end   -->
  <p class="mytitle">
    Welcome to the blog Page of Kushma Art Project
  </p>


  <br>
  <?php
  include "admin/db.php";
  if (isset($_GET['search'])) {
    echo "<script>document.querySelector('.searcher').value = '" . $_GET['search'] . "'</script>";

    $result = mysqli_query($conn, "SELECT * FROM blogs_list WHERE LOWER(Title) LIKE '%" . filter_var($_GET["search"], FILTER_SANITIZE_ENCODED) . "%' OR Title = '" . filter_var($_GET["search"], FILTER_SANITIZE_ENCODED) . "';");
    // $array=[];
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
        $directory = substr($row["Resources"], 3);
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
      echo "<h3>Sorry No Results Matched Your Query</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    }
  } else {
    $result = mysqli_query($conn, "SELECT * FROM `blogs_list`");
    while ($row = mysqli_fetch_array($result)) {
      $array[] = $row;
    }
    $count = count($array);
    // print_r($array);
    echo "\n\n\n<section>";

    for ($i = 0; $i < $count; $i++) {
      $c = $i + 1;
      $row = $array[$i];
      echo "<div class='card' onclick='location.href=`post.php?id=" . $row["ID"] . "`'>\n";
      echo "<div class='card__img'>\n";
      $directory = substr($row["Resources"], 3);
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

  <script src="JS/searcher.js"></script>
  <div class="footer">
    <p class="text">&copy; &nbsp;All rights reserved. kushma art project</p>
  </div>
</body>

</html>