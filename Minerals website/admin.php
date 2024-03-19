<?php
// Get the submitted email and password
$storedEmail = "afrisourceminerals@gmail.com";
$storedPassword = "abcD1234";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == $storedEmail && $password == $storedPassword) {
        // Redirect to the desired page
        header("Location: uploadingImg/UPI_index.php");
        exit;
    } else {
      header("Location: blog.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/logo.png">
    <title>Administrator - Afrisource Minerals and Farm PLC</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

body{
  /*background-color: rgb(15, 11, 11);*/
  background: #f1f1f1;
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

.admin-section{
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background: #f2f2f2;
}

.cont3 {
  margin-top: 10%;
  margin-bottom: 10%;
  padding: 20px;
  width: 50%;
  background: rgb(15, 11, 11);
  box-shadow: 0 15px 17px rgba(0, 0, 0, 0.8);
  border-radius: 10px;
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
  font-size: 25px;
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
    </style>
</head>
<body>
<section class="admin-section">
      <div class="cont3">
        <form action="./admin.php" method="POST">
          <div class="input-field">
            <input type="email" id="email" name="email" placeholder="Admin Email" required>
          </div>

          <div class="input-field">
            <input type="password" id="password" name="password" placeholder="Admin Password" required>
          </div>
          
          <div class="input-field">
            <input type="submit" value="SUBMIT">
          </div>
          </form>
        </div>
</section>
</body>
</html>