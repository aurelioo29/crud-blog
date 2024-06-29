<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_test_web');

if (!$conn) {
  echo "Connection to database failed";
}

function select($query)
{
  global $conn;

  $result = mysqli_query($conn, $query);
  $blogs = [];

  while ($blog = mysqli_fetch_assoc($result)) {
    $blogs[] = $blog;
  }

  return $blogs;
}

function update($data)
{
  global $conn;

  $id = $data['id'];
  $title = htmlspecialchars($data['title']);
  $content = htmlspecialchars($data['content']);

  $query = "UPDATE blog SET title = '$title', content = '$content' WHERE id = $id";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function add($data)
{
  global $conn;

  $title = htmlspecialchars($data['title']);
  $content = htmlspecialchars($data['content']);

  $query = "INSERT INTO blog (title, content) VALUES ('$title', '$content')";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

if (isset($_POST['delete'])) {
  $id = $_POST["id"];

  $query = "DELETE FROM blog WHERE id = $id";

  mysqli_query($conn, $query);

  if (mysqli_affected_rows($conn) > 0) {
    echo "
    <script>
      alert('data berhasil dihapus');
    </script>
  ";
  }
}
