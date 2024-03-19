<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <script src="https://kit.fontawesome.com/8693f8f216.js" crossorigin="anonymous"></script>
    <title>Blog - Afrisource Minerals and Farm PLC</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap');

body{
  /* background-color: rgb(15, 11, 11); */
  background: #f2f2f2;
}

::selection {
  background-color: red; /* Set the desired background color */
  color: #ffffff; /* Set the text color */
}

::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 5px;
}

header {
  margin: -8px;
  margin-top: -16px;
  background-color: #f2f2f2;
  color: #f2f2f2;
  text-align: center;
  height: 105dvh;
  background-image: url(resources/blog-img1.jpg);
  background-attachment: fixed;
  background-size: cover;
  position: relative;
  animation: animate 16s ease-in-out infinite;
}

.outer{
  position: absolute;
  left: 0;
  right: 0;
  width: 100%;
  height: 105vh;
  background: rgba(0,0,0,0.2);
}

header img{
  width: 370px;
  height: 150px;
  margin-top: 130px;
}

header h1{
  margin-top: 200px;
  font-family: 'Montserrat';
  margin-bottom: 100px;
  font-size: 70px;
}

header h1 a{
  text-decoration: none;
  color: #ddd;
}

nav#nav {
  width: 100%;
  height: 65px;
  line-height: 65px;
  box-shadow: 0 0 10px rgba(0,0,0,.5);
  padding: 0 0px;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
  transition:1s;
}

nav#nav:hover{
  background: white;
  transition:1s;
  color: #fff;
}

.left-ul li {
  list-style: none;
  float: left;
  margin-top: -130px;
}

.left-ul li img{
  width: 35px;
  height: 40px;
}

.right-ul li {
  display: inline-block;
}

.right-ul li a {
  text-decoration: none;
  display: block;
  padding: 0 23px;
  color: red;
  outline: none;
  font-size: 20px;
  font-weight: bold;
  font-family: 'Montserrat', 'Open Sans', sans-serif;
}

.right-ul li a::after {
  color: black;
  transition: 0.5s;
  content: '';
  width: 0%;
  height: 2px;
  background: #f44336;
  display: block;
  margin: auto;
  transition: 0.5s;
}

.right-ul li a:hover::after {
  color: #f44336;
  width: 100%;
}

.toggle {
  position: absolute;
  z-index: 3;
  width: 40px;
  height: 40px;
  line-height: 40px;
  text-align: center;
  border-radius: 50%;
  background:rgb(172, 3, 3);
  color: white;
  top: 10px;
  right: 20px;
  cursor: pointer;
  display: none;
  transition: 0.5s;
}

.toggle:hover {
  color:rgb(172, 3, 3);
  background: white;
  transition: 0.5s;
}

.blog-section{
  margin-top: 100px;
  min-height: 100vh;
}

.blog-section h1{
  font-size: 55px;
  font-family: 'Open Sans', sans-serif;
  text-align: center;
  color: rgb(172, 3, 3);
  text-transform: uppercase;
}

