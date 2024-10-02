<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "admin/db.php";
    $name = filter_var($_REQUEST['name'], FILTER_SANITIZE_ENCODED);
    $email = filter_var($_REQUEST['email'], FILTER_SANITIZE_ENCODED);
    $phone = filter_var($_REQUEST['phone'], FILTER_SANITIZE_ENCODED);
    $message = filter_var($_REQUEST['message'], FILTER_SANITIZE_ENCODED);
    $sql = "INSERT into contact_datas (`Name`,`Email`,`Phone`,`Message`) Values ('$name','$email','$phone','$message')";
    $request = mysqli_query($conn, $sql);
    if ($request) {
        $status = "Successful";
    } else {
        $status = ("Error" . (mysqli_report($request)));
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./CSS/responsive.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css">
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./CSS/style.css" />
    <title>Kushma Art Project</title>
</head>

<body>
    <div class="home" id="home">
        <div class="nav">
            <div class="logo">
                <img class="logoImg" src="./images/logo.webp" alt="Kushma Art Project" />
            </div>
            <div class="rightNav">
                <a href="#home" class="navItem">Home</a>
                <a href="#about" class="navItem">About</a>
                <a href="gallery.php" class="navItem">Gallery</a>
                <a href="donate.php" class="navItem">Donate</a>
                <a href="#contact" class="navItem">Contact Us </a>
                <p class="navItem hamburger"><i class="fa-solid fa-bars"></i></p>
            </div>
        </div>
        <div class="homeContent">
            <p class="title">
                kushma <br />
                art project
            </p>
            <br />
            <p class="description">
                With an intention to connect the cultural diversity of the society
                among the mass, Shatabdi Ghar has been conceived with the aim of
                preserving art and culture through the participation of the community.
                We are doing various project for the creative development of Kushma.
            </p>
            <br>
            <a href="donate.html">
                <button class="support">
                    Support Us <i class="fa-solid fa-arrow-right"></i>
                </button>
            </a>
        </div>
    </div>
    <div id="about" class="about">
        <div class="Contitle">
            <p class="Ptitle">About Us</p>
        </div>
        <div class="about-main"><!--This is just title-->
            <div class="Contitle">
                <p class="Ptitle">Who are we?</p>
            </div><br>

            <p class="description">
            Kushma Art Project is a small organization started by Ramesh Adhikari from Kushma, Nepal. This organization aims to preserve the cultural traditions reflecting the rich Nepali history. We ought to help the society by protecting and promoting the cultural believes as well as the traditions followed by our ancestors. Alongside the traditions, we also support the young minds and help them in making their as well as the society's future bright. We initiate various development projects as well as campaings.
            </p>

            <div class="Contitle">
                <p class="Ptitle">What's our mission?</p>
            </div><br>
            <p class="description">
                101). Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia reiciendis dignissimos, ab commodi
                nulla nesciunt magni quas sed vitae ducimus hic est eos necessitatibus aliquid. Cumque totam nihil
                officia eius.
                <br> <br>
                6). Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic assumenda architecto, ipsa porro sed
                iusto necessitatibus blanditiis. Nulla tempora ut, in quis eveniet unde, aliquid nostrum porro omnis
                consequuntur optio.
            </p>
        </div>

        <div class="Contitle">
            <p class="Ptitle">Our Team</p>
        </div><br>
        <center>
            <div class="team-info">
                <div class="wrapper">

                    <i class="fas fa-angle-left myi" id="left"></i>

                    <ul class="carousel">
                        <?php
                        include "admin/db.php";
                        $request = mysqli_query($conn, "SELECT * FROM `members_list` WHERE `Special`='1'");
                        $arr = [];
                        $x = 0;
                        while ($z = mysqli_fetch_assoc($request)) {
                            $arr[$x] = $z;
                            $x += 1;
                        }

                        foreach ($arr as $q) {
                            echo "
                            
                        <li class='card'>
                        <div class='img'>
                            <img src='" . $q["Image"] . "' alt='' draggable='false' />
                        </div>

                        <h2>" . urldecode($q["Name"]) . "</h2>
                        <p><i class='fas fa-address-card'></i> " . urldecode($q["Role"]) . "</p>
                    </li>
                            ";
                        }
                        ?>
                        <li class="card">


                            <h2 style="width: 90%;">We have many more hands to help</h2>
                            <p>See more...</p>
                        </li>
                    </ul>
                    <i class="fas fa-angle-right myi" id="right"></i>
                </div>
            </div>
    </div>
    <br>
    <div class="latest">
        <div class="Contitle">
            <p class="Ptitle">Latest News</p>
        </div><br>
        <div class="latest-main">
            <div class="blog">
                <div class="Contitle">
                    <p class="Ptitle">Posts</p>
                </div>
                <p class="title">
                    <?php
                    include "admin/db.php";
                    $request = mysqli_query($conn, "SELECT * FROM `blogs_list`");
                    $arr = [];
                    $i = 0;
                    while ($x = mysqli_fetch_assoc($request)) {
                        $arr[$i] = $x;
                        $i = $i + 1;
                    }
                    $x = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `blogs_list`"))[0];
                    echo urldecode($arr[$x - 1]["Title"]);

                    ?>
                </p>
                <p class="date"><i class="fa-solid fa-calendar"></i>&nbsp;
                    <?php
                    echo urldecode($arr[$x - 1]["Date"]);
                    ?>
                </p>

                <p class="description">
                    <?php
                    echo urldecode($arr[$x - 1]["Description"]);
                    ?>
                </p>

                <br>

                <button class="More" onclick="location.href ='blog.php'">See more...</button>

            </div>
            <div class="event">
                <div class="Contitle">
                    <p class="Ptitle">Events</p>
                </div>
                <p class="title">
                    <?php
                    include "admin/db.php";
                    $request = mysqli_query($conn, "SELECT * FROM `events_list`");
                    $arr = [];
                    $i = 0;
                    while ($x = mysqli_fetch_assoc($request)) {
                        $arr[$i] = $x;
                        $i = $i + 1;
                    }
                    $x = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `events_list`"))[0];
                    echo urldecode($arr[$x - 1]["Title"]);

                    ?>
                </p>
                <p class="date"><i class="fa-solid fa-calendar"></i>&nbsp;
                    <?php
                    echo urldecode($arr[$x - 1]["Date"]);
                    ?>
                </p>

                <p class="description">
                    <?php
                    echo urldecode($arr[$x - 1]["Description"]);
                    ?>
                </p>

                <br>

                <button class="More" onclick="location.href ='events.php'">See more...</button>


            </div>
        </div>
    </div>




    <div id="contact" class="contact-flex">
        <div class="contact">
            <form class="form" method="POST" action="index.php">
                <div class="Contitle">
                    <p class="Ptitle">Get In Touch</p>
                </div><br>
                <input maxlength="25" minlength="5" type="text" name="name" placeholder="Name" required><br>
                <input minlength="8" type="email" name="email" placeholder="Email" required><br>
                <input minlength=8 maxlength="15" type="number" name="phone" placeholder="Phone number" required><br>
                <textarea minlength="10" maxlength="250" name="message" id="" placeholder="Message" required></textarea>
                <br>
                <button class="submit" type="submit">Send Now</button>
                <p>
                    <?php
                    if (isset($status)) {
                        echo $status;
                    }
                    ?>
                </p>
            </form>

        </div>

        <div class="contact-info">
            <div class="Contitle">
                <p class="Ptitle">Other Contact Info</p>
            </div><br>
            <div class="medias">
                <div class="card">
                    <img src="./images/facebook.webp" alt="">
                    <p class="name">Facebook</p>
                    <span class="link">- Kushma Art Project - कुश्मा कला परियोजना </span>
                </div>
                <div class="card">
                    <img src="./images/youtube.webp" alt="">
                    <p class="name">Youtube</p>
                    <span class="link">- Satapdhi Ghar</span>
                </div>
                <div class="card">
                    <img src="./images/instagram.webp" alt="">
                    <p class="name">Instagram</p>
                    <span class="link">- Satapdhi Ghar</span>
                </div>
                <br>
                <p class="subtitle">More contact information:</p>
                <p class="description"><br>
                    <i class="fa-solid fa-phone"></i> Phone: +977 988038038 <br><br>
                    <i class="fa-solid fa-envelope"></i> Email: aaradhyapubg@gmail.com <br><br>
                    <i class="fa-solid fa-location-dot"></i> Address: Kushma, Nepal <br><br>
                </p>

                <p class="description">
                    <a style="color:#252525; font-weight: bolder;" href=""><i class="fa-solid fa-eye"></i>
                        View more</a>
                </p>

            </div>
        </div>

    </div><!--Flex div end-->






    <div class="footer">
        <p class="text">&copy; &nbsp;All rights reserved. kushma art project</p>
    </div>
</body>
<script src="JS/app.js"></script>

</html>