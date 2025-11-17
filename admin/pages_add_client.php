<?php
session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();
$admin_id = $_SESSION['admin_id'];

//register new account
if (isset($_POST['create_staff_account'])) {
    $name = $_POST['name'];
    $national_id = $_POST['national_id'];
    $client_number = $_POST['client_number'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = sha1(md5($_POST['password']));
    $address  = $_POST['address'];

    $profile_pic  = $_FILES["profile_pic"]["name"];
    move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "dist/img/" . $_FILES["profile_pic"]["name"]);

    $query = "INSERT INTO iB_clients (name, national_id, client_number, phone, email, password, address, profile_pic) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ssssssss', $name, $national_id, $client_number, $phone, $email, $password, $address, $profile_pic);
    $stmt->execute();

    if ($stmt) {
        $success = "Client Account Created";
    } else {
        $err = "Please Try Again Or Try Later";
    }
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php include("dist/_partials/head.php"); ?>

<style>
/* ==== Custom CSS ==== */
body {
  background: #f4f6f9;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.card-purple {
  border-top: 3px solid #6f42c1;
}
.card-title {
  font-weight: bold;
  color: #6f42c1;
}
label {
  font-weight: 500;
}
.is-invalid {
  border-color: #dc3545 !important;
}
.is-valid {
  border-color: #28a745 !important;
}
.error-msg {
  font-size: 0.875em;
  color: #dc3545;
}
.success-msg {
  font-size: 0.875em;
  color: #28a745;
}
</style>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
    <?php include("dist/_partials/nav.php"); ?>
    <?php include("dist/_partials/sidebar.php"); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>Create Client Account</h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-purple">
                    <div class="card-header">
                        <h3 class="card-title">Fill All Fields</h3>
                    </div>
                    <form method="post" enctype="multipart/form-data" role="form" id="clientForm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Client Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                    <span class="error-msg"></span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Client Number</label>
                                    <?php $length = 4; $_Number =  substr(str_shuffle('0123456789'), 1, $length); ?>
                                    <input type="text" readonly name="client_number" value="iBank-CLIENT-<?php echo $_Number; ?>" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Contact</label>
                                    <input type="text" name="phone" class="form-control" required>
                                    <span class="error-msg"></span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>National ID No.</label>
                                    <input type="text" name="national_id" class="form-control" required>
                                    <span class="error-msg"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                    <span class="error-msg"></span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                    <span class="error-msg"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Client Profile Picture</label>
                                    <div class="custom-file">
                                        <input type="file" name="profile_pic" class="custom-file-input" id="exampleInputFile" required>
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" name="create_staff_account" class="btn btn-success">Add Client</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <?php include("dist/_partials/footer.php"); ?>
</div>

<!-- JS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
$(function () { bsCustomFileInput.init(); });

// === Validation ===
document.getElementById('clientForm').addEventListener('submit', function(e) {
    let valid = true;

    function setError(input, message) {
        input.classList.add("is-invalid");
        input.classList.remove("is-valid");
        input.nextElementSibling.textContent = message;
        valid = false;
    }

    function setSuccess(input) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        input.nextElementSibling.textContent = "";
    }

    const name = this.name;
    if (name.value.trim().length < 3) {
        setError(name, "Name must be at least 3 characters");
    } else { setSuccess(name); }

    const phone = this.phone;
    if (!/^[0-9]{10}$/.test(phone.value.trim())) {
        setError(phone, "Enter a valid 10-digit phone number");
    } else { setSuccess(phone); }

    const national_id = this.national_id;
    if (national_id.value.trim().length < 6) {
        setError(national_id, "National ID must be at least 6 characters");
    } else { setSuccess(national_id); }

    const email = this.email;
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
        setError(email, "Enter a valid email");
    } else { setSuccess(email); }

const password = this.password;
if (!/^(?=.*[A-Za-z])(?=.*\d).{6,}$/.test(password.value.trim())) {
    setError(password, "Password must be at least 6 characters and include letters & numbers.");
} else {
    setSuccess(password);
}

});
</script>
</body>
</html>
