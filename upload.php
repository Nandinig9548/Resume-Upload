<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resume_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$name = $_POST['name'];
$email = $_POST['email'];

$targetDir = "uploads/";
if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

$fileName = basename($_FILES["resume"]["name"]);
$targetFile = $targetDir . $fileName;

if (move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFile)) {
    $sql = "INSERT INTO resumes (name, email, file_name) VALUES ('$name', '$email', '$fileName')";
    if ($conn->query($sql) === TRUE) {
        echo "Resume uploaded successfully! <a href='list.php'>View Resumes</a>";
    } else {
        echo "Database error: " . $conn->error;
    }
} else {
    echo "File upload failed.";
}

$conn->close();
?>