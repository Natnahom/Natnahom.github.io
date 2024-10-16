
<?php
include ('../storage/database.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST["Name"];
    $phone = $_POST["Phone"];
    $email = $_POST["Email"];
    $message = $_POST["Message"];

    // Validate name (only letters and whitespaces)
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        echo "<h3 style=\"color:red; padding:20px;\">Please enter a valid name (letters and whitespaces only).</h3><br>";
    } else {
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<h3 style=\"color:red; padding:20px;\">Please enter a valid email address.</h3><br>";
        } else {
            // Prepare the SQL statement
            $sql = "INSERT INTO emailservice (name, phone, email, message)
                    VALUES (?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $phone, $email, $message);

            // Execute the SQL statement
            if ($stmt->execute()) {
                echo "<h3 style=\"color:green; padding:20px;\">Form data saved successfully.</h3>";
            } else {
                echo "<h3 style=\"color:red; padding:20px;\">Error saving form data: " . $stmt->error . "</h3>";
            }

            $stmt->close();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../resources/css/style3.css">
    <link rel="shortcut icon" type="x-icon" href="../../../resources/images/icon.ico">
    <title>Harmony Art Auction - Contact us</title>
</head>
<body>

    <section class="contact-home">
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="contact-header">
                        <h3>Contact us</h3>
                    </div>
                </div>
                <div class="col-6">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="group">
                            <input type="text" name="Name" class="control" placeholder="Enter name" required>
                        </div>
                        <div class="group">
                            <input type="text" name="Phone" class="control" placeholder="Enter phone number" required>
                        </div>
                        <div class="group">
                                <input type="email" name="Email" class="control" placeholder="Enter email" required>
                            </div>
                            <div class="group">
                               <textarea name="Message" class="control" cols="30" rows="10" placeholder="Message"></textarea>
                                </div>
                                <div class="group">
                                    <input type="submit" value="Send &rarr;" class="btn btn-default">
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</section>
</body>
</html>