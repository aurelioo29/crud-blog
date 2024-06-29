<?php
require 'connection.php';
require 'count_data.php';

session_start();

if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] !== true) {
  header("Location: login.php");
  exit;
}

if (isset($_POST['logout'])) {
  $stmt = $conn->prepare("UPDATE register SET status_login = false, logout_date = NOW() WHERE user_id = ?");
  $stmt->bind_param("s", $_SESSION['email']);
  $stmt->execute();

  session_unset();
  session_destroy();
  header("Location: login.php");
  exit;
}

$all = select("SELECT * FROM blog");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Home Page</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="sidebar">
    <h1><?php echo htmlspecialchars($_SESSION['name']); ?></h1>
    <a href="create.php">CREATE NOTE <i class='bx bx-notepad'></i></a>
    <form action="" method="post" class="logout-form">
      <button type="submit" name="logout" class="logout-button">Logout</button>
    </form>
  </div>

  <div class="content">
    <h1>Notes</h1>
    <p>Total notes now is <b><?php echo $row["total"]; ?></b> Notes...</p>

    <?php foreach ($all as $row) : ?>
      <div class="card">
        <h1><?php echo $row['title']; ?></h1>
        <p><?php echo $row['content']; ?></p>
        <p><?php echo $row['create_at']; ?></p>
        <a href="edit.php?id=<?php echo $row['id'] ?>">Edit</a>
        <form method="post" action="index.php" style="display:inline;">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button type="submit" name="delete">DELETE</button>
        </form>
      </div>
    <?php endforeach ?>
  </div>
</body>

</html>