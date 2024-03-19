<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $targetDirectory = "../uploadingDiv/uploads/"; // Specify the target directory where you want to store the uploaded images
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = true;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "<b>Error: Please upload a valid image file.</b><br><br>";
        $uploadOk = false;
    }

    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo "<b>Error: File already exists.</b><br><br>";
        $uploadOk = false;
    }

    // Allow only specific image file formats (you can modify this array as per your requirements)
    $allowedFormats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "<b>Error: Only JPG, JPEG, PNG, and GIF files are allowed.</b><br><br>";
        $uploadOk = false;
    }

    if ($uploadOk) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "<b>Image uploaded successfully.</b><br><br>";
        } else {
            echo "<b>Error: There was a problem uploading the image.<b><br><br>";
        }
    }
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
    <title>Uploading Image - Afrisource Minerals and Farm PLC</title>

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
  
  .cont3 input{
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
  
  .cont3 input[type="submit"] {
  font-size: 25px;
  background-color: rgb(58, 19, 5);
  border: none;
  color: white;
  cursor: pointer;
  transition: 1s;
  }
  
  .cont3 input[type="submit"]:hover {
  background-color: rgb(77, 23, 4);
  border: 1px solid #45a049;
  transition: 1s;
  }
  
  .cont3 input:focus{
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
            <li><a href="UPI_index.php">Upload Image</a></li>
            <li><a href="../uploadingDiv/UPD_index.php">Upload Blog</a></li>
         </ul>
        </nav>
        <h1 data-aos="fade-down" data-aos-delay="50" data-aos-duration="1000" data-aos-easing="ease-in-out">
            <a href="UPI_index.php">Upload Image</a>
        </h1>
      </div>

      </header>

    <section class="upload-section">
      <div class="cont3">
      <h3>How it works.</h3>
        <p>First you need to upload an image below.</p>
        <p>Then copy the image name including the extension from your image file, you'll need it when uploading your blog.<br> For example: example.jpg</p>
        <p>Finally go to the upload blog page and read the instructions on how to upload or delete a blog.</p>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <input type="submit" value="Upload Image">
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