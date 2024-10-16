<?php
    session_start();
?>
<?php
    include("../storage/database.php");

    if(isset($_POST['submit'])){

    $username2 = $_POST['uname'];
    $password2 = $_POST['password'];
    $sql = "SELECT uname, pass FROM users WHERE uname = '$username2'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password2, $row['pass'])) {
            $_SESSION['uname'] = $row["uname"];
            $_SESSION['password'] = $row["pass"];

            if (isset($_POST['type1']) && $_POST['type1'] === 'customer') {
                header("Location: ../Ongoing Auction page.php");
            } elseif (isset($_POST['type1']) && $_POST['type1'] === 'artist'  && !($username2 == "admin")) {
                header("Location: ../ForArtist.php");
            }
            else if (isset($_POST['type1']) && $_POST['type1'] === 'artist' && $username2 == "admin") {
                header("Location: ./admin.php");
            } else {
                echo "<h3 style=\"color:red;\">Please select a role (customer or artist)</h3>";
            }
        } else {
            echo "<h3 style=\"color:red;\">Incorrect username or password</h3>";
        }
    } else {
        echo "<h3 style=\"color:red;\">Incorrect username or password</h3>";
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
    <link rel="stylesheet" href="../../../resources/css/signin.css">
    <title>Sign in</title>
    <script src="../../views/script.js"></script>
</head>
<body>
    <div class="container">
    <h2>Signin</h2>
    <p>Signin and get full access to our resource</p>
    <form action="signin.php" method="POST">

        <label for="username">Username</label>
        <input id="textBox" class="textBox" type="text" name="uname" placeholder="Username" required/><br>
        
        <label for="type">Customer</label>
        <input id="select1" type="radio" name="type1" value="customer" required><br>
        <label for="type">Artist</label>
        <input id="select2" type="radio" name="type1" value="artist" required><br>
        <label for="password">Password</label>
        <input id="textBox2" class="textBox" type="password" name="password" placeholder="Password" required/><br><br>
        
        <input id="btn" type="submit" name="submit" value="Signin" onclick="func1()"/><br><br>
        <input id = "btn2" type="reset" value="Reset"/>
    
    </form>
    </div>


</body>
</html>