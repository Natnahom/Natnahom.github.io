<?php
    include("../storage/database.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $search = $_POST["search"];
    $table = $_POST["table"];
    $sql = "";

    if ($table == "users") {
        if (empty($search)){
            $sql = "SELECT * FROM users";            
        }
        else{
            $sql = "SELECT * FROM users WHERE name = '$search'";            
        }
    } elseif ($table == "clients") {
        if (empty($search)){
            $sql = "SELECT * FROM clients";
        }
        else {
            $sql = "SELECT * FROM clients WHERE username = '$search'";            
        }
    } elseif ($table == "arts") {
        if (empty($search)){
            $sql = "SELECT * FROM arts";
        }
        else {
            $sql = "SELECT * FROM arts WHERE full_name = '$search'";            
        }
    } elseif ($table == "emailservice") {
        if (empty($search)){
            $sql = "SELECT * FROM emailservice";
        }
        else {
            $sql = "SELECT * FROM emailservice WHERE name = '$search'";            
        }
    } 
    elseif ($table == "showall") {
        echo "<h3>Users</h3>";
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Username</th><th>Email</th><th>Phone</th><th>Date</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["uname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["date"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No data found.";
        }

        echo "<h3>Clients</h3>";
        $sql = "SELECT * FROM clients";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Username</th><th>ArtID</th><th>Bid</th><th>Date</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["artid"] . "</td><td>" . $row["bid"] . "</td><td>" . $row["date"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No data found.";
        }

        echo "<h3>Arts</h3>";
        $sql = "SELECT * FROM arts";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>StartDate</th><th>MinimumBid</th><th>ArtID</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["full_name"] . "</td><td>" . $row["StartDate"] . "</td><td>" . $row["MinimumBid"] . "</td><td>" . $row["ArtID"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No data found.";
        }

        echo "<h3>Email service</h3>";
        $sql = "SELECT * FROM emailservice";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Message</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["email"] . "</td><td>" . $row["message"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No data found.";
        }
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
            if ($table == "users"){
                echo "<h3>Users</h3>";
                echo "<tr><th>ID</th><th>Name</th><th>Username</th><th>Email</th><th>Phone</th><th>Date</th></tr>";               
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["uname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["date"] . "</td></tr>";
                }
            }
            else if($table == "clients"){
                echo "<h3>Clients</h3>";
                echo "<tr><th>ID</th><th>Username</th><th>ArtID</th><th>Bid</th><th>Date</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["username"] . "</td><td>" . $row["artid"] . "</td><td>" . $row["bid"] . "</td><td>" . $row["date"] . "</td></tr>";
                }
            }
            else if($table == "arts"){
                echo "<h3>Arts</h3>";
                echo "<tr><th>ID</th><th>Name</th><th>StartDate</th><th>MinimumBid</th><th>ArtID</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["full_name"] . "</td><td>" . $row["StartDate"] . "</td><td>" . $row["MinimumBid"] . "</td><td>" . $row["ArtID"] . "</td></tr>";
                }
            }
            else if($table == "emailservice"){
                echo "<h3>Email service</h3>";
                echo "<tr><th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Message</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["phone"] . "</td><td>" . $row["email"] . "</td><td>" . $row["message"] . "</td></tr>";
                }
            }
        
        echo "</table>";
    } else {
        echo "No data found.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.radio-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

.radio-group input[type="radio"] {
    margin-right: 10px;
}

#search{
    border-radius: 50px;
    background-color: #333333;
    width: 250px;
    height: 40px;
    font-size: 18px;
    color: #f2f2f2;
}

#button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
}

#button:hover {
    background-color: #45a049;
}

#data-container {
    margin-top: 20px;
    padding: 20px;
    background-color: #f2f2f2;
    border-radius: 5px;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        <form id="admin-form" action="admin.php" method="post">
            <div class="radio-group">
                <input type="text" name="search" id="search" placeholder="Search...">
                <input type="radio" id="users" name="table" value="users">
                <label for="users">Users</label>
                <input type="radio" id="clients" name="table" value="clients">
                <label for="clients">Clients</label>
                <input type="radio" id="arts" name="table" value="arts">
                <label for="arts">Arts</label>
                <input type="radio" id="emailservice" name="table" value="emailservice">
                <label for="emailservice">Email Service</label>
                <input type="radio" id="showall" name="table" value="showall">
                <label for="showall">Show All</label>
            </div>
            <input id="button" type="submit" value="View Data" name="submit">
        </form>
        <div id="data-container"></div>
    </div>
</body>
</html>