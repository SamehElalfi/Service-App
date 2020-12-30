<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sameh A. Elalfi</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@600&display=swap" rel="stylesheet">

  <!-- Icons -->
  <!-- Font Awesome v5.15.1 -->
  <link type="text/css" rel="stylesheet" href="<?= asset('css/all.min.css') ?>">

  <!-- Styles -->
  <link type="text/css" rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>">
  <link type="text/css" rel="stylesheet" href="<?= asset('css/index.css') ?>">
</head>

<body>
  <div id="header" class="section">

    <div id="nav">
      <div id="logo"><a href="#">Elalfi</a></div>

      <ul id="menu-list">
        <li><a href="#">Home</a></li>
        <li><a href="#works">Works</a></li>
        <li><a href="#skills">Skills</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>

      <a href="/dashboard"><i class="far fa-user-circle"></i> Account</a>
    </div>

    <div id="hero-section">
      <h1>Elalfi</h1>
      <h2>Full Stack Web Developer</h2>
      <ul>
        <li><a href="#">Websites</a></li>
        <li><a href="#">Mobile Apps</a></li>
        <li><a href="#">Web Apps</a></li>
        <li><a href="#">UI/UX</a></li>
      </ul>
    </div>

  </div>

  <div id="works" class="section">
    <div id="royal-anime" class="project">
      <div class="demo"></div>
      <div class="project-info">
        <h3>Royal <span class="yellow-color">Anime</span></h3>
        <p>Arabic website to watch and download anime episode with an advanced dashboard to manage episodes and movies.</p>
        <div class="features">
          <ul>
            <li>The website is fully responsive.</li>
            <li>The website has two ways to search for anime (embedded google search and advanced search with filters).</li>
            <li>Tags and categories for every anime.</li>
            <li>Option to choose random anime.</li>
            <li>The website was built with the latest version of Laravel, jQuery, and Bootstrap with Argon Design System.</li>
          </ul>
        </div>
        <a href="https://github.com/SamehElalfi/royalanime" class="demo-link">See The Demo <i class="fas fa-external-link-alt"></i></a>
      </div>
    </div>

    <div id="iphotographer" class="project">
      <div class="demo"></div>
      <div class="project-info">
        <h3><span class="yellow-color">i</span>Photographer</h3>
        <p>Creative landing page for photographer blog with the latest blog posts.</p>
        <div class="features">
          <ul>
            <li>Awesome navigation bar with mega menu</li>
            <li>Option to sign in and register new users</li>
            <li>Fixed social media icons</li>
            <li>Animated blog posts with rounded images</li>
            <li>Simple footer to make the work more professional</li>
          </ul>
        </div>
        <a href="https://www.figma.com/proto/VFQa2VPLiq7Tj01Jqu77UG/iPhotographer?node-id=1%3A2" class="demo-link">See The Demo <i class="fas fa-external-link-alt"></i></a>
      </div>
    </div>

    <div id="multi-step-form" class="project">
      <div class="demo"></div>
      <div class="project-info">
        <h3>Multi-Step <span class="yellow-color">Form</span></h3>
        <p>Multi-Step Form to a web development company.</p>
        <div class="features">
          <ul>
            <li>Awesome navigation bar with mega menu</li>
            <li>Option to sign in and register new users</li>
            <li>Fixed social media icons</li>
            <li>Animated blog posts with rounded images</li>
            <li>Simple footer to make the work more professional</li>
          </ul>
        </div>
        <a href="https://www.figma.com/proto/gAFKfIT0d141jcyae8dP5L/5-Steps-Form?node-id=0%3A1" class="demo-link">See The Demo <i class="fas fa-external-link-alt"></i></a>
      </div>
    </div>
  </div>

  <div id="skills" class="section">
    <h3>Here are my skills</h3>
    <div class="skill"><i class="fab fa-html5"></i>HTML</div>
    <div class="skill"><i class="fab fa-css3"></i>CSS</div>
    <div class="skill"><i class="fab fa-js"></i>JavaScript</div>
    <div class="skill"><i class="fab fa-sass"></i>SASS/SCSS</div>
    <div class="skill"><i class="fab fa-python"></i>Python</div>
    <div class="skill"><i class="fab fa-php"></i>PHP</div>
    <div class="skill"><i class="fas fa-database"></i>MySQL</div>
    <div class="skill"><i class="fab fa-laravel"></i>Laravel</div>
    <div class="skill"><i class="fab fa-vuejs"></i>Vue.js</div>
    <div class="skill"><i class="fas fa-mountain"></i>Nuxt.js</div>
    <div class="skill"><i class="fab fa-figma"></i>Figma</div>
    <div class="skill"><i class="fab fa-sketch"></i>Adobe XD</div>
    <div class="skill"><i class="fas fa-pen-nib"></i>Photoshop</div>
    <div class="skill"><i class="fas fa-paint-brush"></i>Illustrator</div>
    <div class="skill"><i class="fab fa-bootstrap"></i>Bootstrap</div>
    <div class="skill"><i class="fas fa-wind"></i>Tailwind</div>
    <div class="skill"><i class="fas fa-flask"></i>Flask</div>
    <div class="skill"><i class="fab fa-node"></i>Node.js</div>
    <div class="skill"><i class="fas fa-cloud-download-alt"></i>Scraping</div>
    <div class="skill"><i class="fas fa-pencil-ruler"></i>UI/UX</div>
    <div class="skill"><i class="fab fa-git"></i>Git</div>
  </div>

  <div id="contact" class="section">
    <div class="contact__section contact__form">
      <h3>Contact Us</h3>
      <form action="#" method="post">
        <div class="input-group"><input placeholder="Full Name" type="text" value="" required></div>
        <div class="input-group"><input placeholder="Email" type="email" value="" required></div>
        <div class="input-group"><input placeholder="Phone Number" type="tel" value=""></div>
        <div class="input-group"><textarea placeholder="Message" name="message" cols="30" rows="10" value="" required></textarea></div>
        <button type="submit" class="submit">Submit</button>
      </form>
    </div>
    <div class="contact__section map">
      <!-- <img src="images/map.png" alt="Where are we on the map?"> -->
    </div>
  </div>

  <div id="footer">
    <span class="copyrights">Copyright © 2020 Elalfi Works. All rights reserved.</span>
    <div id="contact-info">
      <div class="phone-number"><i class="fas fa-phone" aria-hidden="true"></i> +20 100 501 7864</div>
      <div class="email"><i class="fas fa-envelope" aria-hidden="true"></i><a href="mailto:sameh.elalfi.mail@gmail.com">sameh.elalfi.mail@gmail.com</a></div>
    </div>
  </div>

  <!-- Main Scripts -->
  <script src="<?= asset('js/jquery-3.5.1.min.js') ?>"></script> -->
  <script src="<?= asset('js/bootstrap.min.js') ?>"></script>

</body>

</html>