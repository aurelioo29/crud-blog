<?php
$registration_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $name = $_POST['name'];
  $tgl_lahir = $_POST['tgl-lahir'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm-password'];
  $terms = isset($_POST['terms']) ? $_POST['terms'] : '';

  if ($password !== $confirm_password) {
    echo "Passwords do not match.";
    exit;
  }

  $servername = "localhost";
  $username = "root";
  $password_db = "";
  $dbname = "db_test_web";

  $conn = new mysqli($servername, $username, $password_db, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO register (user_id, name, tgl_lahir, pass) VALUES ('$email', '$name', '$tgl_lahir', '$password')";

  if ($conn->query($sql) === TRUE) {
    $registration_success = true;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register Form</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="register.css" />
</head>

<body>
  <?php if ($registration_success) : ?>
    <script>
      alert("Account created successfully");
      window.location.href = 'login.php';
    </script>
  <?php endif; ?>

  <div class="wrap">
    <h1>Register</h1>
    <p>Daftar akun menggunakan Gmail Anda.</p>
    <form action="" method="post">
      <div class="input-field">
        <label for="email">Email <span class="req">*</span></label>
        <input type="text" id="email" name="email" required />
      </div>

      <div class="input-field">
        <label for="name">Nama Lengkap <span class="req">*</span></label>
        <input type="text" id="name" name="name" required />
      </div>

      <div class="input-field full-width">
        <label for="tgl-lahir">Tanggal Lahir <span class="req">*</span></label>
        <input type="date" name="tgl-lahir" id="tgl-lahir" required />
      </div>

      <div class="input-field">
        <label for="password">Password <span class="req">*</span></label>
        <input type="password" id="password" name="password" required />
        <i class="bx bxs-low-vision toggle-password"></i>
      </div>

      <div class="input-field">
        <label for="confirm-password">Konfirmasi Password <span class="req">*</span></label>
        <input type="password" id="confirm-password" name="confirm-password" required />
        <i class="bx bxs-low-vision toggle-password"></i>
      </div>

      <div class="input-field full-width">
        <input type="checkbox" id="terms" name="terms" required /> Saya
        menyetujui ketentuan dan persyaratan yang berlaku
      </div>

      <input type="submit" value="Register" />
    </form>
  </div>

  <script>
    document.querySelectorAll('.toggle-password').forEach(icon => {
      icon.addEventListener('click', function() {
        const passwordField = this.previousElementSibling;
        if (passwordField.type === 'password') {
          passwordField.type = 'text';
          this.classList.remove('bxs-low-vision');
          this.classList.add('bxs-show');
        } else {
          passwordField.type = 'password';
          this.classList.remove('bxs-show');
          this.classList.add('bxs-low-vision');
        }
      });
    });
  </script>
</body>

</html>