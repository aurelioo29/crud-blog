<?php
include 'connection.php';

$id = $_GET["id"];

$data = select("SELECT * FROM blog WHERE id = $id")[0];
// var_dump($data['title']);

if (isset($_POST['submit'])) {
  if (update($_POST) > 0) {
    echo "
    <script>
      alert('data berhasil diubah');
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
  <title>Form Update</title>
</head>

<body>
  <form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required value="<?php echo $data['title'] ?>"><br><br>

    <label for="content">Content:</label><br>
    <input type="text" id="content" name="content" required value="<?php echo $data['content'] ?>"><br><br>

    <button type="submit" name="submit">Create Note</button>
  </form>
</body>

</html>