<?php
    include("../storage/database.php");

    if(isset($_POST['submit'])){

    $fullname = $_POST['name'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    // $birthdate = $_POST['birthdate'];
    // $gender = $_POST['gender'];
    $password = $_POST['password'];
    $passwordC = $_POST['passwordC'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    // $country = $_POST['country'];

    $sql = "INSERT INTO users (name,uname,email,phone,pass)
            VALUES ('$fullname','$username','$email','$phone','$hash')";

    if(isset($_POST['submit'])){
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fullname)) {
            echo "<h3 style = \"color:white;\">Only letters and white space allowed!</h3>";                 
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<h3 style = \"color:white;\">Invalid email format</h3>";
        }
        else if ($password != $passwordC) {
            echo "<h3 style = \"color:white;\">Passwords don't match</h3>";
        }            
        else{
            try{
                mysqli_query($conn, $sql);
                echo "<h3 style = \"color:green;\">User inserted successfully!</h3>";
                header("Location: ../ForCust.html");  
            }
            catch (mysqli_sql_exception){
                echo "<h3 style = \"color:red;\">Could not insert user! Try by changing your username.</h3>";
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
    <link rel="icon" type="x-index" href="../../../resources/images/icon.ico">
    <link rel="stylesheet" href="../../../resources/css/register.css">
    <title>Register</title>
    <script src="../../views/script.js"></script>
</head>
<body>

    <div class="container">
    <h2>Register</h2>

    <form action="register.php" method = "POST">
        <label for="name">Full Name</label><br>
        <input id="textBox1" type="text" name="name" placeholder="Your full name" required/><br>

        <label for="name">Preferred username</label><br>
        <input id="textBox2" type="text" name="uname" placeholder="Your preferred username" required/><br>

        <label for="phone number">Email</label><br>
        <input id="textBox1" type="email" name="email" placeholder="Your email" required/><br>

        <label for="phone number">Phone</label><br>
        <input id="textBox1" type="tel" name="phone" placeholder="Your phone number" required/><br>

        <label for="date">Birthdate</label><br>
        <input id="textBox1" type="date" name="date"/><br>

        <label for="gender">Gender </label><br>
        <select name="gender" >
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br>

        <label for="password">Password</label><br>
        <input id="pass" type="password" name="password" placeholder="Your password" required/><br>
        <label for="password">Confirm</label><br>
        <input id="confP" type="password" name="passwordC" placeholder="Confirm password" required/><br>

        <label for="country">Country</label><br>
        <select name="country" >
            <option value="Ethiopia">Ethiopia</option>
            <option value="Italy">Italy</option>
            <option value="Madagascar">Madagascar</option>
            <option value="South Africa">South Africa</option>

        </select><br><br><br>

        <input id = "btn" type="submit" name="submit" value="Signup" onclick="func4()"><br><br>
        <input id = "btn2" type="reset" value="Reset">

        </div>



    </form>
</body>
</html>