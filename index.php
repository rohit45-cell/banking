<?php
include("admin/conf/config.php");

/* Persist System Settings On Brand */
$ret = "SELECT * FROM `iB_SystemSettings` LIMIT 1";
$stmt = $mysqli->prepare($ret);
$stmt->execute();
$res = $stmt->get_result();
$sys = $res->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $sys->sys_name; ?> - <?php echo $sys->sys_tagline; ?></title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    :root {
      --primary: #0d6efd;
      --primary-dark: #004bb5;
      --secondary: #00bfa6;
      --secondary-dark: #009e8b;
      --light: #f9fafc;
      --dark: #333;
      --gray: #eaeaea;
      --white: #ffffff;
    }

    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      background: var(--light);
      color: var(--dark);
      scroll-behavior: smooth;
    }

    /* Navbar */
    nav {
      background: rgba(255, 255, 255, 0.95);
      border-bottom: 2px solid var(--gray);
      padding: 14px 40px;
      position: sticky;
      top: 0;
      z-index: 1000;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: all 0.3s ease;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    nav.scrolled {
      background: var(--primary);
      border-bottom: 2px solid var(--primary-dark);
    }

    nav.scrolled .navbar-brand,
    nav.scrolled ul li a {
      color: var(--white) !important;
    }

    nav .navbar-brand {
      font-weight: 700;
      font-size: 1.6rem;
      color: var(--primary);
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.3s ease;
    }

    nav .navbar-brand:hover {
      transform: scale(1.05);
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
      margin: 0;
      padding: 0;
    }

    nav ul li a {
      text-decoration: none;
      color: var(--dark);
      font-weight: 500;
      padding: 6px 0;
      border-bottom: 2px solid transparent;
      transition: all 0.3s ease;
    }

    nav ul li a:hover,
    nav ul li a.active {
      color: var(--primary);
      border-bottom: 2px solid var(--primary);
    }

    .btn-join {
      background: var(--primary);
      color: var(--white);
      padding: 10px 22px;
      border-radius: 30px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      border: 2px solid var(--primary-dark);
    }

    .btn-join:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }

    /* Hero Section */
    .intro {
      position: relative;
      height: 85vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: var(--white);
      overflow: hidden;
    }

    .intro img {
      position: absolute;
      width: 100%; height: 100%;
      object-fit: cover;
      filter: brightness(0.6);
    }

    .intro-content {
      position: relative;
      z-index: 2;
      animation: fadeInUp 1.2s ease-in-out;
    }

    .intro-content h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 15px;
    }

    .intro-content p {
      font-size: 1.3rem;
      margin-bottom: 25px;
    }

    .btn-primary, .btn-secondary {
      padding: 14px 35px;
      border-radius: 30px;
      font-weight: 600;
      margin: 8px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-primary {
      background: var(--secondary);
      color: var(--white);
    }

    .btn-primary:hover {
      background: var(--secondary-dark);
      transform: translateY(-3px);
    }

    .btn-secondary {
      background: var(--primary);
      color: var(--white);
    }

    .btn-secondary:hover {
      background: var(--primary-dark);
      transform: translateY(-3px);
    }

    /* Footer */
    footer {
      background: var(--dark);
      color: var(--white);
      text-align: center;
      padding: 40px 20px;
      margin-top: 40px;
    }

    footer .social-links {
      margin-bottom: 20px;
    }

    footer .social-links a {
      margin: 0 10px;
      font-size: 1.6rem;
      color: var(--white);
      transition: all 0.3s ease;
    }

    footer .social-links a:hover {
      color: var(--secondary);
      transform: translateY(-3px);
    }

    footer .contact {
      margin: 20px 0;
      font-size: 1rem;
      line-height: 1.6;
    }

    footer .copyright {
      margin-top: 15px;
      color: #ccc;
    }

    /* Animations */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .intro-content h1 { font-size: 2rem; }
      .intro-content p { font-size: 1rem; }
      nav ul { flex-wrap: wrap; gap: 15px; }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav id="navbar">
    <a class="navbar-brand" href="index.php">
      <i class="fas fa-landmark"></i>
      <?php echo $sys->sys_name; ?>
    </a>
    <ul>
      <li><a href="index.php" class="active">Home</a></li>
      <li><a href="admin/pages_index.php">Admin</a></li>
      <li><a href="staff/pages_staff_index.php">Staff</a></li>
      <li><a href="client/pages_client_index.php">Client</a></li>
      <li><a href="pages_loans.php">About Us</a></li>
      <li><a href="condition.php">T&C</a></li>
    </ul>
    <a class="btn-join" href="client/pages_client_signup.php">
      <i class="fas fa-user-plus"></i> Join Us
    </a>
  </nav>

  <!-- Hero Section -->
  <div class="intro">
    <img src="dist/top-10-digital-banking-security-solutions-717x404.webp" alt="Banking Background">
    <div class="intro-content">
      <h1><?php echo $sys->sys_name; ?></h1>
      <p><?php echo $sys->sys_tagline; ?></p>
      <a class="btn-primary" href="client/pages_client_signup.php">
        <i class="fas fa-arrow-right"></i> Get Started
      </a>
      <a class="btn-secondary" href="pages_loans.php">
        <i class="fas fa-info-circle"></i> Learn More
      </a>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="social-links">
      <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://x.com" target="_blank"><i class="fab fa-x-twitter"></i></a>
      <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://google.com" target="_blank"><i class="fab fa-google"></i></a>
    </div>
    <div class="contact">
      <p><i class="fas fa-phone"></i> +91 98430 71313</p>
      <p><i class="fas fa-envelope"></i> info@bank.com</p>
      <p><i class="fas fa-map-marker-alt"></i> 123 Finance Street, Vellore, India</p>
    </div>
    <div class="copyright">
      <p>&copy; <?php echo date("Y"); ?> <?php echo $sys->sys_name; ?> - All Rights Reserved</p>
    </div>
  </footer>

  <script>
    // Navbar scroll effect
    const navbar = document.getElementById("navbar");
    window.addEventListener("scroll", () => {
      navbar.classList.toggle("scrolled", window.scrollY > 50);
    });

    // Active menu highlight
    const navLinks = document.querySelectorAll("nav ul li a");
    const currentPage = window.location.pathname.split('/').pop();
    navLinks.forEach(link => {
      if (link.getAttribute('href') === currentPage) link.classList.add("active");
    });
  </script>
</body>
</html>
