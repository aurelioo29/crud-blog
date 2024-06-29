<?php

require 'connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $remember = isset($_POST['remember']) ? $_POST['remember'] : '';

  // $servername = "localhost";
  // $username = "root";
  // $password_db = "";
  // $dbname = "db_test_web";

  // $conn = new mysqli($servername, $username, $password_db, $dbname);

  // if ($conn->connect_error) {
  //   die("Connection failed: " . $conn->connect_error);
  // }
  $sql = "SELECT * FROM register WHERE user_id=? AND pass=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    $_SESSION['status_login'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $user['name'];

    $stmt = $conn->prepare("UPDATE register SET status_login = true, login_date = NOW() WHERE user_id = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    if ($remember) {
      setcookie("email", $email, time() + (18000 * 30), "/");
    }

    header("Location: index.php");
    exit();
  } else {
    $error = "Username atau password salah!";
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <title>Login Page</title>
  <link rel="stylesheet" href="login.css" />
</head>

<body>
  <div class="wrapper">
    <h2>Login</h2>
    <p>Login menggunakan Gmail Anda.</p>
    <form action="" method="post">
      <div class="input-field">
        <label for="email" class="email">Email <span class="req">*</span></label>
        <input type="email" name="email" id="email" placeholder="Input Email" required />
      </div>
      <div class="input-field">
        <label for="password" class="password">Password <span class="req">*</span></label>
        <input type="password" name="password" id="password" placeholder="Type your password" required />
        <label for="password"><i class="bx bxs-low-vision"></i></label>
      </div>

      <div class="input-field">
        <input type="checkbox" name="remember" id="remember" />
        <label for="remember" class="remember">Remember me</label>
      </div>
      <button type="submit" class="login">Login</button>
    </form>
  </div>
</body>

</html>