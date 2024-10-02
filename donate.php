<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="./CSS/responsive.css" />
    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css"
    />
    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css"
    />
    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css"
    />
    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css"
    />
    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css"
    />
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
          <img
            class="logoImg"
            src="./images/logo.webp"
            alt="Kushma Art Project"
          />
        </div>
        <div class="rightNav">
          <a href="index.php" class="navItem">Home</a>
          <a href="index.php#about" class="navItem">About</a>
          <a href="gallery.html" class="navItem">Gallery</a>
          <a href="donate.html" class="active navItem">Donate</a>
          <a href="index.php#contact" class="navItem">Contact Us </a>
          <p class="navItem hamburger"><i class="fa-solid fa-bars"></i></p>
        </div>
      </div>
      <div class="homeContent">
        <h1 style="color: white; font-family: poppins">Support To</h1>
        <p class="title">
          kushma <br />
          art project
        </p>
        <br />
        <p class="description">
          As a non-profit organization, KAP needs donation from persons like
          you. Single penny from your side will contribute alot in us getting
          towards our selfless goals.
        </p>
        <br />
      </div>
    </div>
    <div class="doner">
      <div class="qr">
        <h1>Donate Money:</h1>
        <img src="images/qr.webp" alt="" />
        <ul>
          <li><i class="fa fa-bank"></i>Kumari bank: 12345423334123-Ramesh Thapa</li>
          <li><i class="fa fa-bank"></i>Esewa: 9804233312 Ramesh Thapa</li>
          <li><i class="fa fa-bank"></i>IME Pay: 9833254573 Ramesh Thapa</li>
          <li><i class="fa fa-bank"></i>Khalti:  9833254573 Ramesh Thapa</li>
          <li><i class="fa fa-bank"></i>Fone Pay: 9833254573 Ramesh Thapa</li>
          <b><li><i class="fa fa-bank"></i>Go Fund Me: <a href="https://www.gofundme.com/f/shatabdi-ghar-heritage-home-renovation-project">SHATABDI GHAR (Heritage Home) RENOVATION PROJECT</a></li></b>
        </ul>
      </div>
      <h1>Donate Physical Items:</h1>
      <form action="donate.php">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="phone" name="phone" placeholder="Phone" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="item" placeholder="Item Being Donated" required><br>
        <input type="file" name="file" placeholder="Photo of Item" required><br>
        <input type="text" name="file" placeholder="Message to Leave" required><br>
        <input type="submit">
      </form>
    </div>

    <div class="footer">
      <p class="text">&copy; &nbsp;All rights reserved. kushma art project</p>
    </div>
  </body>
  <script src="JS/app.js"></script>
</html>
