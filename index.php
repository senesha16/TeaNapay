<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TEA-Napay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <!-- Header (same as other pages) -->
    <!--NAV BAR -->
    <header class="main-header">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid position-relative">
                <!-- Offcanvas Toggler -->
                <button class="navbar-toggler d-lg-none position-absolute top-50 start-0 translate-middle-y ms-2"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#mainNavDrawer"
                    aria-controls="mainNavDrawer" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-2"></i>
                </button>
                <a class="navbar-brand d-none d-lg-block" href="mainpage.php#home">TEA-Napay</a>
                <a class="navbar-brand d-none d-md-block d-lg-none mx-auto" href="mainpage.php#home">TEA-Napay</a>
                <a class="navbar-brand d-block d-md-none ms-5" href="mainpage.php#home">TEA-Napay</a>
                <div class="navbar-nav icons-nav flex-row align-items-center position-absolute top-50 end-0 translate-middle-y me-2">
                    <a class="nav-link px-2" href="mainpage.phpcart.php" aria-label="View cart"><i class="bi bi-cart4 fs-4"></i></a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-2" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                          <li>
                              <a class="dropdown-item" href="profile.html">
                                  <i class="bi bi-person-circle me-2"></i> See Profile Information
                              </a>
                            </li>
                          <li>
                            <button class="dropdown-item" onclick="updatePersonalInfo()">
                              <i class="bi bi-pencil-square me-2"></i> Update Personal Information
                            </button>
                          </li>
                          <li>
                            <button class="dropdown-item" onclick="updatePassword()">
                              <i class="bi bi-key me-2"></i> Update Password
                            </button>
                          </li>
                          <li>
                            <button class="dropdown-item text-danger" onclick="logout()">
                              <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                          </li>
                        </ul>
                    </li>
                </div>
                <!-- Desktop Navbar -->
                <div class="collapse navbar-collapse d-none d-lg-block" id="mainNav">
                    <div class="navbar-nav-container d-flex justify-content-center w-100">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#home">HOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#about">ABOUT</a></li>
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#service">SERVICE</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="mainpage.php#menu" id="menuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">PRODUCTS</a>
                                <ul class="dropdown-menu" aria-labelledby="menuDropdown">
                                    <li><a class="dropdown-item" href="menu.php#bread">Bread</a></li>
                                    <li><a class="dropdown-item" href="menu.php#doughnut">Donuts</a></li>
                                    <li><a class="dropdown-item" href="menu.php#cakes">Cakes</a></li>
                                    <li><a class="dropdown-item" href="menu.php#fruittea">Fruit Tea</a></li>
                                    <li><a class="dropdown-item" href="menu.php#others">Others</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#contact">CONTACT</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Offcanvas Drawer for Mobile/Tablet -->
                <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mainNavDrawer" aria-labelledby="mainNavDrawerLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="mainNavDrawerLabel">TEA-Napay</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#home" data-bs-dismiss="offcanvas">HOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#about" data-bs-dismiss="offcanvas">ABOUT</a></li>
                            <li class="nav-item"><a class="nav-link" href="mainpage.php#service" data-bs-dismiss="offcanvas">SERVICE</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="mainpage.php#menu" id="menuDropdownDrawer" role="button" data-bs-toggle="dropdown" aria-expanded="false">PRODUCTS</a>
                                <ul class="dropdown-menu" aria-labelledby="menuDropdownDrawer">
                                    <li><a class="dropdown-item" href="menu.php#bread">Bread</a></li>
                                    <li><a class="dropdown-item" href="menu.php#donuts">Donuts</a></li>
                                    <li><a class="dropdown-item" href="menu.php#cakes">Cakes</a></li>
                                    <li><a class="dropdown-item" href="menu.php#fruittea">Fruit Tea</a></li>
                                    <li><a class="dropdown-item" href="menu.php#others">Others</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#contact" data-bs-dismiss="offcanvas">CONTACT</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Login Section -->
    <section class="login py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="login-card bg-white rounded shadow">
                        <div class="row g-0">
                            <div class="col-12 col-md-6 gradient-bg d-flex align-items-center justify-content-center">
                                <div class="text-center p-4">
                                    <i class="bi bi-cake2 fs-1 text-white mb-3"></i>
                                    <h2 class="text-white">Welcome Back!</h2>
                                    <p class="opacity-75">Login to enjoy your favorite treats!</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 p-4">
                                <h3 class="mb-3">Login</h3>
                                <p class="text-muted mb-4">Please login to your account.</p>
                                <form id="login-form">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="email" placeholder="username@gmail.com" required aria-label="Your email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password *</label>
                                        <input type="password" class="form-control" id="password" placeholder="••••••••" required aria-label="Your password">
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember Me</label>
                                        </div>
                                        <a href="#" class="text-muted small" id="forgot-password">Forgot Password?</a>
                                    </div>
                                    <button type="submit" class="btn btn-custom w-100">Login</button>
                                    <p class="p1 text-center mt-3 small">New User? <a href="register.html">Signup</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (same as other pages) -->
    <footer class="footer animate__animated animate__fadeIn" id="contact">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-1 text-md-start">
                    <ul class="nav justify-content-center flex-row flex-md-column">
                        <li class="nav-item mx-2"><a class="nav-link" href="mainpage.php#home">HOME</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="mainpage.php#about">ABOUT</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="mainpage.php#service">SERVICE</a></li>
                        <li class="nav-item mx-2"><a class="nav-link" href="mainpage.php#menu">MENU</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-5 text-center">
                    <h5 class="footer-heading">CONTACT DETAILS</h5>
                    <p class="footer-text">
                        Customer Hotline: +639687153421<br>
                        racapacia@yahoo.com
                    </p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/profile.php?id=100067176574296" class="social-icon" aria-label="Visit our Facebook page"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.facebook.com/messages/t/102498215320537" class="social-icon" aria-label="Visit our Facebook page"><i class="bi bi-messenger"></i></a>
                    </div>
                </div>
                <div class="col-12 col-md-6 text-center text-md-start">
                    <h5 class="footer-heading">SEND US A MESSAGE</h5>
                    <div class="contact-form">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Name *" required aria-label="Your name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email *" required aria-label="Your email">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" placeholder="Message *" rows="3" required aria-label="Your message"></textarea>
                        </div>
                        <button type="button" class="btn btn-custom rounded-pill px-4">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>