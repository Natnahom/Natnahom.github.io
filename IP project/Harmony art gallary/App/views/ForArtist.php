<?php
   session_start();
?>

<?php
    include("./storage/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['button'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['Fullname'];
        $StDate = $_POST['StDate'];
        $MinBid = $_POST['MinBid'];
        $ArtId = $_POST['artId'];

        $username2 = $_SESSION['uname'];
        $password2 = $_SESSION['password'];

        $sql = "INSERT INTO arts (full_name,StartDate,MinimumBid,ArtID) VALUES ('$fullname','$StDate','$MinBid','$ArtId')";

        $sql2 = "SELECT * FROM arts WHERE ArtID = '$ArtId'";
        $result = mysqli_query($conn, $sql2);

        if ($username == $username2 && password_verify($password, $password2)) {
            try {
                if (mysqli_num_rows($result) == 0) {
                    mysqli_query($conn, $sql);
                    echo "<h3 style = \"color:green;\">User inserted successfully!</h3>";
                } else {
                    echo "<h3 style = \"color:red;\">Could not insert user!<br>May be the art name is already taken!</h3>";
                }
            } catch (mysqli_sql_exception $e) {
                echo "<h3 style = \"color:red;\">Could not insert user!</h3>";
            }
        } else {
            echo "<h3 style = \"color:red;\">Invalid username or password!</h3>";
        }
    }

    if ($username == $username2 && password_verify($password, $password2)) {
    // Image upload code
    if (isset($_FILES["image"])) {
        $targetDirectory = "./uploads/"; // Use an absolute path if needed
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $uploadOk = true;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the uploaded file is an image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "Error: Please upload a valid image file.";
            $uploadOk = false;
        }

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "Error: File already exists.";
            $uploadOk = false;
        }

        // Allow only specific image file formats (you can modify this array as per your requirements)
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = false;
        }

        if ($uploadOk) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "Image uploaded successfully.";
            } else {
                echo "Error: There was a problem uploading the image.";
            }
        }
    }
}
  
}

mysqli_close($conn);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmony Art Auction</title>
    <link rel="icon" type="x-index" href="../../resources/images/icon.ico">
    <link rel="stylesheet" href="../../resources/css/styleForArtist.css">
    <script src="https://kit.fontawesome.com/8693f8f216.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>
<body>

<section class="home">
<div class="nav-bar">
  <div>
     <ul>
          <li class="logo" type="logo"><a href="../views/index.html"><img src="../../resources/images/logo.png" alt="logo" width="200" height="200"></a></li>
          <li><a href="../../App/views/ForArtist.php" class="nav-bar-items">Home</a></li>
          <li><a href="artists.html" class="nav-bar-items">Artists</a></li>
          <li><a href="about.html" class="nav-bar-items">About</a></li>
          <li><a href="auth/signin.php"><button class="sign-in" type="menu">Login</button></li></a>
          <li><a href="auth/register.php"><button class="sign-up">Register</button></li></a>
          <li><a href="#" id="pp" type="profile-picture"><img src="../../resources/images/profile.png" alt="pp" class="profile-pic" ></a></li>
     </ul>
     <h1><span>Upload</span> your arts for a bidding and <br> get <span>recognized!</span></h1><br><br>
     <h4>Compete with the best artists and get selected by our team. <br> 
      We select the best artwork; this will increase your popularity <br> and recognition!</h4>
    </div>
</div>
</section>

<div class="cont">
  <h1>About Harmony Art Auction</h1>
  <p>Welcome to Harmony Art Auction, the premier online platform for art enthusiasts and collectors. Our mission is to create a harmonious space that connects artists and buyers from around the world.</p>

  <a href="about.html"><button class="learn-more" type="menu">Learn more</button></a>
</div>

<section class="uploadSect">
  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
  <label for="id" id="labForTB"><b>Uploading username: </b></label>
  <input id="textBox" type="text" name="username" placeholder="username" required><br>
  <label for="password" id="labForTB"><b>Uploading password: </b></label>
  <input id="textBox" type="password" name="password" placeholder="password" required>

  <div class="container" id="imgBox"></div>
  <input type="file" accept="image/*" name="image" id="image" style="display: none;" onchange="loadFile(event)">
  <label for="image"><img src="../../resources/images/uploadicon.png" class="upload_icon" title="Upload art"></label>

</section>

  <div class="container2">
    <label for="name"><b>Full name: </b></label><br>
    <input class="textBox" id="Fullname" type="text" name="Fullname" placeholder="full name" required><br>
    <label for="name"><b>Starting date: </b></label><br>
    <input class="textBox" id="StDate" type="text" name="StDate" placeholder="starting date" required><br>
    <label for="name"><b>Minimum bid: </b></label><br>
    <input class="textBox" id="MinBid" type="text" name="MinBid" placeholder="minimum bid" required><br>
    <label for="name"><b>Art name: </b></label><br>
    <input class="textBox" id="artId" type="text" name="artId" placeholder="Art name" required><br>
  
    <input id="btn" type="submit" name="button" value="Submit" onclick="func3()"/><br><br>
    <input id = "btn2" type="reset" value="Reset"/><br>
  </form>
  </div>

  <footer class="foot">
    <section id="contact">
      <br><h2>Contact Us</h2><br>
      <p>If you have any questions or inquiries, please contact us at <br><br><br>
            <a href=""><i class="fa fa-facebook"></i></a>
            <a href=""><i class="fa fa-twitter"></i></a>
            <a href=""><i class="fa fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-youtube"></i></a>
            <a href=""><i class="fa-brands fa-telegram"></i></a><br><br><br>
        <i class="fa-solid fa-mobile-screen-button"></i>+251908898667<br>
        <i class="fa-solid fa-mobile-screen-button"></i>+251916707882<br><br>
            <br><i class="fa-solid fa-envelope"></i>harmonyartauction@gmail.com
      </p>
    </section>
  
      <a href="auth/termsAndCond.html" class="foot-bar-lists">Terms and condtions</a>
      <a href="auth/privacyPolicy.html" class="foot-bar-lists">Privacy policy</a>
      <a href="auth/contact.php" class="foot-bar-lists">Contact Us
  </footer>
  <h6>Copyright &copy; 2024 Harmony art auction</h6>

  <script>
    var imgBox = document.getElementById("imgBox");

    var loadFile = function(event){
      imgBox.style.backgroundImage = "url(" +URL.createObjectURL(event.target.files[0])+ ")";
    }
  </script>
</body>
</html>