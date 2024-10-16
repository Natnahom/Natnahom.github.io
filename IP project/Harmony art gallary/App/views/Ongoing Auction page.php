<?php
   session_start();
?>

<?php
include("storage/database.php");

if (isset($_POST['btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $artId = $_POST['artid'];
    $bid =$_POST['bid'];

    $username2 = $_SESSION['uname'];
    $password2 = $_SESSION['password'];

    // echo $username;
    // echo $password;
    // echo $username2;
    // echo $password2;

    // $sql = "SELECT uname, pass FROM users WHERE uname = '$username' AND pass = '$password'";
      $sql = "SELECT * FROM clients WHERE username = '$username' and artid = '$artId'";
      $sql3 = "SELECT * FROM clients WHERE artid = '$artId'";
      $result = mysqli_query($conn, $sql);
      $result2 = mysqli_query($conn, $sql3);

    try {
        // $result = mysqli_query($conn, $sql);
        // if (mysqli_num_rows($result) > 0) {
          // $row = mysqli_fetch_assoc($result);
            if ($username != $username2 || !password_verify($password, $password2)) {
                echo "<h3 style=\"color:red;\">Wrong username or password</h3>";
            } else {
              if (mysqli_num_rows($result) > 0) {
                      // Update the existing row
                    $sql2 = "UPDATE clients SET bid = '$bid' WHERE username = '$username' and artid = '$artId'";
                    $row = mysqli_fetch_assoc($result);
                    
                    if($artId == $row['artid'] && $bid > $row['bid']) {
                      if (mysqli_query($conn, $sql2)) {
                          echo "<h3 style=\"color:green;\">Bid updated successfully!</h3>";
                      } else {
                          echo "<h3 style=\"color:red;\">Could not update bid!</h3>";
                      }
                    }
                    else{
                      echo "<h3 style=\"color:red;\">Bid cannot be less than the previous bid</h3>";
                    }
                }
                else {
                  // if (!(mysqli_num_rows($result2) > 0)) {
                    // if (isset($result2) ) {
                    try{
                    $row2 = mysqli_fetch_assoc($result2);

                    if($artId == $row2['artid'] && $bid > $row2['bid']) {
                      $sql2 = "INSERT INTO clients (username, password, artid, bid) VALUES ('$username', '$hash', '$artId', '$bid')";
                      if (mysqli_query($conn, $sql2)) {
                          echo "<h3 style=\"color:green;\">Bid inserted successfully!</h3>";
                      } else {
                          echo "<h3 style=\"color:red;\">Could not insert bid!</h3>";
                      }
                    }
                    else if ($artId != $row2['artid']){
                      $sql2 = "INSERT INTO clients (username, password, artid, bid) VALUES ('$username', '$hash', '$artId', '$bid')";
                      if ($bid > 1500){
                        if (mysqli_query($conn, $sql2)) {
                            echo "<h3 style=\"color:green;\">Bid inserted successfully!</h3>";
                        }
                        else {
                          echo "<h3 style=\"color:red;\">Could not insert bid!</h3>";
                        }
                      }
                      else {
                        echo "<h3 style=\"color:red;\">You cannot bid less than $1500</h3>";
                      }
                      
                    }
                    
                    else{
                      echo "<h3 style=\"color:red;\">Someone else bid higher, bid a higher number than this: </h3>" . "<b>$" . $row2['bid'] . "</b>";
                    }
                  }catch (Exception $e) {
                    echo "<h3 style=\"color:red;\">" . $e->getMessage() . "</h3>";
                }
                }
            }
        // } else {
            // echo "<h3 style=\"color:red;\">Wrong username or password2</h3>";
        // }
    } catch (mysqli_sql_exception $e) {
        echo "<h3 style=\"color:red;\">An error occurred: " . $e->getMessage() . "</h3>";
    }

    // Assuming you have the necessary information about the user's bid

// Create the bidding cookie
$bid_cookie = array(
    'auction_id' => $artId,
    'bid_amount' => $bid,
    'user_name' => $username,
    'timestamp' => date('Y-m-d H:i:s') // Store the current timestamp
);

// Encode the cookie data as a JSON string
$bid_cookie_value = json_encode($bid_cookie);

// Set the cookie
$cookie_name = 'bid_info';
$cookie_value = $bid_cookie_value;
$cookie_expire = time() + (60 * 60 * 24 * 30); // Expire in 30 days
setcookie($cookie_name, $cookie_value, $cookie_expire, '/');

$bid_cookie_value = $_COOKIE['bid_info'];
$bid_cookie = json_decode($bid_cookie_value, true);

// Access the bid information
$auction_id = $bid_cookie['auction_id'];
$bid_amount = $bid_cookie['bid_amount'];
$user_name = $bid_cookie['user_name'];
$timestamp = $bid_cookie['timestamp'];

echo "Art ID: " . $auction_id . '<br>Username: '  . $user_name . '<br>Bid: ' . $bid_amount . '<br>Timestamp: ' . $timestamp;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmony Art Auction - Auctions</title>
    <link rel="icon" type="x-index" href="../../resources/images/icon.ico">
    <link rel="stylesheet" href="../../resources/css/ongoing auction stylesheet.css">
    <script src="script.js"></script>
</head>
<body>

<div class="nav-bar">
  <div>
     <ul>
          <li><a href="../../App/views/ForCust.html" class="nav-bar-items">Home</a></li>
          <li><a href="Ongoing Auction page.html" class="nav-bar-items">Auctions</a></li>
          <li><a href="artists.html" class="nav-bar-items">Artists</a></li>
          <li><a href="about.html" class="nav-bar-items">About</a></li>
          <li><a href="auth/signin.php"><button class="sign-in" type="menu">Login</button></li></a>
          <li><a href="auth/register.php"><button class="sign-up">Register</button></li></a>
          <li><a href="#" id="pp" type="profile-picture"><img src="../../resources/images/profile.png" alt="pp" class="profile-pic" ></a></li>
     </ul>
  </div>
</div>

<h1 class="fa">Ongoing Auctions</h1><br>
  <form action="Ongoing Auction page.php" method="POST">
  <label for="username" id="labForTB"><b>Bidding username: </b></label>
  <input id="textBox" type="text" name="username" placeholder="username"><br>
  <label for="password" id="labForTB"><b>Bidding password: </b></label>
  <input id="textBox" type="password" name="password" placeholder="password"><br>
  <label for="artid" id="labForTB"><b>Art ID: </b></label>
  <input id="textBox" type="text" name="artid" placeholder="art id"><br>
  <label for="bid" id="labForTB"><b>Bid: </b></label>
  <input id="textBox" type="number" name="bid" placeholder="bid"><br>
  <input type="submit" value="Bid" class="view-auction" id="btn1" name="btn" style="color:white; background-color:green; width:50px; height:30px; margin-left:100px; border:none; border-radius:10px; cursor:pointer;"><!--Bid</button>-->
  </form>
  <div id="countdown"></div>

<div class="Auctions">
  <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/image.jpg" target="_blank"><img src="../../resources/images/image.jpg" alt="img1" class="img"></a>
        <div class="auction-details">
          <!-- <form action="Ongoing Auction page.php" method="POST"> -->
          <p class="artist-name"><h2>Aida Negash(art1)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
          <p class="current-bid" id="art1">Current Bid:
                        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art1'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?> <!--<label id="p1">1500</label>--></p>
          <!-- <button type="submit" value="Bid" class="view-auction" id="btn1" name="btn" onclick="func2()">Bid</button> -->
          <button class="view-auction" id="btn1" name="btn1" onclick="func2()">Bid</button>
          <label class="sold"></label>
        </div>
      </div>
    </div>
  <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/image1.jpg" target="_blank"><img src="../../resources/images/image1.jpg" alt="img2" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Aida Negash(art2)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
          <p class="current-bid" id="art2">Current Bid: 
                        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art2'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>--></p>
          <button class="view-auction" id="btn2" name="btn2" onclick="func2()">Bid</button>
          <label class="sold"></label>
      </div>
      </div>
    </div>
  <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/image2.jpg" target="_blank"><img src="../../resources/images/image2.jpg" alt="img3" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Aida Negash(art3)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art3">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art3'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>--></p>
          <button class="view-auction" id="btn3" onclick="func2()">Bid</button>
          <label class="sold"></label>
        </div>
      </div>
    </div>
  <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/image3.jpg" target="_blank"><img src="../../resources/images/image3.jpg" alt="img4" class="img"></a>
        <div class="auction-details">
           <p class="artist-name"><h2>Zara Abatee(art4)</h2></p>
           <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art4">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art4'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
           <button class="view-auction" id="btn4" onclick="func2()">Bid</button>
           <label class="sold"></label>
          </div>
     </div>
    </div>
  <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/image4.jpg" target="_blank"><img src="../../resources/images/image4.jpg" alt="img5" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Zara Abatee(art5)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art5">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art5'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
          <button class="view-auction" id="btn5" onclick="func2()">Bid</button>
          <label class="sold"></label>
        </div>
      </div>
    </div>
  <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/image5.jpg" target="_blank"><img src="../../resources/images/image5.jpg" alt="img6" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Yonas Birhanu(art6)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art6">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art6'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
          <button class="view-auction" id="btn6" onclick="func2()">Bid</button>
          <label class="sold"></label>
        </div>
      </div>
    </div>
  <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/image6.jpg" target="_blank"><img src="../../resources/images/image6.jpg" alt="img7" class="img"></a>
      <div class="auction-details">
        <p class="artist-name"><h2>Yonas Birhanu(art7)</h2></p>
        <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art7">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art7'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
        <button class="view-auction" id="btn7" onclick="func2()">Bid</button>
        <label class="sold"></label>
      </div>
    </div>
  </div>
  <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/image7.jpg" target="_blank"><img src="../../resources/images/image7.jpg" alt="img8" class="img"></a>
      <div class="auction-details">
        <p class="artist-name"><h2>Yonas Birhanu(art8)</h2></p>
        <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art8">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art8'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
        <button class="view-auction" id="btn8" onclick="func2()">Bid</button>
        <label class="sold"></label>
    </div>
    </div>
  </div>
  <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/image8.jpg" target="_blank"><img src="../../resources/images/image8.jpg" alt="img9" class="img"></a>
      <div class="auction-details">
        <p class="artist-name"><h2>Meron Haile(art9)</h2></p>
        <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art9">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art9'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
        <button class="view-auction" id="btn9" onclick="func2()">Bid</button>
        <label class="sold"></label>
    </div>
    </div>
  </div>
  <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/image9.jpg" target="_blank"><img src="../../resources/images/image9.jpg" alt="img10" class="img"></a>
      <div class="auction-details">
        <p class="artist-name"><h2>Meron Haile(art10)</h2></p>
        <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art10">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art10'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
        <button class="view-auction" id="btn10" onclick="func2()">Bid</button>
        <label class="sold"></label>
    </div>
    </div>
  </div>
  <div class="images">  
    <div class="image-with-details">
      <a href="../../resources/images/image11.jpg" target="_blank"><img src="../../resources/images/image11.jpg" alt="img1" class="img"></a>
      <div class="auction-details">
         <p class="artist-name"><h2>Henok Desta(art11)</h2></p>
         <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art11">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art11'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
         <button class="view-auction" id="btn11" onclick="func2()">Bid</button>
         <label class="sold"></label>
    </div>
    </div>
  </div>
    <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/image12.jpg" target="_blank"><img src="../../resources/images/image12.jpg" alt="img2" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Henok Desta(art12)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art12">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art5'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
          <button class="view-auction" id="btn12" onclick="func2()">Bid</button>
          <label class="sold"></label>
      </div>
      </div>
    </div>
    <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/1.jpg" target="_blank"><img src="../../resources/images/1.jpg" alt="img3" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Henok Desta(art13)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art13">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art13'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
          <button class="view-auction" id="btn13" onclick="func2()">Bid</button>
          <label class="sold"></label>
      </div>
      </div>
    </div>
    <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/2.jpg" target="_blank"><img src="../../resources/images/2.jpg" alt="img4" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Henok Desta(art14)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art14">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art14'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
          <button class="view-auction" id="btn14" onclick="func2()">Bid</button>
          <label class="sold"></label>
      </div>
      </div>
    </div>
    <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/3.jpg" target="_blank"><img src="../../resources/images/3.jpg" alt="img5" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Rahel Kebede(art15)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art15">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art15'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
          <button class="view-auction" id="btn15" onclick="func2()">Bid</button>
          <label class="sold"></label>
      </div>
      </div>
    </div>
    <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/4.jpg" target="_blank"><img src="../../resources/images/4.jpg" alt="img6" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Tewodros Hailu(art16)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art16">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art16'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
          <button class="view-auction" id="btn16" onclick="func2()">Bid</button>
          <label class="sold"></label>
      </div>
      </div>
    </div>
    <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/5.jpg" target="_blank"><img src="../../resources/images/5.jpg" alt="img7" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Solomon Tadesse(art17)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art17">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art17'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
          <button class="view-auction" id="btn17" onclick="func2()">Bid</button>
          <label class="sold"></label>
      </div>
      </div>
    </div>
    <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/6.jpg" target="_blank"><img src="../../resources/images/6.jpg" alt="img8" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Solomon Tadesse(art18)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art18">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art18'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
          <button class="view-auction" id="btn18" onclick="func2()">Bid</button>
          <label class="sold"></label>
      </div>
      </div>
    </div>
    <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/7.jpg" target="_blank"><img src="../../resources/images/7.jpg" alt="img9" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Solomon Tadesse(art19)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art19">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art19'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
          <button class="view-auction" id="btn19" onclick="func2()">Bid</button>
          <label class="sold"></label>
      </div>
      </div>
    </div>
    <div class="images">
      <div class="image-with-details">
        <a href="../../resources/images/8.jpg" target="_blank"><img src="../../resources/images/8.jpg" alt="img10" class="img"></a>
        <div class="auction-details">
          <p class="artist-name"><h2>Solomon Tadesse(art20)</h2></p>
          <p class="start-date">Start Date: 2023-10-25</p>
        <p class="current-bid" id="art20">Current Bid: 
        <?php
                        $sql4 = "SELECT * FROM clients WHERE artid = 'art20'";
                        $result3 = mysqli_query($conn, $sql4);
                        $highest_bid = 0;
                        
                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if ($row3['bid'] > $highest_bid) {
                                    $highest_bid = $row3['bid'];
                                }
                            }
                            echo "<h3 style=\"color:red;\">$" . $highest_bid . "</h3>";
                        } else {
                            echo "<h3 style=\"color:red;\">$1500</h3>";
                        }
                            ?><!--$<label id="p2">1500</label>-->
        </p>
          <button class="view-auction" id="btn20" onclick="func2()">Bid</button>
          <label class="sold"></label>
      </div>
      </div>
    </div>
</div>
<?php
  mysqli_close($conn);
?>

<footer class="foot">
    <a href="auth/termsAndCond.html" class="foot-bar-lists">Terms and condtions</a>
    <a href="auth/privacyPolicy.html" class="foot-bar-lists">Privacy policy</a>
    <a href="auth/contact.php" class="foot-bar-lists">contact Us</a>
</footer>
</body>
</html>