<?php
include 'connection.php';

if (isset($_POST['create_note'])) {
  if (add($_POST) > 0) {
    echo "
      <script>
        alert('data berhasil tambah');
        document.location.href = 'index.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('data gagal');
      </script>
    ";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="create.css">
  <title>Form Create</title>
</head>

<body>
  <form action="" method="post">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="content">Content:</label><br>
    <input type="text" id="content" name="content" required><br><br>

    <button type="submit" name="create_note">Create Note</button>
  </form>
</body>

</html>