.uploaded-blog{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.uploaded-blog img{
  width: 500px;
  height: 300px;
}

.uploaded-blog p{
  width: 500px;
  height: 300px;
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}

footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      margin: -8px;
    }
  
    footer a{
      color: #777;
      text-decoration: none;
    }
    footer a:hover{
      color: red;
    }
  
    /*Layer index2*/
    .layer{
      background: transparent;
      height: 80%;
      width: 100%;
      position: relative;
      top: 0;
      left: 0;
      transition: 0.5s;
  }
  
  .layer h3{
    color: #222222;
  }
  
  .layer:hover{
      background: white;
  }
  .layer p{
      width: 100%;
      font-weight: 400;
      color: #222222;
      font-size: 15px;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      position: relative;
      opacity: 0;
      transition: 0.5%;
  }
  .layer:hover p{
      bottom: 0;
      opacity: 1;
  }

  footer {
    background-color: rgb(15, 11, 11);
    color: #fff;
    margin: -8px;
    max-height: 115vh;
    height: 140vh;
    display: grid;
    grid-template-columns: auto auto auto;
    grid-template-rows: auto;
  }

  footer h2{
    width: 300px;
    text-align: center;
    font-size: 30px;
    font-family: 'Open Sans', sans-serif;
    color: rgb(172, 3, 3);
    margin-top: 80px;
  }

  footer h2::after{
    content: '';
    width: 0%;
    height: 2px;
    background: #f44336;
    display: block;
    margin: auto;
    transition: 0.5s;
  }

  footer h2:hover::after{
    width: 200px;
  }

  #contact p{
    font-family: 'Great Vibes', 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    color: rgb(172, 3, 3);
    font-weight: bold;
    font-size: 25px;
  }

  footer a{
    color: #777;
    text-decoration: none;
  }
  footer a:hover{
    color: red;
  }

  .cont1{
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .cont-wrap2{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

.cont2{
  width: 200px;
  font-size: 20px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.cont2 .ho{
    width: 100%;
    background: rgb(58, 19, 5);
}

.cont2 a{
  margin-bottom: 40px;
}

.cont2 a::after{
    content: '';
    width: 0%;
    height: 2px;
    background: #f44336;
    display: block;
    margin: auto;
    transition: 0.5s;
}

.cont2 a:hover::after{
  width: 100%;
}

.cont3 {
  width: auto;
  margin-top: 30%;
  padding: 20px;
  float: right;
}

.input-field {
  color: white;
  display: flex;
  flex-direction: column;
  margin-bottom: 20px;
}

.input-field input,
.input-field textarea {
  padding: 10px;
  border-radius: 4px;
  font-size: 16px;
  background-color: rgb(15, 11, 11);
  color: #fff;
  border-top: none;
  border-right: none;
  border-left: none;
  border-bottom: 5px solid #222222;
}

.input-field textarea {
  resize: vertical;
  height: 50px;
}

.input-field input[type="submit"] {
  background-color: rgb(58, 19, 5);
  border: none;
  color: white;
  cursor: pointer;
  transition: 1s;
}

.input-field input[type="submit"]:hover {
  background-color: rgb(77, 23, 4);
  border: 1px solid #45a049;
  transition: 1s;
}

.input-field input:focus,
.input-field textarea:focus {
    outline: none;
    border-color: #ccc;
    transition: 0.5s;
}

.fa {
  font-size: 15px;
  transition: 1s;
}

.fa-brands{
  font-size: 15px;
  transition: 1s;
}

.fa-solid{
  color: rgb(162, 145, 145);
}

.fa:hover {
  color: rgb(172, 3, 3);
  transition: 1s;
}

.fa-brands:hover{
  color: rgb(172, 3, 3);
  transition: 1s;
}

.fa-facebook {
  margin-top: 50px;
  color: #335ff0;
}

.fa-linkedin {
  color: #448fff;
}

.fa-instagram {
  color:orangered;
}

.fa-tiktok {
  color: #ccc;
}

.fa-telegram {
  color: #3dafa5;
}

.copyright{
  font-family: 'Poppins';
  background-color: rgb(15, 11, 11);
  margin-top: -25px;
  margin-bottom: -30px;
  text-align: center;
  border-top: 1px solid #888;
}

.copyright a{
  font-weight: bold;
  text-decoration: none;
  color: #888;
}

.copyright a:hover{
  color: rgb(172, 3, 3);
}

.copyright .adm:hover{
    color: #888;
    cursor:auto;
}

@media(max-width: 765px){
 
 header img{
   width: 350px; 
   height: 150px;
 }

 nav#nav {
   padding: 0 0;
}
.right-ul li {
   float: right;
   display: block;
}

.left-ul li {
   display: block;
}

.left-ul li a {
   padding-left: 10px;
}

.right-ul {
 margin-top: 80px;
 margin-right: 20px;
 display: none;
}

.right-ul li a {
 background: transparent;
 backdrop-filter: blur(20px);
   width: 260px;
   margin-top: 10px;
 }

.toggle {
   display: block;
}

.blog-section h1{
  font-size: 35px;
}

.uploaded-blog img{
  width: 320px;
  height: 300px;
}

.uploaded-blog p{
  width: 320px;
  height: 300px;
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}

footer{
    min-height: 230vh;
    grid-template-columns: auto;
    grid-row: auto auto auto;
    text-align: center;
  }

  .cont-wrap2{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .cont3 {
    float: none;
    margin: 0;
  }
 
}
    </style>
</head>
<body>
<header>
        <div class="outer">
        <div class="toggle"><i class="fa-solid fa-bars"></i></div>
        
        <nav id="nav">
         <ul class="left-ul">
             <li><a href="index.html"><img src="images/logo.png" alt="logo" width="20px" height="20px"></a></li>
         </ul>
         
         <ul class="right-ul">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="index2.html">Services</a></li>
            <li><a href="powerfulGems.html">Powerful Gemstones</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="contact.html">Contact Us</a></li>
         </ul>
        </nav>
        <h1 data-aos="fade-down" data-aos-delay="50" data-aos-duration="1000" data-aos-easing="ease-in-out">
            <a href="blog.php">Blog</a>
        </h1>
      </div>

      </header>

      <section class="blog-section">
        <h1>Afrisource minerals and farm</h1>

    <?php
// Define the path to the data file
$dataFile = 'uploadingDiv/data.txt';
$imageDirectory = 'uploadingDiv/';

// Read the data from the file and display the divs
if (file_exists($dataFile)) {
   $lines = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
   foreach ($lines as $line) {
       $data = explode('|', $line);
       $imageName = $data[0];
       $imageDescription = $data[1];

       echo '<div class="uploaded-blog">';
       echo '<img src="' . $imageDirectory . $imageName . '" alt="' . $imageDescription . '">';
       echo '<p>' . $imageDescription . '</p>';
       echo '</div>';

   }
}
?>

      </section>

<footer>
    <div id="contact">
      <div class="cont1">
      <h2><a href="contact.html">Contact Us</a></h2>
      <p>If you have any questions or inquiries, please contact us at <br><br><br>
            
        <i class="fa-solid fa-mobile-screen-button"></i>+251910643449<br>
        <i class="fa-solid fa-mobile-screen-button"></i>+251911707352<br>
        <i class="fa-solid fa-mobile-screen-button"></i>+251912130939<br><br>
            <br><i class="fa-solid fa-envelope"></i>afrisourceminerals@gmail.com<br><br>
            <a href="https://www.facebook.com/p/Afrisource-Minerals-And-Farming-100068401151938/?locale=sl_SI" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://www.linkedin.com/company/afrisource-minerals-and-farm-plc" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
            <a href="https://www.instagram.com/afrisource_minerals/" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="https://www.tiktok.com/@afrisource.minera" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
            <a href=""><i class="fa-brands fa-telegram"></i></a>
  
      
          </p>
        </div>
  
      </div>
  
      <div class="cont-wrap2">
    <div class="cont2">
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="index2.html">Services</a></li>
          <li><a href="powerfulGems.html">Gemstones</a></li>
          <li class="ho"><a href="blog.php">Blog</a></li>
          <li><a href="contact.html">Contact</a></li>
        
        </ul>
      </nav>
    </div>
  </div>
  
    <div class="cont3">
      <form action="https://formspree.io/f/xqkrbrdw" method="POST">
      <div class="input-field">
        <input type="text" id="name" name="name" placeholder="Your name" required>
      </div>
      <div class="input-field">
        <input id="email" name="email" placeholder="Email" required>
      </div>
      <div class="input-field">
        <textarea id="comment" name="comment" placeholder="Your comment" required></textarea>
      </div>
      <div class="input-field">
        <input type="submit" value="Submit">
      </div>
      </form>
    </div>
  
    </footer>
    <div class="copyright"><a href="admin.php" class="adm">Copyright</a><a href="https://natnahom.github.io" target="_blank"> &copy; 2024 Afrisource Minerals and Farm PLC</a></div>
  

<!--Fade animations-->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script>
    
    let rightUl = document.querySelector(".right-ul");
        
        let btn = document.querySelector(".toggle");
        btn.addEventListener("click", function(){
            if(rightUl.style.display === "none"){
                rightUl.style.display = "block";
            } else {
                rightUl.style.display = "none";
            }
        });
          
       </script>
</body>
</html>