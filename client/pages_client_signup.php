<?php
session_start();
include('conf/config.php');

//register new account
if (isset($_POST['create_account'])) {
  $name = $_POST['name'];
  $national_id = $_POST['national_id'];
  $client_number = $_POST['client_number'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = sha1(md5($_POST['password']));
  $address  = $_POST['address'];

  $query = "INSERT INTO iB_clients (name, national_id, client_number, phone, email, password, address) VALUES (?,?,?,?,?,?,?)";
  $stmt = $mysqli->prepare($query);
  $rc = $stmt->bind_param('sssssss', $name, $national_id, $client_number, $phone, $email, $password, $address);
  $stmt->execute();

  if ($stmt) {
    $success = "Account Created";
  } else {
    $err = "Please Try Again Or Try Later";
  }
}

$ret = "SELECT * FROM `iB_SystemSettings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute();
$res = $stmt->get_result();
while ($auth = $res->fetch_object()) {
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php include("dist/_partials/head.php"); ?>

<style>
  .error-message {
    color: #dc3545;
    font-size: 13px;
    margin-top: 4px;
    display: none;
  }
  .form-control.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 4px rgba(220, 53, 69, 0.4);
  }
  .form-control.is-valid {
    border-color: #28a745;
    box-shadow: 0 0 4px rgba(40, 167, 69, 0.4);
  }
  /* signup.css */

/* Background styling */
body.login-page {
  background: linear-gradient(135deg, #6a11cb, #2575fc);
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

/* Signup box container */
.login-box {
  width: 450px;
  margin: auto;
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
  border-radius: 14px;
  overflow: hidden;
  background: rgba(255, 255, 255, 0.95);
  animation: fadeIn 0.8s ease-in-out;
}

/* Animation */
@keyframes fadeIn {
  from {
    transform: translateY(-40px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

/* Logo / Title */
.login-logo p {
  font-size: 24px;
  font-weight: bold;
  margin: 15px;
  color: #fff;
  text-align: center;
  background: linear-gradient(135deg, #2575fc, #6a11cb);
  padding: 10px;
  border-radius: 0 0 12px 12px;
}

/* Card styling */
.card {
  border-radius: 12px;
  border: none;
  background: #fff;
}

/* Card body */
.login-card-body {
  padding: 25px;
}

/* Form message */
.login-box-msg {
  font-size: 15px;
  margin-bottom: 20px;
  color: #666;
  text-align: center;
}

/* Input fields */
.input-group .form-control {
  border-radius: 8px 0 0 8px;
  border: 1px solid #ccc;
  padding: 12px;
  transition: all 0.3s ease;
}

.input-group .form-control:focus {
  border-color: #2575fc;
  box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
}

.input-group-text {
  border-radius: 0 8px 8px 0;
  background: #f8f9fa;
  border: 1px solid #ccc;
  color: #666;
}

/* Buttons */
.btn-success {
  border-radius: 8px;
  font-weight: bold;
  background: #28a745;
  border: none;
  padding: 10px;
  transition: all 0.3s ease;
}

.btn-success:hover {
  background: #218838;
}

.btn-danger {
  border-radius: 8px;
  font-weight: bold;
  border: none;
  padding: 10px;
  width: 100%;
  transition: all 0.3s ease;
}

.btn-danger:hover {
  background: #c82333;
}

/* Links */
.text-center {
  display: block;
  margin-top: 15px;
  font-size: 14px;
  color: #2575fc !important;
  font-weight: bold;
  text-decoration: none;
}

.text-center:hover {
  text-decoration: underline;
}

</style>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <p><?php echo $auth->sys_name; ?> - Sign Up</p>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign Up To Use Our IBanking System</p>

        <form method="post" id="signupForm">
          <div class="input-group mb-3">
            <input type="text" name="name" required class="form-control" placeholder="Client Full Name">
            <div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
          </div>
          <small class="error-message"></small>

          <div class="input-group mb-3">
            <input type="text" required name="national_id" class="form-control" placeholder="Aadhar Number">
            <div class="input-group-append"><div class="input-group-text"><span class="fas fa-tag"></span></div></div>
          </div>
          <small class="error-message"></small>

          <div class="input-group mb-3" style="display:none">
            <?php $length = 4; $_Number =  substr(str_shuffle('0123456789'), 1, $length); ?>
            <input type="text" name="client_number" value="iBank-CLIENT-<?php echo $_Number; ?>" class="form-control" placeholder="Client Number">
            <div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
          </div>

          <div class="input-group mb-3">
            <input type="text" name="phone" required class="form-control" placeholder="Client Phone Number">
            <div class="input-group-append"><div class="input-group-text"><span class="fas fa-phone"></span></div></div>
          </div>
          <small class="error-message"></small>

          <div class="input-group mb-3">
            <input type="text" name="address" required class="form-control" placeholder="Client Address">
            <div class="input-group-append"><div class="input-group-text"><span class="fas fa-map-marker"></span></div></div>
          </div>
          <small class="error-message"></small>

          <div class="input-group mb-3">
            <input type="email" name="email" required class="form-control" placeholder="Email Address">
            <div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
          </div>
          <small class="error-message"></small>

          <div class="input-group mb-3">
            <input type="password" name="password" required class="form-control" placeholder="Password">
            <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
          </div>
          <small class="error-message"></small>

          <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
              <button type="submit" name="create_account" class="btn btn-success btn-block">Sign Up</button>
              <a href="../index.php" class="btn btn-danger mt-2">Home</a>
            </div>
          </div>
        </form>

        <p class="mb-0"><a href="pages_client_index.php" class="text-center">Login</a></p>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const form = document.getElementById("signupForm");

      function setError(input, message) {
        const errorMsg = input.parentElement.parentElement.querySelector(".error-message");
        input.classList.add("is-invalid");
        input.classList.remove("is-valid");
        errorMsg.innerText = message;
        errorMsg.style.display = "block";
      }

      function setSuccess(input) {
        const errorMsg = input.parentElement.parentElement.querySelector(".error-message");
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        errorMsg.style.display = "none";
      }

      form.addEventListener("submit", function (e) {
        let valid = true;

        const name = form.name;
        if (name.value.trim().length < 3) {
          setError(name, "Name must be at least 3 characters.");
          valid = false;
        } else {
          setSuccess(name);
        }

        const nationalId = form.national_id;
        if (!/^\d{12}$/.test(nationalId.value.trim())) {
          setError(nationalId, "Aadhar Number must be 12 digits.");
          valid = false;
        } else {
          setSuccess(nationalId);
        }

        const phone = form.phone;
        if (!/^\d{10}$/.test(phone.value.trim())) {
          setError(phone, "Phone number must be 10 digits.");
          valid = false;
        } else {
          setSuccess(phone);
        }

        const address = form.address;
        if (address.value.trim().length < 5) {
          setError(address, "Address must be at least 5 characters.");
          valid = false;
        } else {
          setSuccess(address);
        }

        const email = form.email;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.value.trim())) {
          setError(email, "Enter a valid email address.");
          valid = false;
        } else {
          setSuccess(email);
        }
        const password = this.password;
if (!/^(?=.*[A-Za-z])(?=.*\d).{6,}$/.test(password.value.trim())) {
    setError(password, "Password must be at least 6 characters and include letters & numbers.");
} else {
    setSuccess(password);
}



      });
    });
  </script>
</body>
</html>
<?php } ?>
