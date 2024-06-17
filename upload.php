<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "medical";
$port = 3306;

if (isset($_POST['upload'])) {
    
    $photo = $_FILES["photo"]["name"];
    $tempname = $_FILES["photo"]["tmp_name"];
    $folder = "./images/" . basename($photo);

  
    if (move_uploaded_file($tempname, $folder)) {
        echo "<div class=\"alert alert-success\">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>";
    } else {
        echo "Image upload failed.<br>";
        exit();
    }

    
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
    $readmore = isset($_POST['link']) ? htmlspecialchars($_POST['link']) : '';

  
    $conn = new mysqli($host, $username, $password, $db, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $stmt = $conn->prepare("INSERT INTO `news`(`photo`, `title`, `description`, `readmore`) VALUES (?,?,?,?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    
    $stmt->bind_param("ssss", $photo, $title, $description, $readmore);

    
    if ($stmt->execute()) {
        echo "New record created successfully.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .form-container {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
            margin-top: 50px;
            background-color: white;
        }
        .form-container img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100px;
        }
    </style>
</head>
<body>

    <div class="container"> 
    <div class="form-container">
        
        <img alt="Homepage" src="images/logo.jpeg" style="max-width: 100%; margin-bottom: 20px;">

        <form id="uploadForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" novalidate>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" name="photo" class="form-control" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please select a photo.</div>
            </div>
            <div class="form-group">
                <label for="title">Title:</label></br>
                <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" required></br>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="description">Description:</label></br>
                <textarea name="description" rows="5" class="form-control" required></textarea></br>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="link">Read More:</label></br>
                <input type="url" class="form-control" id="link" placeholder="Enter Read More" name="link" required></br>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" name="upload" value="Upload">Submit</button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
