<?php
session_start();

// Define the path to the data file
$dataFile = 'data.txt';

// Process the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteImageName'])) {
    $deleteImageName = $_POST['deleteImageName'];

    // Read the data from the file
    $lines = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Find the index of the line with the matching image name
    $index = 0;
    foreach ($lines as $key => $line) {
        $data = explode('|', $line);
        $imageName = $data[0];
        if ($imageName === $deleteImageName) {
            $index = $key;
            break;
        }
    }

    // Remove the line with the matching image name
    if ($index !== -1) {
        unset($lines[$index]);
    }

    // Save the updated data back to the file
    file_put_contents($dataFile, implode(PHP_EOL, $lines));

    // Redirect back to the blog.php page or any other desired page
    header("Location: ../blog.php");
    exit();
}

// // Process the form submission
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['imageName'])) {
//     // Get the image name and description from the form
//     $imageName = "uploads/" . $_POST['imageName'] ?? '';
//     $imageDescription = $_POST['imageDescription'] ?? '';

//     // Save the data to the "data.txt" file
//     $data = $imageName . '|' . $imageDescription . PHP_EOL;

//     // Read the existing data from the file
//     $existingData = file_get_contents('data.txt');

//     // Prepend the new data to the existing data
//     $updatedData = $data . $existingData;

//     // Save the updated data back to the file
//     file_put_contents('data.txt', $updatedData);

//     // Redirect back to the blog.php page or any other desired page
//     header("Location: ../blog.php");
//     exit();
// }

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['imageName'])) {
  // Get the image name and description from the form
  $imageName = "uploads/" . ($_POST['imageName'] ?? '');
  $imageDescription = $_POST['imageDescription'] ?? '';

  // Read the existing data from the file
  $existingData = file_get_contents('data.txt');

  // Remove newline characters from the image description
  $imageDescription = str_replace("\n", '', $imageDescription);

  // Save the data to the "data.txt" file
  $data = $imageName . '|' . $imageDescription . PHP_EOL;

  // Prepend the new data to the existing data
  $updatedData = $data . $existingData;

  // Save the updated data back to the file
  file_put_contents('data.txt', $updatedData);

  // Redirect back to the blog.php page or any other desired page
  header("Location: ../blog.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="shortcut icon" type="x-icon" href="../images/logo.png">
    <script src="https://kit.fontawesome.com/8693f8f216.js" crossorigin="anonymous"></script>
    <title>Uploading Blog - Afrisource Minerals and Farm PLC</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap');

body{
  background-color: #f2f2f2;
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
  height: 80vh;
  background:rgba(0,0,0,.8);
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
  height: 80vh;
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

.upload-section{
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background: #f2f2f2;
  color:#f2f2f2;
}

.cont3 {
  margin-top: 10%;
  margin-bottom: 10%;
  padding: 20px;
  width: 50%;
  background: rgb(15, 11, 11);
  box-shadow: 0 15px 17px rgba(0, 0, 0, 0.8);
  border-radius: 10px;
  overflow: hidden;
}

.cont3 input, .cont3 button,
.cont3 textarea {
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

.cont3 textarea {
  resize: vertical;
  height: 100px;
  width: 90%;
}

.cont3 button[type="submit"] {
  background-color: rgb(58, 19, 5);
  border: none;
  color: white;
  cursor: pointer;
  transition: 1s;
}

.cont3 button[type="submit"]:hover {
  background-color: rgb(77, 23, 4);
  border: 1px solid #45a049;
  transition: 1s;
}

.cont3 input:focus, .cont3 button:focus,
.cont3 textarea:focus {
    outline: none;
    border-color: #ccc;
    transition: 0.5s;
}

@media (max-width: 765px){

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
}
    </style>
</head>
<body>

    <header>
        <div class="outer">
        <div class="toggle"><i class="fa-solid fa-bars"></i></div>
        
        <nav id="nav">
         <ul class="left-ul">
             <li><a href="../index.html"><img src="../images/logo.png" alt="logo" width="20px" height="20px"></a></li>
         </ul>
         
         <ul class="right-ul">
            <li><a href="../uploadingImg/UPI_index.php">Upload Image</a></li>
            <li><a href="UPD_index.php">Upload Blog</a></li>
         </ul>
        </nav>
        <h1 data-aos="fade-down" data-aos-delay="50" data-aos-duration="1000" data-aos-easing="ease-in-out">
            <a href="UPD_index.php">Upload Blog</a>
        </h1>
      </div>

      </header>

    <section class="upload-section">
      <div class="cont3">
      <h3>How it works.</h3>
        <p>First you need to enter the image name you copied.</p>
        <p>Then write on the description anything you would like to see on your blog.</p>
        <p>Finally click submit.</p>
        <p><b>REMARK:</b> I advise you to not use same images for the blogs</p>
    <form method="POST" action="UPD_index.php">
        <input type="text" name="imageName" placeholder="Image Name"><br><br>
        <textarea type="text" name="imageDescription" placeholder="Description"></textarea><br><br>
        <button type="submit">SUBMIT</button>
    </form>

    <br><br><br>
    <h3>How it works.</h3>
        <p>First you need to write the image name but precede it with "uploads/"</p>
        <p>For example: uploads/example.jpg</p>
        <p>Finally click the delete button</p>
    <form method="POST" action="UPD_index.php">
        <input type="text" name="deleteImageName" placeholder="uploads/Image Name"><br><br>
        <button type="submit">DELETE</button>
    </form>
        </div>
</section>

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

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
AOS.init();
</script>
</body>
</html>