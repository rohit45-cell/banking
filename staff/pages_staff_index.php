<?php
session_start();
include('conf/config.php'); //get configuration file
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = sha1(md5($_POST['password'])); //double encrypt to increase security
  $stmt = $mysqli->prepare("SELECT email, password, staff_id  FROM iB_staff  WHERE email=? AND password=?"); //sql to log in user
  $stmt->bind_param('ss', $email, $password); //bind fetched parameters
  $stmt->execute(); //execute bind
  $stmt->bind_result($email, $password, $staff_id); //bind result
  $rs = $stmt->fetch();
  $_SESSION['staff_id'] = $staff_id; //assaign session to staff id
  //$uip=$_SERVER['REMOTE_ADDR'];
  //$ldate=date('d/m/Y h:i:s', time());
  if ($rs) { //if its sucessfull
    header("location:pages_dashboard.php");
  } else {
    #echo "<script>alert('Access Denied Please Check Your Credentials');</script>";
    $err = "Access Denied Please Check Your Credentials";
  }
}

/* Persisit System Settings On Brand */
$ret = "SELECT * FROM `iB_SystemSettings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($auth = $res->fetch_object()) {
?>
  <!DOCTYPE html>
  <html>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <?php include("dist/_partials/head.php"); ?>
  <style>
    /* login.css */

/* General body background */
body.login-page {
  background: linear-gradient(135deg, #0d6efd, #20c997);
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
}

/* Login box container */
.login-box {
  width: 400px;
  margin: 80px auto;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  border-radius: 12px;
  overflow: hidden;
}

/* Logo styling */
.login-logo p {
  font-size: 26px;
  font-weight: bold;
  color: white;
  margin: 0;
  padding: 15px;
  text-align: center;
}

/* Card background */
.card {
  border-radius: 12px;
  background: #fff;
  padding: 20px;
}

/* Input fields */
.input-group .form-control {
  border-radius: 8px 0 0 8px;
  border: 1px solid #ddd;
  padding: 12px;
}

.input-group-text {
  border-radius: 0 8px 8px 0;
  background: #f0f0f0;
  border: 1px solid #ddd;
}

/* Buttons */
.btn-success {
  width: 100%;
  border-radius: 8px;
  padding: 10px;
  font-weight: bold;
  background: #28a745;
  border: none;
  transition: background 0.3s ease;
}

.btn-success:hover {
  background: #218838;
}

.btn-danger {
  width: 100%;
  border-radius: 8px;
  padding: 10px;
  font-weight: bold;
  transition: background 0.3s ease;
}

.btn-danger:hover {
  background: #c82333;
}

/* Remember me checkbox */
.icheck-primary label {
  font-size: 14px;
  color: #555;
}

/* Register link */
.text-center {
  display: block;
  text-align: center;
  margin-top: 15px;
  font-size: 14px;
  color: #0d6efd !important;
  text-decoration: none;
}

.text-center:hover {
  text-decoration: underline;
}

  </style>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <p><?php echo $auth->sys_name; ?></p>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Log In To Start Staff Session</p>

          <form method="post">
            <div class="input-group mb-3">
              <input type="email" name="email" class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
              <button type="submit" name="login" class="btn btn-success">Log In</button>
              <a href="../index.php" class="btn btn-danger mt-2">Home</a>
              </div>
              <!-- /.col -->
            </div>
          </form>


          <!-- /.social-auth-links -->

          <!-- <p class="mb-1">
            <a href="pages_reset_pwd.php">I forgot my password</a>
          </p> -->
          <!--
          Uncomment this line to allow account creations for admins
          
      <p class="mb-0">
        <a href="pages_signup.php" class="text-center">Register a new membership</a>
      </p>
      -->
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

  </body>

  </html>
<?php
} ?>