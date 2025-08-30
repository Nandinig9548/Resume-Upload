<?php
$conn = new mysqli("localhost", "root", "", "resume_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM resumes ORDER BY upload_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Uploaded Resumes</title>
  <style>
    table { width: 80%; margin: 20px auto; border-collapse: collapse; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
    th { background: #007bff; color: white; }
  </style>
</head>
<body>
  <h2 style="text-align:center;">Uploaded Resumes</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>File</th>
      <th>Date</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><?= $row['email'] ?></td>
      <td><a href="uploads/<?= $row['file_name'] ?>" target="_blank">Download</a></td>
      <td><?= $row['upload_date'] ?></td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>