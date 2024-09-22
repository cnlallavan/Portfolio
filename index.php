<?php

$conn = mysqli_connect('localhost', 'root', '', 'portfolio');


if ($stm = $conn->prepare('SELECT * FROM content')){
  $stm->execute();
  $result = $stm->get_result();

  if ($result->num_rows >0){

  }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portfolio</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="mediaqueries.css" />
  </head>
  <body>
    <nav id="desktop-nav">
      <div class="logo">My Portfolio</div>
      <div>
        <ul class="nav-links">
          <li><a href="#about">About</a></li>
          <li><a href="#skills">Skills</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>
    </nav>
    <nav id="hamburger-nav">
      <div class="logo">My Portfolio</div>
      <div class="hamburger-menu">
        <div class="hamburger-icon" onclick="toggleMenu()">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div class="menu-links">
          <li><a href="#about" onclick="toggleMenu()">About</a></li>
          <li><a href="#skills" onclick="toggleMenu()">Skills</a></li>
          <li><a href="#gallery" onclick="toggleMenu()">Gallery</a></li>
          <li><a href="#contact" onclick="toggleMenu()">Contact</a></li>
        </div>
      </div>
    </nav>
    <section id="profile">
      <div class="section__pic-container">
        <img src="./assets/nawong.jpg" id="Profile_Picture" />
      </div>
      <div class="section__text">
        <p class="section__text__p1">Hello, I'm</p>
        <h1 class="title">Chris Neil Llavan</h1>
        <p class="section__text__p2">BSIT Student</p>
        <div class="btn-container">
          <button
            class="btn btn-color-2"
            onclick="window.open('./assets/llavan_CV.pdf')"
          >
            Download CV
          </button>
          <button class="btn btn-color-1" onclick="location.href='./#contact'">
            Contact Me
          </button>
        </div>
        <div id="socials-container">
          <img
            src="./assets/linkedin.png"
            alt="LinkedIn profile"
            class="icon"
            onclick="location.href='https://www.linkedin.com/in/chrisneilllavan/'"
          />
          <img
            src="./assets/facebook.png"
            alt="Facebook profile"
            class="icon"
            onclick="location.href='https://www.facebook.com/c0mPl3X.iwnl'"
          />
          <img
            src="./assets/x.png"
            alt="Twitter profile"
            class="icon"
            onclick="location.href='https://twitter.com/ChrisLlavan'"
          />
        </div>
      </div>
    </section>
    <section id="about">
      <p class="section__text__p1">Get To Know More</p>
      <h1 class="title">About Me</h1>
      <div class="section-container">
        <div class="section__pic-container">
          <img
            src="./assets/file.png"
            alt="Profile picture"
            class="about-pic"
          />
        </div>
        <div class="about-details-container">
          <div class="about-containers">
            <div class="details-container">
              <img
                src="./assets/cake.png"
                alt="Cake"
                class="icon"
              />
              <h3>Birthdate</h3>
              <p>Born in <br />November 9, 2002</p>
            </div>
            <div class="details-container">
              <img
                src="./assets/love.png"
                alt="Loves icon"
                class="icon"
              />
              <h3>Loves</h3>
              <p>Video Games<br />Motorsports</p>
            </div>
          </div>
          <div class="text-container">
          <?php while($record = mysqli_fetch_assoc($result)){  
             echo $record['content']; 
          } ?>
          </div>
        </div>
      </div>
    </section>
    <section id="skills">
      <p class="section__text__p1">Check out my</p>
      <h1 class="title">Skills</h1>
      <div class="skills-details-container">
        <div class="about-containers">
          <div class="details-container">
            <h2 class="skills-sub-title">Programming</h2>
            <div class="article-container">
              <article>
                <img
                  src="./assets/html.png"
                  alt="Experience icon"
                  class="icon"
                />
                <div>
                  <h3>HTML</h3>
                  <p>Intermediate</p>
                </div>
              </article>
              <article>
                <img
                  src="./assets/css.png"
                  alt="Experience icon"
                  class="icon"
                />
                <div>
                  <h3>CSS</h3>
                  <p>Intermediate</p>
                </div>
              </article>
              <article class="java-icon">
                <img
                  src="./assets/java.png"
                  alt="Experience icon"
                  class="icon"
                />
                <div>
                  <h3>Java</h3>
                  <p>Basic</p>
                </div>
              </article>
              <article>
                <img
                  src="./assets/js.png"
                  alt="Experience icon"
                  class="icon"
                />
                <div>
                  <h3>JavaScript</h3>
                  <p>Basic</p>
                </div>
              </article>
            </div>
          </div>
          <div class="details-container">
            <h2 class="skills-sub-title">Video Games</h2>
            <div class="article-container">
              <article class="wt-icon">
                <img
                  src="./assets/war.png"
                  alt="War Thunder icon"
                  class="war-icon"
                />
                <div>
                  <h3>War Thunder</h3>
                  <p>US, German Top Tier</p>
                </div>
              </article>
              <article class="warframe-icon">
                <img
                  src="./assets/wf.png"
                  alt="Warframe icon"
                  class="wf-icon"
                />
                <div>
                  <h3>Warframe</h3>
                  <p>MR 19</p>
                </div>
              </article>
              <article>
                <img
                  src="./assets/valorant.svg"
                  alt="Valorant icon"
                  class="icon"
                />
                <div>
                  <h3>Valorant</h3>
                  <p>Silver 3 peak :(</p>
                </div>
              </article>
              <article>
                <img
                  src="./assets/cs.png"
                  alt="CS2 icon"
                  class="icon"
                />
                <div>
                  <h3>CS2</h3>
                  <p>MGE Peak Rank</p>
                </div>
              </article>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="gallery">
      <p class="section__text__p1">This is my</p>
      <h1 class="title">Gallery</h1>
      <div class="gallery-details-container">
        <div class="about-containers">
          <div class="details-container color-container">
            <div class="article-container">
              <table border="0" cellpadding="10" cellspacing="0">
              <?php
                  $image = mysqli_query($conn, "SELECT * FROM files ");
                  $i = 1;
                  foreach ($image as $row) : ?>
                  <tr><img src="img/<?php echo $row["image"]; ?>" height="200"></tr>
                  <?php endforeach; ?>
                </table>
            </div>
          </div>


        </div>
      </div>
    </section>
    <section id="contact">
      <p class="section__text__p1">Get in Touch</p>
      <h1 class="title">Contact Me</h1>
      <div class="contact-info-upper-container">
        <div class="contact-info-container">
          <form class="contact-form" action="email.php" method="post">
            <input type="text" name="name" placeholder="Full Name"> <br>
            <input type="text" name="email" placeholder="Email Address"> <br>
            <input type="text" name="subject" placeholder="Subject"> <br>
            <textarea name="message" placeholder="Message"></textarea> <br>
            &ensp; &ensp; &ensp;<button type="submit" class="submit">Send Message</button> 
          </form>
        </div>
      </div>
    </section>
    <footer>
      <nav>
        <div class="nav-links-container">
          <ul class="nav-links">
            <li><a href="#about">About</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
      </nav>
      <p>Copyright &#169; 2024 Chris Neil Lesley Llavan. All Rights Reserved.</p>
    </footer>
    <script src="script.js"></script>
    <style>
      #profile img {
        border-radius: 50%;
      }
      .about-pic {
        border-radius: 50%;
      }
    </style>

  </body>
</html>