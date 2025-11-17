<?php
session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();
$staff_id = $_SESSION['staff_id'];

// register new account
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
input.form-control {
    border-radius: 6px;
    transition: all 0.3s ease;
}

input.form-control.is-valid {
    border: 2px solid #28a745;
    background-color: #eaffea;
}

input.form-control.is-invalid {
    border: 2px solid #dc3545;
    background-color: #ffeaea;
}

small.error-text {
    color: #dc3545;
    display: none;
    font-size: 13px;
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
                    <form id="clientForm" method="post" enctype="multipart/form-data" role="form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Client Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                    <small class="error-text">Name must only contain letters & spaces</small>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Client Number</label>
                                    <?php
                                    $length = 4;
                                    $_Number = substr(str_shuffle('0123456789'), 1, $length);
                                    ?>
                                    <input type="text" readonly name="client_number" value="iBank-CLIENT-<?php echo $_Number; ?>" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Client Phone Number</label>
                                    <input type="text" name="phone" class="form-control" required>
                                    <small class="error-text">Phone must be 10 digits</small>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Client National ID No.</label>
                                    <input type="text" name="national_id" class="form-control" required>
                                    <small class="error-text">National ID must be 12 digits</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Client Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                    <small class="error-text">Enter a valid email address</small>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Client Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                    <small class="error-text">Password must be ≥ 6 chars with letters & numbers</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Client Address</label>
                                    <input type="text" name="address" class="form-control" required>
                                    <small class="error-text">Address cannot be empty</small>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Client Profile Picture</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="profile_pic" class="custom-file-input">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
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

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function () {
    bsCustomFileInput.init();

    const form = document.getElementById("clientForm");

    form.addEventListener("submit", function (e) {
        let valid = true;

        // name
        const name = form.name;
        if (!/^[A-Za-z ]+$/.test(name.value.trim())) {
            setError(name);
            valid = false;
        } else setSuccess(name);

        // phone
        const phone = form.phone;
        if (!/^[0-9]{10}$/.test(phone.value.trim())) {
            setError(phone);
            valid = false;
        } else setSuccess(phone);

        // national id
        const nid = form.national_id;
        if (!/^[0-9]{12}$/.test(nid.value.trim())) {
            setError(nid);
            valid = false;
        } else setSuccess(nid);

        // email
        const email = form.email;
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            setError(email);
            valid = false;
        } else setSuccess(email);

        // password
        const password = form.password;
        if (!/^(?=.*[A-Za-z])(?=.*\d).{6,}$/.test(password.value.trim())) {
            setError(password);
            valid = false;
        } else setSuccess(password);

        // address
        const address = form.address;
        if (address.value.trim() === "") {
            setError(address);
            valid = false;
        } else setSuccess(address);

        if (!valid) e.preventDefault();
    });

    function setError(input) {
        input.classList.add("is-invalid");
        input.classList.remove("is-valid");
        input.nextElementSibling.style.display = "block";
    }

    function setSuccess(input) {
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");
        input.nextElementSibling.style.display = "none";
    }
});
</script>
</body>
</html>
